<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AERequestController extends Controller
{
    public function index(){
        return view('ae-requestform');
    }
}
