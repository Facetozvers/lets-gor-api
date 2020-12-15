<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Support\Facades\Auth;
use Validator;

class UserController extends Controller
{

    public $successStatus = 200;

    public function login(){
        if(Auth::attempt(['email' => request('email'), 'password' => request('password')])){
            $user = Auth::user();
            $success['token'] =  $user->createToken('nApp')->accessToken;
            return response()->json(['success' => $success, 'user' => $user], $this->successStatus);
        }
        else{
            return response()->json(['error'=>'Email / Password salah'], 401);
        }
    }
    
    public function register(Request $request)
    {
        $customMessages = [
            'email.unique' => 'Email tidak tersedia',
            'c_password.same' => 'Confirmation Password tidak cocok',
            'noHP.unique' => 'Nomor HP tidak tersedia'
        ];

        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required',
            'noHP' => 'required|unique:users',
            'c_password' => 'required|same:password',
        ], $customMessages);

        
        if ($validator->fails()) {
            return response()->json(['error'=>$validator->errors()], 401);            
        }

        $input = $request->all();
        $input['password'] = bcrypt($input['password']);
        $user = User::create($input);
        $success['token'] =  $user->createToken('nApp')->accessToken;

        return response()->json(['success' => $success, 'user' => $user], $this->successStatus);
    }

    public function details()
    {
        $user = Auth::user();
        return response()->json(['success' => $user], $this->successStatus);
    }
}