<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use App\Imports\UsersImport;
use App\Imports\UsersUpdateImport; 
use App\Imports\UsersDeleteImport; 
use Maatwebsite\Excel\Facades\Excel;

class ApiController extends Controller
{
    //login with laravel passport
    public function loginUser(Request $request){
        
        //dd($request->all());

        //form request validation
        $login = $request->validate([
            'email' => 'required|string',
            'password' => 'required|string',
        ]);

        //authentication process
        if (Auth::attempt($login)){
            $accessToken = Auth::user()->createToken('MyToken')->accessToken; //create personal token to the authorized user
            return response(['user' => Auth::user(), 'MyToken' => $accessToken]);
            return response(['message'=> 'Login Success', $login]);
        }
        
        return response(['message'=> 'Invalid login credentials']);
    }

    //only user with personal token can access it
    //Retrieve all user profiles
    public function profile (){
        
       return User::all();
    }

    public function create(Request $req){

        //input validation
        $req -> validate([ 
            'name' => 'required|string',
            'email' => 'required|string',   
            'password' => 'required|string',
        ]);

        $data = $req->all();
    
        //create user
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']), //encrypt the password using Hash
            'created_at' => NOW(),
            'updated_at' => NOW()
        ]);

        return response ([
            'data' => $user
        ]);
    }

    //Update users by id
    public function update (Request $req, $id){

        $user = User::find($id); 

        //input validation
        $req -> validate([ 
            'name' => 'required|string',
            'email' => 'required|string',   
            'password' => 'required|string',
        ]);

        $data = $req->all();

        //update the user based on the id
        $user ->update([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'updated_at' => NOW(), //current timestamp
        ]);

        //display the latest user profile
        return $user;

    }


    //Delete user by id
    public function destroy($id)
    {
        $user = User::find($id)->delete();
        
        return [
            'success'
        ];
    }

    //Filter by name or email, records pagination
    public function filter (Request $req){

        if($req->name){
            //sql query retrieve name and email
            $list = DB::table('users')
                        ->select('name','email')
                        ->where('name', '=', $req->name)
                        ->paginate(5); //pagination 5 records per page
        }
        if($req->email){
            $list = DB::table('users')
                        ->select('name','email')
                        ->where('email', '=', $req->email)
                        ->paginate(5); //pagination 5 records per page
                        
        }
        
        return response(['List'=> $list]);
       
    }


    //create users in bulk, import csv file
    public function createUsers (Request $req){

        Excel::import(new UsersImport, $req->file('file'));

        return response ([ 'message' => 'Users successfully created']);
    }

    //update users in bulk according to the id, import csv file
    public function updateUsers (Request $req){

        Excel::import(new UsersUpdateImport, $req->file('file'));

        return response ([ 'message' => 'Users successfully updated']);
    }

    //delete users in bulk according to the id, import csv file
    public function deleteUsers (Request $req){

        Excel::import(new UsersDeleteImport, $req->file('file'));

        return response ([ 'message' => 'Users successfully deleted']);
    }
}
