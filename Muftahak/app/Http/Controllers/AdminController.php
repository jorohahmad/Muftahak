<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Rented;
use App\Models\User;
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
        $rented = Rented::all();
        $tenant = User::all();
        $allUsers = $tenant->merge($rented);
        return view('users',['collection'=>$allUsers]);
    }
    
     function acceptRegister( $id)
    {
        $user=UserAdmin::where('id',$id)->firstOrFail();
       
        // dd($user->boolean);
        if($user->role=='rented')
        {
            Rented::create([
            'firstName'=>$user->firstName,
            'lastName'=>$user->lastName,
            'birthday'=>$user->birthday,
            'phoneNumber'=>$user->phoneNumber,
            'personalImage'=>$user->personalImage,
            'personalIdImage'=>$user->personalIdImage,
            'role'=>$user->role,
            'password'=>$user->password,
        ]);}
        if($user->role=='tenant')
        { User::create([
            'firstName'=>$user->firstName,
            'lastName'=>$user->lastName,
            'birthday'=>$user->birthday,
            'phoneNumber'=>$user->phoneNumber,
            'personalImage'=>$user->personalImage,
            'personalIdImage'=>$user->personalIdImage,
            'role'=>$user->role,
            'password'=>$user->password,
        ]);}
        // ممكن تعديل 
        // $user->delete();
        //  $user->boolean="true";
        //  dd($user->boolean);
        $user->update(['boolean'=>'true']);
        return redirect()->route('requestRegister',1);
    }
    


    //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    public  function deleteRequest($id)
    {
        $user = UserAdmin::findOrFail($id);
        $user->update(['boolean'=>'true']);
        // return redirect()->back()->with('success', 'User deleted successfully.');
        $users = UserAdmin::all();
        return view('requests', ['collection' => $users]);
    }
    public  function deleteUsers($id,$users)
    {
        // dd($users,$id);
        if($users=="rented")
            {
                $user = Rented::findOrFail($id);
                
            }
            else{
                $user = User::findOrFail($id);
            }
            // dd($user);
        $user->delete();
             
        // return redirect()->back()->with('success', 'User deleted successfully.');
        $users = Rented::all()->merge(User::all());
        return view('users', ['collection' => $users]);
    }
   }
