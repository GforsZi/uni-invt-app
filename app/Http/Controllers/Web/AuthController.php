<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth as FacadesAuth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function register_page()
    {
        return view('auth.register',  ["title" => "Register page"]);
    }

    public function register_system(Request $request)
    {
        // if ($request["password"] !== $request["password_confirmation"]) {
        //     return redirect("/register");
        //     exit();
        // }
        $validateData = $request->validate([
            "name" => "required | min:3 | max:255",
            "email" => "required | email:dns | unique:users,email",
            "password" => "required | min:5 | max:30 | confirmed",
        ]);

        $validateData["password"] = Hash::make($validateData["password"]);

        User::create($validateData);
        return redirect("/login")->with("success", "account created");
    }

    public function login_page()
    {
        return view('auth.login', ["title" => "Login page"]);
    }

    public function login_system(Request $request)
    {
        $credentials = $request->validate([
            "email" => "required | max:255",
            "password" => "required | max:255",
        ]);

        if (FacadesAuth::attempt($credentials)) {
            $request->session()->regenerate();

            $user = User::with('roles')->where('email', $credentials['email'])->get()->toArray();
            if ($user[0]['usr_activation'] == false || $user[0]['roles']['rl_admin'] == true) {
                return redirect()->intended("/dashboard")->with("success", "Login success!");
            } else {
                return redirect()->intended("/home")->with("success", "Login success!");
            }
        }

        return back()->with("errorLogin", "Login failed!");
    }

    public function logout_system(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect("/");
    }
}
