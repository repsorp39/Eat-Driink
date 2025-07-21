<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use App\Models\Stand;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function order(Request $req){
       Order::create($req->all());
       return redirect()->back()->with("success","Votre commande a bien été passé! Merci pour votre fidélité.");
    }

    public function serveOrder(Request $req){
            $stand = Stand::where("user_id",Auth::user()->id)->get();
            $orders = Order::where('stand_id',$stand[0]->id)->get()->toArray();
            //each orders is saved in the db as a json data
            //so after recuperation of our orders, we use map to pass throuh each an to make it as array
            // The true in json_decode enforce php to convert our var in array by defautl it doesn't do that
            $ordersDetails = array_map(fn($order) => json_decode($order["order_details"],true),$orders);
            $ordersList = [];
            
            if(count($ordersDetails) > 0){
                 //now for each products let's recuperate the product 
                 foreach($ordersDetails as $orderDetail){
                    $details = [];
                    foreach($orderDetail as $order){
                        $orderProduct = Product::whereId($order['id'])->get()->toArray()[0];
                        $details[] = $orderProduct + ["quantite" => $order['quantite']];
                    }
                    $ordersList[] = $details;
                }
            }

        
        return view("pages.orders.orders",["ordersList" => $ordersList]); 
    }
}
