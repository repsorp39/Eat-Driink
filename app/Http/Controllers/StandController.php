<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Stand;
use Illuminate\Http\Request;

class StandController extends Controller
{
    public function serve(){
        return view("pages.form-stand");
    }

    public function search(Request $req){
        $query = $req->query("search-query");
        $stands = Stand::where("stand_name","LIKE","%$query%")->get();
        $products = Product::where("name","LIKE","%$query%")->get();
        $results = [
            "products" =>  $products,
            "stands"   =>  $stands,
            "query"    =>  $query
        ];
        dd($results);
        return view("pages.visitor.stands-list" ,$results);

    }       
}
