<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller


{
    public function register(Request $request){
        $request->validate([
            'name' => 'required|string',
            'email' =>  'required|string|unique:users',
            'password' => 'required|string|min:6'
        ]);

         $user = new User([
            'name' => $request->name,
            'email'=> $request->email,
            'password'=> Hash::make($request->password),
         ]);

         $user->save();
         return response()->json(['message','Kullanıcı kaydedildi'],200);
    }


    public function login(Request $request){
        $request->validate([
            'email'=>'required',
            'password'=> 'required|string',
        ]);

        $creds=request(['email','password']);
        if(!Auth::attempt($creds)){
            return response()->json(['message','Unauthorized'],401);
        }

        $user=User::where('email',$creds['email'])->first();
        $user->tokens()->delete();
        return response()->json([
            'access_token' => $user->createToken('api_token')->plainTextToken,
            'token_type' => 'Bearer',
        ]);

    }

}
