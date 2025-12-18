<?php

namespace App\Http\Controllers;

use App\Models\Apartment;
use Illuminate\Http\Request;

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
        return response()->json($apartments, 200);
    }
}
