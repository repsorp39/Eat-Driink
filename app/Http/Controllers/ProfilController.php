<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfilController extends Controller
{
    public function serve(){
        $user_info = User::with("stands")->where("id",Auth::user()->id)->get()[0]->toArray();
        $productsNumber = Product::where("stand_id",$user_info["stands"]["id"])->count("id"); 
        $commandesNumber  = Order::where("stand_id",$user_info["stands"]["id"])->count("id");
        return view("pages.profil",[
            "user"      => $user_info,
            "products"   => $productsNumber,
            "commandes" => $commandesNumber
        ]);
    }

}
