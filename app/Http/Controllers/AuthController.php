<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;

class AuthController extends Controller
{

//register logic
    public function register(Request $request){
        $valided=$request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|unique:users',
            'password' => 'required|string|min:8',
        ]);
        $user=User::create([
            'name'=> $valided['name'],
            'email'=> $valided['email'],
            'password'=> hash::make($valided['password']),
            'role'=>'customer',
        ]);
        return response()->json([
            'status'=> 'success',
            'message'=> 'Register successful',
            'user'=>$user,
        ], 201);
    }

    //login logic
    public function login(Request $request){
        $validated = $request->validate([
        'email' => 'required|email',
        'password' => 'required',
        ]);

        $user=User::where('email',$validated['email'])->first();

        if($user || !Hash::check($validated['password'], $user->password)){
            return response()->json(['message'=>'Password invalid'],401);
        }

        $token = $user->createToken('api-token')->plainTextToken;

         return response()->json([
        'message' => 'Login successful',
        'token' => $token,
        'user' => $user,
    ]);
    }
}
