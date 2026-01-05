<?php

namespace App\Http\Controllers;

use App\Models\NotificationUser;
use App\Models\Rented;
use App\Models\User;
use App\Models\UserApartment;
use App\Models\Waiting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class RentedController extends Controller
{
   function getAllRequestsFromWaiting()
   {
      $rentedId = Auth::guard('renteds-api')->user()->id;
      $w = Waiting::where('rented_id', $rentedId)->where('confirmed', 'true')->get();
      foreach ($w as $name) {
         $first = User::findOrFail($name->user_id)->firstName;
         $last = User::findOrFail($name->user_id)->lastName;
         $personalImage=Storage::url('M/'.User::findOrFail($name->user_id)->personalImage);
         $p=url($personalImage);
         $name = $name->setAttribute('user_name', $first . ' ' . $last);
         $name = $name->setAttribute('personal_image', $p);
      }
      Artisan::call('waitings:delete-unconfirmed-records');
      return response()->json($w, 200);
   }
   public function acceptBooking(Request $request)
   {
      $rentedId = Auth::guard('renteds-api')->user()->id;
      $w=Waiting::findOrFail($request->id);
      $userId = $w->user_id;
      // Update the state in user_apartment table
      $userApartment = UserApartment::where('user_id', $userId)->where('apartment_id', $w->apartment_id)->where('first_date', $w->first_date)->where('last_date', $w->last_date)->first();
     if($w->update==='true')
     {
       $app = UserApartment::where('user_id', $userId)->where('apartment_id', $w->apartment_id)->where('update','false')->first();
         if ($app) {
            $app->delete();
         }
     }
      if ($userApartment) {
         $userApartment->state = 'confirmed';   
         $userApartment->save();
         $w->delete();
      }
      NotificationUser::create([
         'user_id' => $userId,
         'rented_id' => $rentedId,
         'type' => "",
         'data' => 'Your booking  has been accepted.',
         'read' => false,
      ]);
      Artisan::call('waitings:delete-unconfirmed-records');
      return response()->json([
         'message' => 'Booking accepted successfully'
      ], 200);
   }
      public function refuseBooking(Request $request)
   {
      $rentedId = Auth::guard('renteds-api')->user()->id;
      $w=Waiting::findOrFail($request->id);
      $userId = $w->user_id;
      // Update the state in user_apartment table
      $userApartment = UserApartment::where('user_id', $userId)->where('apartment_id', $w->apartment_id)->where('first_date',$w->first_date)->where('last_date',$w->last_date)->first();
      if ($userApartment) {
         $userApartment->state = 'canceled';   
         $userApartment->save();
         $w->delete();
      }
       NotificationUser::create([
         'user_id' => $userId,
         'rented_id' => $rentedId,
         'type' => "",
         'data' => 'Your booking  has been accepted.',
         'read' => false,
      ]);
      Artisan::call('waitings:delete-unconfirmed-records');
      return response()->json([
         'message' => 'Booking refused successfully'
      ], 200);
   }
}
