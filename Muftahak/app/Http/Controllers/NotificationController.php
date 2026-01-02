<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Notifications\Notifiable;
use App\Models\Notification;

class NotificationController extends Controller
{
    // public function indexForRented()
    // {
    //     // $notifications = Auth::user()->notifications()->orderBy('created_at', 'desc')->get();
    //     $notifications =  Auth::guard('renteds-api')->notifications()->orderBy('created_at', 'desc')->get();
    //     return response()->json($notifications);
    // }
    // public function markAsRead($id)
    // {
    //     $notification = Auth::guard('renteds-api')->notifications()->where('id', $id)->first();
    //     if ($notification) {
    //         $notification->read = true;
    //         $notification->save();
    //         return response()->json(['message' => 'Notification marked as read.']);
    //     }
    //     return response()->json(['message' => 'Notification not found.'], 404);
    // }
public function indexForRented()
{
    $user = Auth::guard('renteds-api')->user(); // جلب المستخدم
    $notifications = $user->notifications()->orderBy('created_at', 'desc')->get();
    // $this->markAllAsReadForRented();
    return response()->json($notifications);
}

public function indexForUser()
{
    $user = Auth::user(); // جلب المستخدم
    $notifications = $user->notifications()->orderBy('created_at', 'desc')->get();
    return response()->json($notifications);
}

    public function markAllAsReadForUser()
    {
        $notifications = Auth::user()->notifications()->where('read', false)->get();
        foreach ($notifications as $notification) {
            $notification->read = true;
            $notification->save();
        }
        return response()->json(['message' => 'All notifications marked as read.']);
    }
    public function markAllAsReadForRented()
    {
        $user = Auth::guard('renteds-api')->user();
        $notifications = $user->notifications()->where('read', false)->get();
        foreach ($notifications as $notification) {
            $notification->read = true;
            $notification->save();
        }
        return response()->json(['message' => 'All notifications marked as read.']);
    }
   
}
