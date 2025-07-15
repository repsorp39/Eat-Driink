<?php

namespace App\Http\Controllers;

use App\Models\Stand;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules\Password;


class RegisterController extends Controller
{
    public function standRequest(Request $req ){
        $validated = $req->validate([
            "business_name"  => ["required", "max:120"],
            "email"          => ["required", "unique:users", "email"],
            "password"       => ["required", Password::min(8)],
            "owner_fullname" => ["required", "regex:/^[\p{L}\s\-\.\']+$/u"],
            "business_img" => ["image","mimes:jpeg,png,jpg,gif","max:2048"],
            "stand_name" => ["required", "max:120"],
            "description" => ["required", "max:300"],
        ]);
        $imagePath = "";
        if($req->hasFile('business_img')){
            $imagePath = $req->file("business_img")->store("images","public");
            $imagePath = env("APP_URL")."/storage/".$imagePath;
        }
        $userinfo = [
            "business_name"  =>  $validated["business_name"],
            "email"          =>  $validated["email"],
            "password"       =>  $validated["password"],
            "owner_fullname" =>  $validated["owner_fullname"],
        ];
        if($imagePath) $userinfo["business_img"] = $imagePath;
        $user = User::create($userinfo);

        $stand = [
            "stand_name"  => $validated["stand_name"],
            "description" => $validated["description"],
            "user_id"     => $user["id"]
        ];
        Stand::create($stand);
        return redirect("/login")->with('success','Demande de stands effectué! Connectez-vous pour suivre votre demande');
    }
}
