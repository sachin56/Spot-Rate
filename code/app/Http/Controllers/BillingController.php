<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class BillingController extends Controller
{
    public function index(){

        return view('billing-form');
    }

    public function create(){
        $result= DB::table('a_e_request_forms')
                ->join('users','users.id','=','a_e_request_forms.assign_ae')
                ->select('a_e_request_forms.*','users.name as username')
                ->get();

        return DataTables($result)->make(true);
    }
}
