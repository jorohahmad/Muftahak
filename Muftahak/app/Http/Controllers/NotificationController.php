<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    public function indexForUser(){
        $user=Auth::user();
        $notifications=$user->notifications()->orderBy('created_at','desc')->get();
        Artisan::call('waitings:delete-unconfirmed-records');
        return response()->json($notifications,201);
    }
    public function indexForRented(){
        $user=Auth::guard('renteds-api')->user();
        $notifications=$user->notifications()->orderBy('created_at','desc')->get();
        Artisan::call('waitings:delete-unconfirmed-records');
        return response()->json($notifications,201);
    }
     
    public function markAllAsReadForUser(){
        $notifications=Auth::user()->notifications()->where('read',false)->get();
        foreach($notifications as $notification){
            $notification->read=true;
            $notification->save();
        }
        Artisan::call('waitings:delete-unconfirmed-records');
        return response()->json([
            'message'=>'All notifications marked as read successfully'
        ],201);
    }

    public function markAllAsReadForRented(){
        $notifications=Auth::guard('renteds-api')->user()->notifications()->where('read',false)->get();
        foreach($notifications as $notification){
            $notification->read=true;
            $notification->save();
        }
        Artisan::call('waitings:delete-unconfirmed-records');
        return response()->json([
            'message'=>'All notifications marked as read successfully'
        ],201);
    }
}
