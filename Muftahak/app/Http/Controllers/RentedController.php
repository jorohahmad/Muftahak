<?php

namespace App\Http\Controllers;

use App\Models\Rented;
use App\Models\User;
use App\Models\UserApartment;
use App\Models\Waiting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
         'firstName' => 'required',
         'password' => 'required'
      ]);
      $user = Rented::where('firstName', $request->firstName)->firstOrFail();
      if (! $user || !Hash::check($request->password, $user->password))
         return response()->json([
            'message' => 'login not successful'
         ], 401);
      $token = $user->createToken('auth-token')->plainTextToken;

      return response()->json([
         'message' => 'user login successfully',
         'user' => $user,
         'Token' => $token
      ], 200);
   }
   function getAllRequestsFromWaiting()
   {
      $rentedId = Auth::guard('renteds-api')->user()->id;
      $w = Waiting::where('rented_id', $rentedId)->where('confirmed', 'true')->get();
      foreach ($w as $name) {
         $first = User::findOrFail($name->user_id)->firstName;
         $last = User::findOrFail($name->user_id)->lastName;
         $personalImage=User::findOrFail($name->user_id)->personalImage;
         $name = $name->setAttribute('user_name', $first . ' ' . $last);
         $name = $name->setAttribute('personal_image', $personalImage);
      }
      return response()->json([
         'message' => 'Requests retrieved successfully',
         'requests' => $w
      ], 200);
   }
   public function acceptBooking(Request $request)
   {
      $w = Waiting::where('confirmed', 'true')->find($request->id);
      $userId = $w->user_id;
      // Update the state in user_apartment table
      $userApartment = UserApartment::where('user_id', $userId)->where('apartment_id', $w->apartment_id)->first();
      if ($userApartment) {
         $userApartment->state = 'confirmed';   
         $userApartment->save();
         $w->delete();
      }
      return response()->json([
         'message' => 'Booking accepted successfully'
      ], 200);
   }
      public function refuseBooking(Request $request)
   {
       $w = Waiting::where('confirmed', 'true')->find($request->id);
      $userId = $w->user_id;
      $userId = $w->user_id;
      // Update the state in user_apartment table
      $userApartment = UserApartment::where('user_id', $userId)->where('apartment_id', $w->apartment_id)->first();
      if ($userApartment) {
         $userApartment->state = 'canceled';   
         $userApartment->save();
         $w->delete();
      }
      return response()->json([
         'message' => 'Booking refused successfully'
      ], 200);
   }
}
