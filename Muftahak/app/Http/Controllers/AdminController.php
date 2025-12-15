<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\UserAdmin;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'idNumber' => 'required|string|max:200',
            'password' => 'required|string'
        ]);
        // $t=request()->_token;
        $admin = Admin::where('idNumber', request()->idNumber)->first();
        if (!$admin) {
            // return back()->with('error', 'رقم الهوية غير موجود');
             return back()->with('error', 'كلمة المرور غير صحيحة');
        }
        if (!(request()->password == $admin->password)) {

    
                // return back()->with('error', 'كلمة المرور غير صحيحة');
            return back()->with('error', 'كلمة المرور غير صحيحة');
        }
        $p = UserAdmin::all();
        return view('users',['collection'=>$p]);
    }
    
   }
