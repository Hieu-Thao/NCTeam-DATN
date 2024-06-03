<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Thanhvien;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login'); // Đảm bảo rằng view 'login' là trang đăng nhập của bạn
    }

    public function login(Request $request)
    {
        // Validate the incoming request data
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Retrieve the user by email
        $thanhvien = Thanhvien::where('email', $request->email)->first();

        // Verify the password (without hashing)
        if ($thanhvien && $request->password === $thanhvien->mat_khau) {
            // Check user role and redirect accordingly
            if ($thanhvien->ma_quyen == 1) {
                return redirect('/index'); // Redirect to index if quyen = 1
            } elseif ($thanhvien->ma_quyen == 2) {
                return redirect('/trangchu'); // Redirect to trangchu if quyen = 2
            } else {
                // Handle other roles or return an error
                return back()->withErrors(['email' => 'Quyền người dùng không hợp lệ']);
            }
        } else {
            // Invalid credentials
            return back()->withErrors(['email' => 'Thông tin đăng nhập không chính xác hoặc mật khẩu không đúng']);
        }
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/login');
    }
}
