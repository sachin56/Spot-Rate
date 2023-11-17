<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class UserDashboardController extends Controller
{
    public function index(){

        $closeWon = DB::table('a_e_request_forms')
                    ->where('a_e_request_forms.ae_status','=','0')
                    ->where('a_e_request_forms.assign_ae','=',Auth::user()->id)
                    ->count();
        
        $allCount = DB::table('a_e_request_forms')
                    ->where('a_e_request_forms.assign_ae','=',Auth::user()->id)
                    ->count();   
                    
        $closeLost = DB::table('a_e_request_forms')
                    ->where('a_e_request_forms.ae_status','=','1')
                    ->where('a_e_request_forms.assign_ae','=',Auth::user()->id)
                    ->count(); 

        $pending = DB::table('a_e_request_forms')
                    ->where('a_e_request_forms.ae_status','=','')
                    ->where('a_e_request_forms.assign_ae','=',Auth::user()->id)
                    ->count();                   

        return view('dashboard')->with(['closeWon'=>$closeWon,'allCount'=>$allCount,'closeLost'=>$closeLost,'pending'=>$pending]);
    }
}
