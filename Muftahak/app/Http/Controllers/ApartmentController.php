<?php

namespace App\Http\Controllers;

use App\Models\Apartment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Storage;

class ApartmentController extends Controller
{
    function filterApartments(Request $request) {
        $query=Apartment::query();
        $query->when($request->governorate && $request->governorate !== 'All', function($q) use ($request) {
            $q->where('governorate', $request->governorate);
        });
        $query->when($request->city && $request->city !== 'All', function($q) use ($request) {
            $q->where('city', $request->city);
        });
        $query->when($request->min_price && $request->min_price !== 0, function($q) use ($request) {
            $q->where('price', '>=', $request->min_price);
        });
        $query->when($request->max_price && $request->max_price !== 0, function($q) use ($request) {
            $q->where('price', '<=', $request->max_price);
        });
        $apartments = $query->get();
         foreach ($apartments as $name) {
            $name->image1=url(Storage::url('K/'.$name->image1));
            $name->image2=url(Storage::url('K/'.$name->image2));
            $name->image3=url(Storage::url('K/'.$name->image3));
            $name->image4=url(Storage::url('K/'.$name->image4));
            $name->image5=url(Storage::url('K/'.$name->image5));
         }
         Artisan::call('waitings:delete-unconfirmed-records');
        return response()->json($apartments, 200);
    }
    //not needed now
    public function getApartment($title)
    {
        $apartment = Apartment::where('title', $title)->first();
        if ($apartment) {
            return response()->json($apartment, 200);
        } else {
            return response()->json(['message' => 'Apartment not found'], 404);
        }
    }
    
}
