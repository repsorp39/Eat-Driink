<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function serve(Request $req){
        $approved = User::with("stands")->where("role","approved")->get()->toArray();
        $rejected = User::with("stands")->where("role","rejected")->get()->toArray();
        $waiting  = User::with("stands")->where("role","waiting")->get()->toArray();
        return view("pages.admin.dashboard",[
            "waiting" => $waiting,
            "rejected" => $rejected,
            "approved" => $approved,
            "filter" => $req->query("filter") ?? "en attente"
        ]);
    }   

    public function approvedRequest(Request $req){
        $user = User::whereId($req->query("id"));
        $user->update(["role" => "approved"]);
        return redirect("/admin")->with("success","Vous avez approuvé une requête de stand.");
    }

    public function rejectRequest(Request $req ){
        $user = User::whereId($req->query("id"));
        $user->update(["role" => "rejected","motif_rejected" => $req->get("motif") ?? ""]);
        return redirect("/admin")->with("success","Vous avez rejeté une demande de stand.");
    }
}
