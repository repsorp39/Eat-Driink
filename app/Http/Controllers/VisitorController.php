<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Stand;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class VisitorController extends Controller
{
    public function serve (){
        //as said approved role stands
        $stands = User::where("role","approved")->with("stands")->get();
        return view("pages.visitor.stands-list" ,["stands" => $stands]);
    }

    public function serveDetails(string $id){
        $user = User::where([
            "role"=>"approved",
            "id" => $id
        ])->with("stands")->with("stands.products")->get();
        return view("pages.visitor.products-lists" ,["user" => $user[0] ?? []]);
    }

    public function getCardProductInfo(Request $req){
        $ids = json_decode($req->query("ids"));
        $products = Product::whereIn("id",$ids)->get()->toArray();
        //since Response::json() doesn't workk
        echo json_encode($products);
    }
    
}
