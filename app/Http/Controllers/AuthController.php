<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function showLogin(): View
    {
        return view('auth.login');
    }

    public function showRegister(): View
    {
        return view('auth.register');
    }

    public function login(Request $request): RedirectResponse
    {
        $credentials = $request->only('email', 'password');

        $validator = Validator::make($credentials, [
            'email' => ['required', 'email'],
            'password' => ['required', 'string'],
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        if (Auth::attempt($credentials, $request->boolean('remember'))) {
            $request->session()->regenerate();
            return redirect()->intended('/')->with('sweetalert', [
                'type' => 'success',
                'title' => 'تم تسجيل الدخول بنجاح',
                'message' => 'مرحباً بك في موقع كرة القدم الاحترافي'
            ]);
        }

        return back()->with('sweetalert', [
            'type' => 'error',
            'title' => 'خطأ في تسجيل الدخول',
            'message' => 'بيانات الدخول غير صحيحة'
        ])->withInput();
    }

    public function register(Request $request): RedirectResponse
    {
        $data = $request->only('name', 'email', 'password', 'password_confirmation');
        $validator = Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);

        Auth::login($user);

        return redirect('/')->with('sweetalert', [
            'type' => 'success',
            'title' => 'تم إنشاء الحساب بنجاح',
            'message' => 'تم إنشاء حسابك وتسجيل الدخول تلقائياً'
        ]);
    }

    public function logout(Request $request): RedirectResponse
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/')->with('sweetalert', [
            'type' => 'info',
            'title' => 'تم تسجيل الخروج',
            'message' => 'شكراً لزيارتك موقع كرة القدم الاحترافي'
        ]);
    }
}


