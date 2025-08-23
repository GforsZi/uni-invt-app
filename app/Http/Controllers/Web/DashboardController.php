<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function dashboard_page()
    {
        $user = User::where('usr_id', Auth::user()->usr_id)->with('roles')->get()->first();
        return view('admin.dashboard', ['title' => 'Dashboard page', 'users' => $user]);
    }

    public function admin_profile_page()
    {
        $user = User::where('usr_id', Auth::user()->usr_id)->with('roles')->get()->first();
        return view('admin.profile', ["title" => "Admin profile page", 'users' => $user]);
    }
}
