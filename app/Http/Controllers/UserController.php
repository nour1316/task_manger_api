<?php

namespace App\Http\Controllers;

use App\Http\Requests\requestLogin;
use App\Http\Requests\requestRegister;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{



public function register(requestRegister $request){

$user=User::create(
  [
    'name'=> $request->name,
    'email'=> $request->email,
    'password'=> Hash::make($request->password),
  ]);
  return response()->json($user,201);

}






public function login( requestLogin $request ){

if (!Auth::attempt($request->only('password','email')))
return response()->json('messag you  are faill', 200);

$user=User::where ('email',$request->email)->firstorfail();
 $token=$user->createToken('auth_token')->plainTextToken;
return response()->json(['message'=>'you  are in',
                            'token'=>$token], 200);
}




public function logout(Request $request){
$request->user()->currentAccessToken()->delete();
return response()->json(['message'=>'logout success',
                          'token'=>'deeleted'], 204);

}











  public  function getProfile(){

  $profile=Auth::user()->profile;
    return response()->json($profile,200);

  }


  public function getUserTasks(){
  $tasks =Auth::user()->tasks;
  return response()->json($tasks,200);

  }
}
