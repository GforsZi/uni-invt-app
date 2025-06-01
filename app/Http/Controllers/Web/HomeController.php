<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Contracts\Database\Eloquent\Builder;

class HomeController extends Controller
{
    public function home_page()
    {
        $user = User::where('usr_id', Auth::user()->usr_id)->with('roles')->get()->first();
        return view('home.home', ["title" => "Home page", 'users' => $user]);
    }
}
