<?php

namespace App\Http\Controllers;

use App\Mail\ApprovedStandEmail;
use App\Mail\RejectedStandRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class AdminController extends Controller
{
    public function serve(Request $req){
        $approved = User::with("stands")->where("role","approved")->get();
        $rejected = User::with("stands")->where("role","rejected")->get();
        $waiting  = User::with("stands")->where("role","waiting")->get()->sortByDesc("created_at");
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
        $user = $user->get();
        Mail::to($user[0])->queue(new ApprovedStandEmail($user[0]));
        return redirect("/admin")->with("success","Vous avez approuvé une requête de stand.");
    }

    public function rejectRequest(Request $req ){
        $user = User::whereId($req->query("id"));
        $user->update(["role" => "rejected","motif_rejected" => $req->get("motif") ?? "NA"]);
        $user = $user->get();
        Mail::to($user[0])->queue(new RejectedStandRequest($user[0],$user[0]->motif_rejected));
        return redirect("/admin")->with("success","Vous avez rejeté une demande de stand.");
    }
}
