<?php

namespace App\Http\Controllers;

use App\Mail\AEMail;
use Illuminate\Http\Request;
use App\Models\AERequestForm;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class PricingRateController extends Controller
{
    public function index(){
        return view('pricing-form');
    }

    public function create(){
        $result= DB::table('a_e_request_forms')
                ->where('a_e_request_forms.staus',0)
                ->select('a_e_request_forms.*')
                ->get();

        return DataTables($result)->make(true);
    }

    public function store(Request $request){

        $validator = Validator::make($request->all(), [
            'offer_rate' => 'required',
        ]);

        if($validator->fails()){
            return response()->json(['validation_error' => $validator->errors()->all()]);
        }else{
            try{
                DB::beginTransaction();
                $result= DB::table('a_e_request_forms')
                        ->where('a_e_request_forms.id',$request->id)
                        ->select('a_e_request_forms.assign_ae','a_e_request_forms.company_name','a_e_request_forms.weight','a_e_request_forms.destination')
                        ->get();
               
                $email= DB::table('users')
                        ->where('users.id',$result[0]->assign_ae)
                        ->select('users.email','users.name')
                        ->get();      
                        
                $mailData = [
                    'offer_rate' =>$request->offer_rate,
                    'comment' => $request->pricing_comment,
                    'weight'=>$result[0]->weight,
                    'destination'=>$result[0]->destination,
                    'company_name'=>$result[0]->company_name,
                    'name'=>$email[0]->name,
                ];     

                Mail::to($email[0]->email)->cc(['pricing@fedexlk.com'])->send(new AEMail($mailData));
                
                $type = AERequestForm::find($request->id);
                $type->rate_offer = $request->offer_rate;
                $type->pricing_comment = $request->pricing_comment;
                $type->staus = '1';
                $type->pricing_status = $request->status;

                $type->save();

                DB::commit();
                return response()->json(['db_success' => 'Added New Rate']);

            }catch(\Throwable $th){
                DB::rollback();
                throw $th;
                return response()->json(['db_error' =>'Database Error'.$th]);
            }

        }
    }
}
