<?php

namespace App\Http\Controllers;

use App\Models\Apartment;
use App\Models\Notification;
use App\Models\User;
use App\Models\UserApartment;
use App\Models\Waiting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{

    public function getHistoryOfUser()
    {
        $id = Auth::user()->id;
        $w = Waiting::where('user_id', $id)->where('confirmed', 'false')->get();
        $ap = UserApartment::where('user_id', $id)->get();

        $all = $w->concat($ap);
        foreach ($all as $item) {
            $title = Apartment::findOrFail($item->apartment_id)->title;
            $image = Apartment::findOrFail($item->apartment_id)->image1;
            $item = $item->setAttribute('apartment_image', url(Storage::url('K/'.$image)));
            $item = $item->setAttribute('apartment_title', $title);
        }
        Artisan::call('waitings:delete-unconfirmed-records');
        return response()->json($all,200);
    }
    public function updateBookingForUser(Request $request)
    {
        $app = UserApartment::find($request->id);
        $request['location'] = $app->location;
        $request['id_credit_card'] = $app->id_credit_card;
        $request['apartment_id'] = $app->apartment_id;
        $request['update'] = 'true';
        $e = new WaitingController();
        $e->storeTemporary($request);
        Notification::create([
            'user_id' => $app->user_id,
            'rented_id' => Apartment::findOrFail($app->apartment_id)->rented->id,
            'type' => '',
            'data' => 'You have a new update booking request to review.',
            'read' => false
        ]);
        Artisan::call('waitings:delete-unconfirmed-records');
        return response()->json([
            'message' => 'the update request has been sent successfully'
        ], 200);
      
    }

    public function addToFavorites(Request $request)
    {
        $user = Auth::user();
        try{
        $user->favoriateApartments()->attach($request->apartment_id);
        Artisan::call('waitings:delete-unconfirmed-records');
        return response()->json([
            'message' => 'Apartment added to favorites successfully.'
        ], 200);}
        catch(\Exception $e){
            return response()->json([
                'message' => 'Apartment is already in favorites.'
            ], 200);
        }
    }
    public function removeFromFavorites(Request $request)
    {
        $user = Auth::user();
        $user->favoriateApartments()->detach($request->apartment_id);
        Artisan::call('waitings:delete-unconfirmed-records');
        return response()->json([
            'message' => 'Apartment removed from favorites successfully.'
        ], 200);
    }
    public function getFavoritesApartments(){
        $user = Auth::user();
        $favorites = $user->favoriateApartments;
          foreach ($favorites as $item) {
            $item->image1 = url(Storage::url('K/'.$item->image1));
        }
        return response()->json($favorites, 200);
    }
    public function rateApartment(Request $request)
    {
        $user = Auth::user();
        $apartment=Apartment::findOrFail($request->apartment_id);
        try{
        $user->ratingApartments()->attach($request->apartment_id, ['value' => $request->value]);
        // Recalculate average rating
        $totalRatings = $apartment->rateByUser()->count();
        $sumRatings = $apartment->rateByUser()->sum('value');
        $averageRating = $sumRatings / $totalRatings;
        $apartment->rate = $averageRating;   
        $apartment->save();
        Artisan::call('waitings:delete-unconfirmed-records');
        return response()->json([
            'message' => 'Apartment rated successfully.'
        ], 200);}
        catch(\Exception $e){
            return response()->json([
                'message' =>$apartment-> rateByUser()->count()
            ], 200);
        }
    }
    public function unrateApartment(Request $request)
    {
        $user = Auth::user();
        $user->ratingApartments()->detach($request->id);
        Artisan::call('waitings:delete-unconfirmed-records');
        return response()->json([
            'message' => 'Apartment unrated successfully.'
        ], 200);
    }
    
}
