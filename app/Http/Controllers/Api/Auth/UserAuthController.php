<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Traits\ApiResponse;
use Illuminate\Support\Facades\Password;


class UserAuthController extends Controller
{ 
    // Include the trait
    use ApiResponse; 

    /// Register new user
    public function register(Request $request)
    {
        $fields = $request->validate([
            'name' => 'required|string',
            'email' => 'required|string|email',
            'password' => 'required|string|confirmed|min:6',
            'role' => 'nullable|in:user,investor', // admin لا يُسمح عبر API
        ]);

        $role = $fields['role'] ?? 'investor'; // API registrations default to investor

        // Check if user already exists
        $existingUser = User::where('email', $fields['email'])->first();
        if ($existingUser) {
            return $this->error('Email already exists', 409);
        }

        // Create user
        $user = User::create([
            'name' => $fields['name'],
            'email' => $fields['email'],
            'password' => bcrypt($fields['password']),
            'role' => $role,
        ]);

        $token = $user->createToken('auth_token')->plainTextToken;

        return $this->success(
            ['user' => $user, 'token' => $token],
            'تم ّ تسجيل المستخدم بنجاح',
            200
        );
    }

    /// Login user
    public function login(Request $request)
    {
        $fields = $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]); 

        $user = User::where('email', $fields['email'])->first();
 
        if (!$user || !Hash::check($fields['password'], $user->password)) {
            return $this->error('لم يتم العثور على مستخدم', 401);
        }
        $user->tokens()
     ->where('created_at', '<=', now()->subMinutes(config('sanctum.expiration')))
     ->delete();

        $token = $user->createToken('auth_token')->plainTextToken;

        return $this->success( 
            ['user' => $user, 'token' => $token],
            'تم ّ تسجيل الدخول بنجاح'
        );
    }

      public function updateProfile(Request $request)
{
    $user = $request->user();

    $data = $request->validate([
        'name'               => 'sometimes|string|max:255',
        'nationality'        => 'sometimes|string|max:255',
        'gender'             => 'sometimes|in:male,female,other',
        'age'                => 'sometimes|integer|min:0',
        'passport_number'    => 'sometimes|string|max:255|nullable',
        'mobile_number'      => 'sometimes|string|max:20|nullable',
        'heir_mobile_number' => 'sometimes|string|max:20|nullable',
        'heir_name'          => 'sometimes|string|max:255|nullable',
    ]);

    $user->update($data);

    return $this->success(['user' => $user], 'تمّ تحديث ملف المستخدم بنجاح');
}

       /// Soft delete user (delete / deactivate account)
    public function deleteAccount(Request $request)
    {
        $user = $request->user();
        $user->delete(); // soft delete
        return $this->success(null, 'تمّ حذف الحساب بنجاح');
    }

    /// Logout user
    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return $this->success(null, 'تمّ تسجيل الخروج بنجاح');
    }

    /// Get authenticated user
    public function me(Request $request)
    {
        return $this->success(['user' => $request->user()], 'تمّ جلب بيانات المستخدم بنجاح');
    }
 /// Forgot password: send reset link
    public function forgotPassword(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
        ]);

        $status = Password::sendResetLink(
            $request->only('email')
        );

        if ($status === Password::RESET_LINK_SENT) {
            return $this->success(null, 'تمّ إرسال رابط إعادة تعيين كلمة المرور إلى بريدك الإلكتروني');
        } else {
            return $this->error('فشل في إرسال رابط إعادة تعيين كلمة المرور', 400);
        }
    }

      public function resetPassword(Request $request)
    {
        $request->validate([
            'token'                 => 'required|string',
            'email'                 => 'required|email',
            'password'              => 'required|string|confirmed|min:6',
        ]);

        $status = Password::reset(
            $request->only('email','password','password_confirmation','token'),
            function (User $user, string $password) {
                $user->password = bcrypt($password);
                $user->save();
            }
        );

        if ($status === Password::PASSWORD_RESET) {
            return $this->success(null, 'تمّ إعادة تعيين كلمة المرور بنجاح');
        } else {
            return $this->error('فشل في إعادة تعيين كلمة المرور', 400);
        }
    }



    
}
