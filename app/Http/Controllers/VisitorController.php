<?php

namespace App\Http\Controllers;

use App\Models\Stand;
use App\Models\User;
use Illuminate\Http\Request;

class VisitorController extends Controller
{
    public function serve (){
        //as they said approved role
        $stands = User::where("role","approved")->with("stands")->get();
        return view("pages.visitor.stands-list" ,["stands" => $stands]);
    }

    public function serveDetails(string $id){
        $user = User::where([
            "role"=>"approved",
            "id" => $id
        ])->with("stands")->with("stands.products")->get()[0];
        return view("pages.visitor.products-lists" ,["user" => $user]);
    }
    
}
