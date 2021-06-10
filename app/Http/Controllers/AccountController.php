<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\PersonalAccessToken;
use Illuminate\Support\Facades\Auth;
class AccountController extends Controller
{
    //
    public function register(Request $request){
        $fields = $request->validate([
            'name'=>'required|string',
            'email'=>'required|string',
            'password'=>'required|string|confirmed',
        ]);
        $user = User::create([
            'name'=>$fields['name'],
            'email'=>$fields['email'],
            'password'=>bcrypt($fields['password'])
        ]);
        $token = $user->createToken('myapp')->plainTextToken;
        $response = [
            'user' =>$user,
            'token'=>$token
        ];
        return response($response,201);
    }
    public function LogOut(Request $request){
        //Auth::user()->tokens()->delete();
        /*auth()->user()->tokens()->delete();
        return [
            'message'=>'loggout successfully'
        ];*/
        //$user = Auth::user();
        //$id = Auth::id();
        //$user->where('tokenable_id ', $id)->delete();
        //$user->token()->where('id', $id)->delete();
        //auth()->user()->tokens()->delete();
        //Auth::logout();
        //$user = Auth::user();
        //$user->tokens()->where('id', $id)->delete();
        //Auth::user()->token()->delete();
        $request->user()->currentAccessToken()->delete();
        return ['msg' => 'Successfully logged out'];

    }
    public function login(Request $request){
        //try {
          $fields = $request->validate([
              //'name'=>'required|string',
              'email'=>'required|string',
              'password'=>'required|string',
          ]);
          /*
          if($fields->fails()){
            return response([
                'message'=>'invalid data'
            ],401);
          }*/
          $user = User::where('email',$fields['email'])->first();
          if(!$user || ! Hash::check($fields['password'],$user->password)){
              return response([
                  'message'=>'invalid log in'
              ]);
          }
          $token = $user->createToken('myapp')->plainTextToken;
          $response = [
              'user' =>$user,
              'token'=>$token
          ];
          return response($response,201);
        /*} catch (\Exception $e) {
          return response([
            'mess'=>'error'
          ]);
        }*/

    }
}
