<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function order(Request $req){
       Order::create($req->all());
       return redirect()->back()->with("success","Votre commande a bien été passé! Merci pour votre fidélité.");
    }
}
