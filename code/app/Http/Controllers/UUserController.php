<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Mail\UserMail;
use App\Models\UserRole;
use App\Models\U_user_role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class UUserController extends Controller
{
    public function index()
    {
        $role = UserRole::all();

        return view('u_user')->with(['roles' => $role]);;
    }

    public function create(){

        $result = User::all();

        return DataTables($result)->make(true);
    }

    public function show($id){

        $result['users'] = User::find($id);

        $result['u_user_roles'] = U_user_role::select('role_id')->where(['user_id' => $id])->get();

        return response()->json($result);

    }
    public function store(Request $request){

        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255'],
            'password'=>'required',
        ]);

        if($validator->fails()){
            return response()->json(['validation_error' => $validator->errors()->all()]);
        }else{
            try{
                DB::beginTransaction();

                $mailData = [
                    'password' => $request->password,
                    'name' => $request->name,
                    'useremail'=>$request->email,
                ];
                $email= $request->email;

                $user =new User;
                $user->name = $request->name;
                $user->email = $request->email;
                $user->sales_code = $request->sales_code;
                $user->phoneNumber = $request->phoneNumber;
                $user->password = Hash::make($request->password);

                $user->save();
               
                $roles =$request->role_id;
                $users = $user->id;

                foreach( $roles as $role){

                    $user_role = new U_user_role;
                    $user_role->user_id = $users;
                    $user_role->role_id = $role;

                    $user_role->save();

                }
                Mail::to($email)->cc(['kumar@fedexlk.com'])->send(new UserMail($mailData));

                DB::commit();
                return response()->json(['db_success' => 'User Added']);

            }catch(\Throwable $th){
                DB::rollback();
                throw $th;
                return response()->json(['db_error' =>'Database Error'.$th]);
            }

        }

    }
    public function update(Request $request){

        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255']
        ]);

        if($validator->fails()){
            return response()->json(['validation_error' => $validator->errors()->all()]);
        }else{
            try{
                DB::beginTransaction();

                $user = User::find($request->id);
                $user->name = $request->name;
                $user->email = $request->email;
                $user->sales_code = $request->sales_code;
                $user->phoneNumber = $request->phoneNumber;

                $user->save();

                $this->delete_roles( $user->id);

                $roles =$request->role_id;
                $users = $user->id;

                foreach( $roles as $role){

                    $user_role = new U_user_role;
                    $user_role->user_id = $users;
                    $user_role->role_id = $role;

                    $user_role->save();

                }

                DB::commit();
                return response()->json(['db_success' => 'User Updated']);

            }catch(\Throwable $th){
                DB::rollback();
                throw $th;
                return response()->json(['db_error' =>'Database Error'.$th]);
            }

        }

    }

    public function destroy($id){
        $result = User::destroy($id);
        $this->delete_roles($id);

        return response()->json($result);

    }

    public function delete_roles($id){
        U_user_role::where(['user_id' => $id])->delete();
    }
}    
