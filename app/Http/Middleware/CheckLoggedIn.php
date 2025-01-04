<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckLoggedIn
{
    public function handle(Request $request, Closure $next)
    {
        if (!Auth::check()) { // Kiểm tra nếu người dùng chưa đăng nhập
            return redirect('/login'); // Chuyển hướng đến trang đăng nhập
        }
        return $next($request); // Nếu đã đăng nhập, tiếp tục xử lý request
    }
}