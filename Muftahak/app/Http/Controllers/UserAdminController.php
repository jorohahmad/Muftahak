<?php

namespace App\Http\Controllers;

use App\Models\Rented;
use App\Models\User;
use App\Models\UserAdmin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserAdminController extends Controller
{
    function register(Request $request)
    {
        $validated = $request->validate([
            'firstName' => 'required|string',
            'phoneNumber' => 'required|unique:user_admins,phoneNumber',
            'password' => 'required|string|min:8|confirmed',
            // 'personalImage' => 'required|string',
            // 'personalIdImage' => 'required|string',
            'role' => 'required|string|in:rented,tenant'
        ]);
        // if ($request->hasFile('personalImage')) {
        //     $path = $request->file('personalImage')->store('M', 'public');
        //     $path = str_replace('M/', '', $path);
        //     $validated['personalImage'] = $path;
        // }
        // if ($request->hasFile('personalIdImage')) {
        //     $path = $request->file('personalIdImage')->store('N', 'public');
        //     $path = str_replace('N/', '', $path);
        //     $validated['personalIdImage'] = $path;
        // }
        $personalImage=base64_decode($request->personalImage);
        $personalImageName=time().'.jpg';
        $path1=storage_path('app/public/M'.$personalImageName);
        file_put_contents($path1,$personalImage);
        $validated['personalImage'] = 'storage/M'.$path1;

        $personalIdImage=base64_decode($request->personalImage);
        $personalIdImageName=time().'.jpg';
        $path=storage_path('app/public/N'.$personalIdImageName);
        file_put_contents($path,$personalIdImage);
        $validated['personalIdImage'] = 'storage/M'.$path;

        $validated['password'] = Hash::make($request->password);
        $user = UserAdmin::create($validated);
        // Mail::to($user->email)->send(new WelcomMail($user));
        return response()->json([
            'message' => 'the application was successfully recorded',
            'user' => $user
        ], 200);
    }
    //for admin
    function showUsersAdmin()
    {
        return UserAdmin::all();
    }


    //login
    function login(Request $request)
    {
        $request->validate([
            'phoneNumber' => 'required',
            'password' => 'required',
        ]);

        $user = User::where('phoneNumber', $request->phoneNumber)->first();
        if ($user) {
            if (! $user || !Hash::check($request->password, $user->password)) {
                return response()->json([
                    'message' => 'user login not successful because you password not valid'
                ], 401);
            }

            $token = $user->createToken('auth-token')->plainTextToken;

            return response()->json([
                'message' => 'user login successfully',
                'user' => $user,
                'Token' => $token
            ], 200);
        }

        $user = Rented::where('phoneNumber', $request->phoneNumber)->first();
        if ($user) {
            if (! $user || !Hash::check($request->password, $user->password))
                return response()->json([
                    'message' => 'rented login not successful because you password not valid'
                ], 401);
            $token = $user->createToken('auth-token')->plainTextToken;

            return response()->json([
                'message' => 'rented login successfully',
                'user' => $user,
                'Token' => $token
            ], 200);
        }
        return response()->json([
            'message' => 'not found'
        ], 404);
    }

    //logout
    function logout(Request $request)
    {
        $rented = $request->user('renteds-api');
        if ($rented) {
            $rented->currentAccessToken()->delete();
            return response()->json([
                'message' => 'rented logout successfully',
            ], 200);
        }
        $user = Auth::user();
        if ($user) {
            $request->user()->currentAccessToken()->delete();
            return response()->json([
                'message' => 'user logout successfully',
            ], 200);
        }
    }

    public function getInfoUser()
    {

        $user = Auth::user();
        if ($user) {
            return response()->json([
                'user' => $user
            ], 200);
        } else {
            $rented =  Auth::guard('renteds-api')->user();
            return response()->json([
                'user' => $rented
            ], 200);
        }
    }
}
