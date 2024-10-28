<?php

namespace App\Http\Controllers;

// use App\Models\Admin;
// use App\Http\Requests\StoreAdminRequest;
// use App\Http\Requests\UpdateAdminRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;


class AdminController extends Controller
{
    
    public function AdminLogin()
    {
        return view('admin.login');
    }
    //End method

    public function AdminDashboard()
    {
        return view('admin.admin_dashboard');
    }
    //End method

    public function AdminLoginSubmit(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);
        $check = $request->all();
        $data = [
            'email' => $check['email'],
            'password' => $check['password'],
        ];
        if (Auth::guard('admin')->attempt($data)) {
            return redirect()->route('admin.dashboard')->with('success', 'Login Successfully');
        }else{
            return redirect()->route('admin.login')->with('error', 'Invalid Creadentials');
        }
    }
    //End method

    public function AdminLogout()
    {
        Auth::guard('admin')->logout();
        return redirect()->route('admin.login')->with('success', 'Logout Successfully');

    }
    //End method

    
}
