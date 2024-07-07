<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Thanhvien;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Log;

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

            //Ghi logs
            Log::create([
                'user_id' => Auth::id(),
                'activity' => 'Đăng nhập vào hệ thống',
            ]);

            return redirect('/thanhvien');
        }

        return back()->withErrors([
            'email' => 'Thông tin đăng nhập không đúng.',
        ]);
    }

    public function logout(Request $request)
    {
        if (Auth::check()) {
            // Ghi logs
            // Log::create([
            //     'user_id' => Auth::user()->id,
            //     'activity' => 'Đăng xuất khỏi hệ thống',
            // ]);
        }

        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }


}
