<?php

namespace App\Http\Controllers;

use App\Models\Apartment;
use App\Models\UserApartment;
use App\Models\Waiting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WaitingController extends Controller
{
    function storeTemporary(Request $request){
       $validate= $request->validate([
            'first_date'=>'required|string',
            'last_date'=>'required|string',
            'location'=>'required|string',
            'id_credit_card'=>'required|string',
            'apartment_id'=>'required|exists:apartments,id'
        ]);
        $validate['user_id']=Auth::user()->id;
        $validate['rented_id']=Apartment::findOrFail($request->apartment_id)->rented->id;
        $w=Waiting::create($validate);
        Apartment::findOrFail($request->apartment_id)->update([
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
