<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AERequestForm;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use DataTables;

class AERequestController extends Controller
{
    public function index(){

        return view('ae-requestform');
    }

    public function create(){

        $result= DB::table('a_e_request_forms')
                ->where('a_e_request_forms.staus','!=',2)
                ->select('a_e_request_forms.*')
                ->get();

        return DataTables($result)->make(true);
    }

    public function store(Request $request){

        $validator = Validator::make($request->all(), [
            'company_name' => 'required',
            'weight' => 'required',
            'destination' => 'required',
            'ae_rate' => 'required',
        ]);

        if($validator->fails()){
            return response()->json(['validation_error' => $validator->errors()->all()]);
        }else{
            try{
                DB::beginTransaction();

                $type = new AERequestForm;
                $type->icpc_no = $request->icpc_no;
                $type->mount_code = $request->mount_code;
                $type->company_name = $request->company_name;
                $type->weight = $request->weight;
                $type->destination = $request->destination;
                $type->ae_rate = $request->ae_rate;
                $type->service = $request->service;
                $type->ae_comment = $request->ae_comment;
                if (Auth::guard('admin')->check()){
                    $type->ae_comment = Auth::guard('admin')->user()->id;
                }else{
                    $type->ae_comment = Auth::user()->id;
                }
                $type->staus = '0';
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
    public function show($id){
        $result = AERequestForm::find($id);

        return response()->json($result);
    }

    public function update(Request $request){
        $validator = Validator::make($request->all(), [
            'company_name' => 'required',
            'weight' => 'required',
            'destination' => 'required',
            'icpc_no' => 'required',
            'company_name' => 'required',
            'ae_rate' => 'required',
            'service' => 'required',
            'ae_comment' => 'required',
        ]);

        if($validator->fails()){
            return response()->json(['validation_error' => $validator->errors()->all()]);
        }else{
            try{
                DB::beginTransaction();

                $type = AERequestForm::find($request->id);
                $type->icpc_no = $request->icpc_no;
                $type->mount_code = $request->mount_code;
                $type->company_name = $request->company_name;
                $type->weight = $request->weight;
                $type->destination = $request->destination;
                $type->ae_rate = $request->ae_rate;
                $type->service = $request->service;
                $type->ae_comment = $request->ae_comment;
                if (Auth::guard('admin')->check()){
                    $type->ae_comment = Auth::guard('admin')->user()->id;
                }else{
                    $type->ae_comment = Auth::user()->id;
                }
                $type->staus = '1';

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

    //basically this doing submit to data in billing
    public function ae_change_status(Request $request){
        $validator = Validator::make($request->all(), [
            'awb' => 'required',
            'status' => 'required',
        ]);

        if($validator->fails()){
            return response()->json(['validation_error' => $validator->errors()->all()]);
        }else{
            try{
                DB::beginTransaction();

                $type = AERequestForm::find($request->id);
                $type->awb = $request->awb;
                $type->ae_status = $request->status;
                $type->staus = '2';

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
