<?php

namespace App\Http\Controllers;

use App\Models\AERequestForm;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class UserDashboardController extends Controller
{
    public function index(){

        $allCount = DB::table('a_e_request_forms')
                    ->where('a_e_request_forms.assign_ae','=',Auth::user()->id)
                    ->count(); 

        $closeWon = DB::table('a_e_request_forms')
                    ->where('a_e_request_forms.ae_status','=','0')
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
        
        $allWon = DB::table('a_e_request_forms')
                    ->where('a_e_request_forms.ae_status','=','0')
                    ->count();             

        $allLost = DB::table('a_e_request_forms')
                    ->where('a_e_request_forms.ae_status','=','1')
                    ->count();    

        $allPending = DB::table('a_e_request_forms')
                    ->where('a_e_request_forms.ae_status','=','')
                    ->count(); 

        $totalCount = AERequestForm::count();

        return view('dashboard')->with(['closeWon'=>$closeWon,'allCount'=>$allCount,'closeLost'=>$closeLost,
                'pending'=>$pending,'allWon'=>$allWon,'allLost'=>$allLost,'allPending'=>$allPending,'totalCount'=>$totalCount]);
    }
}
