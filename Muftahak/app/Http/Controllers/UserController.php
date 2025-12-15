<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
  
   function login(Request $request)
   {
      $request->validate([
         'phoneNumber' => 'required',
         'password' => 'required',
      ]);
      $user = User::where('phoneNumber', $request->phoneNumber)->firstOrFail();
      if (! $user || !Hash::check($request->password, $user->password)) {
         return response()->json([
            'message' => 'login not successful'
         ], 401);
      }

      $token = $user->createToken('auth-token')->plainTextToken;

      return response()->json([
         'message' => 'user login successfully',
         'user' => $user,
         'Token' => $token
      ], 200);
   }
   function index($email)
   {
      $user = User::where('email', $email)->firstOrFail();
      return response()->json([
         'user' => $user,
      ]);
   }
}
