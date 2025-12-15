<?php

namespace App\Http\Controllers;

use App\Models\Rented;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RentedController extends Controller
{
      function register(Request $request)
   {
      $request->validate([
         'firstName' => 'required|string',
         'password' => 'required|string|min:8|confirmed'
      ]);
      $user = Rented::create([
         'firstName' => $request->firstName,
         'password' => Hash::make($request->password)
      ]);
      // Mail::to($user->email)->send(new WelcomMail($user));
      return response()->json([
         'message' => 'user Registered successfully',
         'user' => $user
      ], 201);
   }
   function login(Request $request)
   {
      $request->validate([
         'firstName'=>'required',
         'password' => 'required'
      ]);
      $user=Rented::where('firstName',$request->firstName)->firstOrFail();
      if(! $user || !Hash::check($request->password,$user->password))
         return response()->json([
      'message'=>'login not successful'
         ],401);
         $token=$user->createToken('auth-token')->plainTextToken;

               return response()->json([
         'message' => 'user login successfully',
         'user' => $user,
         'Token'=>$token
      ], 200);
   }
}
