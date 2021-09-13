<?php

namespace App\Http\Controllers\api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Validator;
use App\Models\User;

class UserController extends Controller
{
    public $successStatus = 200;

    public function login(){
        if(Auth::attempt(['email' => request('email'), 'password' => request('password')])){
            $user = Auth::User();
            $success =  $user->createToken('nApp')->accessToken;
            return response()->json([
                'success' => true,
                'token' => $success,
                'user' => Auth::User()
            ], $this->successStatus);
        }
        else{
            return response()->json(['error'=>'Unauthorised'], 401);
        }
    }

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required',
            'c_password' => 'required|same:password',
        ]);

        if ($validator->fails()) {
            return response()->json(['error'=>$validator->errors()], 401);            
        }

        $input = $request->all();
        $input['password'] = bcrypt($input['password']);
        $user = User::create($input);
        $success['token'] =  $user->createToken('nApp')->accessToken;
        $success['name'] =  $user->name;

        return response()->json(['success'=>$success], $this->successStatus);
    }

    public function profil()
    {
        $profil = User::all();
        return response()->json($profil);
    }
    
        public function update(Request $request)
    {

        $user = User::where('id','=',$request->id)->first();
        $user->id   = $request->id;
        $user->name   = $request->name;
        $user->email   = $request->email;
        $user->alamat   = $request->alamat;
        $user->telepon  = $request->telepon;
        $user->save();

        return response()->json($user, 201);
    }


}
