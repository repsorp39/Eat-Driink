<?php

namespace App\Http\Controllers;

use App\Models\Stand;
use Illuminate\Support\Facades\Auth;


class WaitingBusinessController extends Controller
{
    public function serve(){
        $stand = Stand::find(Auth::user()->id)->toArray();
        $data =  Auth::user()->attributesToArray() + $stand;
        return view("pages.waiting.request-status",["info" => $data]);
    }
}
