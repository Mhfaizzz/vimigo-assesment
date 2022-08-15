<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class loginController extends Controller
{
    //
    public function login(Request $request){
        $login = $request->validate([
            'email' => 'required|string',
            'password' => 'required|string',
        ]);

        // $data = $request->all();
        // $email = $data['email'];
        // $password = $data['password'];
      

        // if(Auth::attempt(['email' => $email, 'password' => $password])){
        //     return response(['message'=> ' Berjaya la pulak']);
        // }

        // if (!Auth::attempt($login)){
        //     //$accessToken = Auth::user()->createToken('MyToken')->accessToken;
        //    // return response(['user' => Auth::user(), 'MyToken' => $accessToken]);
        //    return response(['message'=> 'Apa berlaku', $login]);
        // }
        
        if(!Auth::attempt($login)){
            return response(['message'=> 'Success']);
        }
        
        return response(['message'=> 'Invalid login credentials']);
    }

    // public function getUser (){
    //     $data = User::all();
    //     return response(['result' => $data]);

    // }

    public function addUser(Request $request){
        $input = $request->all();

        
    }
}
