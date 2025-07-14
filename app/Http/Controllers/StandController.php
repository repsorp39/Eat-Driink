<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StandController extends Controller
{
    public function serve(){
        return view("pages.form-stand");
    }
}
