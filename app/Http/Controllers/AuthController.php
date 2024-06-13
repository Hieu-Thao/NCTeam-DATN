<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Thanhvien;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        $credentials = [
            'email' => $request->email,
            'password' => $request->password,
        ];

        $user = Thanhvien::where('email', $credentials['email'])->first();

        if ($user && Hash::check($credentials['password'], $user->mat_khau)) {
            Auth::login($user);
            $request->session()->regenerate();
            return redirect('/index');  // Chuyển hướng đến /index sau khi đăng nhập thành công
        }

        return back()->withErrors([
            'email' => 'Thông tin đăng nhập không đúng.',
        ]);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');  // Chuyển hướng về trang chủ sau khi đăng xuất
    }
}
