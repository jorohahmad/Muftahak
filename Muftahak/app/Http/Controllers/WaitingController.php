<?php

namespace App\Http\Controllers;

use App\Models\Apartment;
use App\Models\UserApartment;
use App\Models\Waiting;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WaitingController extends Controller
{
    function storeTemporary(Request $request){
       $validate= $request->validate([
            'first_date'=>'required|date|after_or_equal:today',
            'last_date'=>'required|date|after:first_date',
            'location'=>'required|string',
            'id_credit_card'=>'required|string',
            'apartment_id'=>'required|exists:apartments,id'
        ]);
        $apartment=$request->apartment_id;
        $startDate=new Carbon($request->first_date);
        $endDate=new Carbon($request->last_date);
        // Check for overlapping bookings
        $overlappingBooking = UserApartment::where('apartment_id', $apartment)
            ->where(function ($query) use ($startDate, $endDate) {
                $query->whereBetween('first_date', [$startDate, $endDate])
                      ->orWhereBetween('last_date', [$startDate, $endDate])
                      ->orWhere(function ($query) use ($startDate, $endDate) {
                          $query->where('first_date', '<=', $startDate)
                                ->where('last_date', '>=', $endDate);
                      });
            })->first();
        if ($overlappingBooking) {
            return response()->json([
                'message' => 'Overlapping booking found'
            ],409);
        }
            // No overlapping bookings found, proceed to create the temporary booking
        $validate['user_id']=Auth::user()->id;
        $validate['rented_id']=Apartment::findOrFail($apartment)->rented->id;
        $w=Waiting::create($validate);
        Apartment::findOrFail($apartment)->update([
            'status'=>'notAvailable'
        ]);
        return response()->json([
                'message'=>'the booking has been temporarily made'
            ],201);
    }

    public function storeBookingFromUser(Request $request){
        $waiting=Waiting::where('user_id',Auth::user()->id)->where('confirmed','false')->where('apartment_id',$request->apartment_id)->first();
        if(!$waiting){
            return response()->json([
                'message'=>'no temporary booking found'
            ],404);
        }
        $waiting->confirmed='true';
        $waiting->save();
        UserApartment::create([
            'user_id'=>$waiting->user_id,
            'apartment_id'=>$waiting->apartment_id,
            'first_date'=>$waiting->first_date,
            'last_date'=>$waiting->last_date,
            'location'=>$waiting->location,
            'id_credit_card'=>$waiting->id_credit_card,
            'state'=>'pending'
        ]);
        return response()->json([
            'message'=>'the booking has been confirmed successfully'
        ],200);
    }   

    public function cancelBookingFromUser(Request $request){
        $waiting=Waiting::where('user_id',Auth::user()->id)->where('confirmed','false')->where('apartment_id',$request->apartment_id)->first();
        if(!$waiting){
            return response()->json([
                'message'=>'no temporary booking found'
            ],404);
        }
        Apartment::findOrFail($request->apartment_id)->update([
            'status'=>'Available'
        ]);
        $waiting->delete();
        return response()->json([
            'message'=>'the temporary booking has been cancelled successfully'
        ],200);
    }
     

}
