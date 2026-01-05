<?php

namespace App\Http\Controllers;

use App\Models\Apartment;
use App\Models\UserApartment;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Artisan;

class UpdateController extends Controller
{
    function updateState(){
        $today=Carbon::today();
         $apartments = Apartment::all();

    foreach ($apartments as $apartment) {
        $isBookedToday = UserApartment::where('state', 'confirmed')
            ->where('first_date', '<=', $today)
            ->where('last_date', '>=', $today)
            ->exists();

        if ($isBookedToday) {
            $apartment->update(['status' => 'notAvailable']);
        } else {
            $apartment->update(['status' => 'available']);
        }
    }
    
        $BookedToday = UserApartment::where('state', 'confirmed')
            ->where('last_date', '<=', $today)
            ->get();
            foreach ($BookedToday as $b) {
                $b->state='ended';
                $b->save();
            }
            Artisan::call('waitings:delete-unconfirmed-records');
        return response()->json([
            'message' => 'Update process completed successfully.'
        ], 200);
    }
}
