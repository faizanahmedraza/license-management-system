<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function getLogin()
    {
        return view('admin.auth.sign-in');
    }

    public function postLogin(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email', 'max:100'],
            'password' => ['required', 'string', 'min:8', 'max:100'],
        ]);

        if (Auth::attempt($credentials, $request->has('remember_me'))) {
            $request->session()->regenerate();
            return redirect()->intended('admin/dashboard')->with('success', __('Successfully logged in!'));
        }

        return back()->withErrors([
            'errors' => __('The provided credentials do not match our records!'),
        ]);
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route('admin.getLogin');
    }
}
