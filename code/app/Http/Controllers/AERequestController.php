<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AERequestForm;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Contracts\DataTable;

class AERequestController extends Controller
{
    public function index(){
        return view('ae-requestform');
    }

    public function create(){
        $result = AERequestForm::all();

        return DataTable($result)->make(true);
    }

    public function store(Request $request){
     dd($request);
        $validator = Validator::make($request->all(), [
            'company_name' => 'required',
            'weight' => 'required',
            'destination' => 'required',
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
                $type->ae_comment = Auth::user()->id;

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
