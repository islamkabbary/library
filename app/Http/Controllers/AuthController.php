<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\AuthRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    public function show_my_register()
    {
        return view('my_auth.my_register');
    }

    public function my_register(AuthRequest $request)
    {
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->back()->with('success', "reqistration successful");
    }

    public function show_my_login()
    {
        return view('my_auth.my_login');
    }

    public function my_login(Request $request)
    {
        $request->validate([
            'email' => "required|email",
            "password" => "required",
        ]);


        $credentials = [
            'email' => $request->email,
            'password' => $request->password,
        ];

        if (Auth::attempt($credentials, $request->remeber_me)) {
            return redirect('/dashboard');
        }

        throw ValidationException::withMessages([
            'email' => ['credentials false'],
        ]);
    }


    function my_logout()
    {
        Auth::logout();
        return redirect('/show-my-login');
    }

    public function show_my_forget_password()
    {
        return view('my_auth.forget-password');
    }

    public function send_reset(Request $request)
    {
        $request->validate(['email' => "required|email"]);

        $res = Password::sendResetLink($request->only('email'));

        return $res === Password::RESET_LINK_SENT ? back()->with('status' , "Password link sent") : back()->withErrors(['email' => 'not valid']);
    }

}
