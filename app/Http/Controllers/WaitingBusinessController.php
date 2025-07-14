<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WaitingBusinessController extends Controller
{
    public function serve(){
        return view("pages.waiting.request-status");
    }
}
