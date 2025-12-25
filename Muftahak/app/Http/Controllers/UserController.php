<?php

namespace App\Http\Controllers;

use App\Models\Apartment;
use App\Models\User;
use App\Models\UserApartment;
use App\Models\Waiting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{

    function register(Request $request)
    {
        $validated = $request->validate([
            'firstName' => 'required|string',
            'phoneNumber' => 'required|unique:users,phoneNumber',
            'password' => 'required|string|min:8|confirmed',
            'personalImage' => 'required|image|max:2048|mimes:png,jpeg,jpg,gif',
            'personalIdImage' => 'required|image|max:2048|mimes:png,jpeg,jpg,gif',
            // 'role' => 'required|string|in:rented,tenant'
        ]);
        if ($request->hasFile('personalImage')) {
            $path = $request->file('personalImage')->store('personalImage', 'public');
            $validated['personalImage'] = $path;
        }
        if ($request->hasFile('personalIdImage')) {
            $path = $request->file('personalIdImage')->store('personalIdImage', 'public');
            $validated['personalIdImage'] = $path;
        }
        $validated['password'] = Hash::make($request->password);
        $user = User::create($validated);
        // Mail::to($user->email)->send(new WelcomMail($user));
        return response()->json([
            'message' => 'the application was successfully recorded',
            'user' => $user
        ], 200);
    }
    function index($email)
    {
        $user = User::where('email', $email)->firstOrFail();
        return response()->json([
            'user' => $user,
        ]);
    }
    public function getHistoryOfUser()
    {
        $id = Auth::user()->id;
        $w = Waiting::where('user_id', $id)->where('confirmed', 'false')->get();
        $ap = UserApartment::where('user_id', $id)->get();

        $all = $w->concat($ap);
        foreach ($all as $item) {
            $title = Apartment::findOrFail($item->apartment_id)->title;
            $image = Apartment::findOrFail($item->apartment_id)->image1;
            $item = $item->setAttribute('apartment_image', $image);
            $item = $item->setAttribute('apartment_title', $title);
        }
        return response()->json([
            'message' => 'history retrieved successfully',
            'history' => $all
        ]);
    }
    public function updateBookingForUser(Request $request)
    {
        // $userId=Auth::user()->id;
        //    $app= UserApartment::where('user_id',$userId)->where('apartment_id',$request->apartment_id)->first();
        $app = UserApartment::find($request->id);
        $request['location'] = $app->location;
        $request['id_credit_card'] = $app->id_credit_card;
        $request['apartment_id'] = $app->apartment_id;

        $e = new WaitingController();
        $e->storeTemporary($request);
        return response()->json([
            'message' => 'the booking has been updated temporarily'
        ], 200);
      
    }
}
