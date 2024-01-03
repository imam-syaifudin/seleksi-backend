<?php

namespace App\Http\Controllers;

use App\Models\User;
use Exception;
use Illuminate\Http\Request;

// use App\Http\Controllers\Controller;


class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login']]);
    }

    public function me()
    {
        return response()->json(auth()->user());
    }
    

    public function index()
    {
        //
        try {     
            $user = User::all();
            return response()->json([
                "data" => $user
            ],200);
        } catch(Exception $error){
            return response()->json([
                "error" => 'no user found'
            ],404);

        }
    }

    public function register(Request $request){
        
        try {
            
            
            $user = User::create([
                'username' => $request->username,
                'password' => bcrypt($request->password),
            ]);

            return response()->json([
                'Response' => $user
            ],201);

        } catch(Exception $error){
            return response()->json([
                'error' => $error
            ],201);
        }



    }

    

    public function login(Request $request)
    {

    
        if ( !$token = auth()->attempt($request->only('username','password'))){
            return response()->json([
                'error' => 'Invalid Username Or Password'
            ],422);
        }

        return response()->json([
            'token' => $token
        ],200);

    }

    public function show($id){
        try {
            $user = User::findOrFail($id);
            return response()->json([
                $user   
            ]);
        } catch(Exception $error){
            return response()->json([
                'error' => 'user not found'   
            ],422);

        }


    }

    public function update(Request $request,$id){
        
        try {
            
            $user = User::findOrFail($id);

            $user->update([
                'username' => $request->username,
                'password' => $request->password == null ? $user->password : bcrypt($request->password),
            ]);

            return response()->json([
                'Response' => $user
            ],201);

        } catch(Exception $error){
            return response()->json([
                'error' => 'user not found'
            ],422);
        }

    }

    public function delete($id){
        $user = User::findOrFail($id);
        $user->delete();
        // try {
        //     $user = User::findOrFail($id);
        //     $user->delete();
        //     return response()->json([
        //         'success' => 'Data Deleted Succesfully'
        //     ],200);
        // } catch(Exception $error){

        //     return response()->json([
        //         'error' => 'user not found'
        //     ],404);


        // }

    }


}
