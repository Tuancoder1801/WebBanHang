<?php

namespace App\Http\Controllers\Admin\Users;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{
    public function index()
    {
        return view('admin.users.login', 
        [
            'title' => 'Đăng nhập'
        ]);
    }

    public function store(Request $request)
    {   
        $validated = $request->validate([
            'email' => 'required|email',  // Kiểm tra nếu email có tồn tại và đúng định dạng
            'password' => 'required|min:6', // Kiểm tra nếu password có ít nhất 6 ký tự
        ]);
    
        // Lấy giá trị remember
        $remember = $request->has('remember');
    
        // Kiểm tra đăng nhập
        if (Auth::attempt(['email' => $request->input('email'), 'password' => $request->input('password')], $remember)) {
            // Đăng nhập thành công, chuyển hướng tới trang admin
            return redirect()->route('admin');
        }
        
        Session::flash('error', 'Email hoặc Password không chính xác');
        // Đăng nhập thất bại, quay lại với thông báo lỗi
        return redirect()->back();
    }
}
