<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RejectInvestorForWeb
{
    public function handle(Request $request, Closure $next)
    {
        $user = $request->user();
        if ($user && $user->role === 'investor') {
            Auth::logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();
            return redirect()->route('login')->withErrors('ممنوع للمستثمرين دخول واجهة الويب. الرجاء استخدام التطبيق.');
        }
        return $next($request);
    }
}