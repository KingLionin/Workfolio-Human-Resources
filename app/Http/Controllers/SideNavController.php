<?php

namespace App\Http\Controllers;

use Session;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SideNavController extends Controller
{

    // For Dashboard
    public function dashboard()
    {
        return view('Mainpage/dashboard');
    }

    // User Dashboard Page
    public function users()
    {
        $users = User::all();
        return view('Mainpage/users', ['users' => $users]);
    }

    // For Dashboard
    public function profile()
    {
        return view('Mainpage/profile');
    }

    // For Signout
    public function signOut(Request $request)
    {
        Session::flush();
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return Redirect('login');
    }
}
