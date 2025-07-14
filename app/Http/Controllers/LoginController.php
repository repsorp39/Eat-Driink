<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules\Password;

class LoginController extends Controller
{
    public function serve(){
        return view("pages.login");
    }

    public function login(Request $req){
        $validated = $req->validate([
            "email" => ["email","exists:users,email"],
            "password" => ["required",Password::min(8)]
        ]);

        if(Auth::attempt($validated)){
            return redirect()->route("status");
        }

        return redirect()->back()->with("error","Email ou mot de passe incorrecte!");
    }

    public function logout(Request $req){
        Auth::logout();
        $req->session()->invalidate();
        $req->session()->regenerateToken();
        return redirect("/");
    }
}
