<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BankAccount; 
use App\Traits\ApiResponse;

class BankAccountController extends Controller
{
      use ApiResponse; // this line to call api response fun

    public function index(Request $request)
    {
        $accounts = $request->user()->bankAccounts()->get();

        return $this->success($accounts, 'تمّ جلب الحسابات البنكية');
    }

    public function store(Request $request)
    {
 
         // التحقق من عدد الحسابات البنكية الحالية للمستخدم
    $accountCount = $request->user()->bankAccounts()->count();

    // تحديد الحد الأقصى المسموح به
    $maxAccounts = 3;

    // إذا كان عدد الحسابات أكبر من أو يساوي الحد الأقصى، إرجاع استجابة خطأ
    if ($accountCount >= $maxAccounts) {
          return $this->error('لا يمكنك إضافة أكثر من ' . $maxAccounts . ' حسابات بنكية.', 401);
    }

        $data = $request->validate([
            'bank_name'            => 'required|string|max:255',
            'account_holder_name'  => 'required|string|max:255',
            'account_number'       => 'required|string|max:50',
            'iban'                 => 'nullable|string|max:50',
            'swift_code'           => 'nullable|string|max:20',
            'country'              => 'required|string|max:100',
            'is_primary'           => 'boolean',
        ]);

        $data['user_id'] = $request->user()->id;

        $account = BankAccount::create($data);

        return $this->success($account, 'تمّ إنشاء الحساب البنكي', 201);
    }

    public function show(Request $request, $id)
    {
        $account = $request->user()->bankAccounts()->findOrFail($id);
        return $this->success($account, 'تفاصيل الحساب البنكي');
    }

    public function update(Request $request, $id)
    {
        $account = $request->user()->bankAccounts()->findOrFail($id);

        $data = $request->validate([
            'bank_name'            => 'required|string|max:255',
            'account_holder_name'  => 'required|string|max:255',
            'account_number'       => 'required|string|max:50',
            'iban'                 => 'nullable|string|max:50',
            'swift_code'           => 'nullable|string|max:20',
            'country'              => 'required|string|max:100',
            'is_primary'           => 'boolean',
        ]);

        $account->update($data);  

        return $this->success($account, 'تمّ تعديل الحساب البنكي');
    }

    public function destroy(Request $request, $id)
    {
        $account = $request->user()->bankAccounts()->findOrFail($id);
        $account->delete();
        return $this->success(null, 'تمّ حذف الحساب البنكي');
    }

    // افتراض أن دالة success موجودة في Controller الأساسي
}
