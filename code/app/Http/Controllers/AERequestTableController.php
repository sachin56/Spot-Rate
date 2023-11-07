<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AERequestTableController extends Controller
{
    public function index(){
        return view('ae-requesttable');
    }
}
