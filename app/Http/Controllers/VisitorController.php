<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Stand;
use App\Models\User;
use Illuminate\Http\Request;

class VisitorController extends Controller
{
    public function serve (Request $req){
        $query = $req->query("query");
        if(isset($query) && !empty($query)){
            $stands = Stand::with("user")
                        ->where("stand_name","LIKE","%$query%")
                        ->orWhere("description","LIKE","%$query%")
                        ->get()
                        ->filter(function($stand){
                            return $stand->user->isApproved();
                        });
            
            $results = [
                "stands"   =>  $stands,
                "query"    =>  $query
            ];
            return view("pages.visitor.stands-list" ,$results);

        }


         $stands = Stand::with("user",)
            ->get()
            ->filter(function($stand){
                return $stand->user->isApproved();
            });

            return view("pages.visitor.stands-list" ,["stands" => $stands]);
    }

    public function serveDetails(Request $req, string $id){
        $query = $req->query("query");
        $stand = Stand::with("user")->where("id",$id)->get()[0];
        if(isset($query) && !empty($query)){
            $products = Product::where("stand_id",$id)
                        ->where("name","like","%$query%")
                        ->orWhere("description","like","%$query%")
                        ->get();
            return view("pages.visitor.products-lists" ,[
                "products"  =>$products,
                "stand"     => $stand,
                "query"     => $query
            ]);

        }

            
        $products = Product::where("stand_id",$stand->id)->get();
        return view("pages.visitor.products-lists" ,[
            "products"  => $products ,
            "stand"     => $stand
        ]);
    }

    public function getCardProductInfo(Request $req){
        $ids = json_decode($req->query("ids"));
        $products = Product::whereIn("id",$ids)->get()->toArray();
        //since Response::json() doesn't workk
        echo json_encode($products);
    }
    
}
