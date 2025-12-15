<?php

namespace App\Http\Controllers;

use App\Models\UserAdmin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserAdminController extends Controller
{
    function register(Request $request)
    {
        $validated = $request->validate([
            'firstName' => 'required|string',
            'phoneNumber' => 'required|unique:user_admins,phoneNumber',
            'password' => 'required|string|min:8|confirmed',
            'personalImage' => 'required|image|max:2048|mimes:png,jpeg,jpg,gif',
            'personalIdImage' => 'required|image|max:2048|mimes:png,jpeg,jpg,gif',
            'role' => 'required|string|in:rented,tenant'
        ]);
        if ($request->hasFile('personalImage')) {
            $path = $request->file('personalImage')->store('M', 'public');
            $path=str_replace('M/','',$path);
            $validated['personalImage'] = $path;
        }
        if ($request->hasFile('personalIdImage')) {
            $path = $request->file('personalIdImage')->store('N', 'public');
            $path=str_replace('N/','',$path);
            $validated['personalIdImage'] = $path;
        }
        $validated['password'] = Hash::make($request->password);
        $user = UserAdmin::create($validated);
        // Mail::to($user->email)->send(new WelcomMail($user));
        return response()->json([
            'message' => 'the application was successfully recorded',
            'user' => $user
        ], 200);
    }
    //for admin
   
}
