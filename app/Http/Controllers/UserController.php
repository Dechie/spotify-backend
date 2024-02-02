<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    //
    public function show(Request $request) {
        $user = $request->user();
        return response()->json($user);

    }
    public function store(Request $request) {
        //dd($request->input('email'));
       $validData = $request->validate([
        'name'=> 'required',
        'email' => 'required|email|unique:users',
        'password' => 'required',

       ]); 
       //dd($validData);

       $user = new User();
       $user->name = $validData['name'];
       $user->email = $validData['email'];
       $user->password = $validData['password'];

       $user->save();
       $token = $user->createToken('AuthToken')->plainTextToken;
       return response()->json([
        'message' => 'successful',
        'token' => $token,
        ], 201);
    }
   
}
