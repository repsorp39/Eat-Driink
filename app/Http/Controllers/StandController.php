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
}
