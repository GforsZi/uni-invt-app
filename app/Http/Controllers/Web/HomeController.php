<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function home_page()
    {
        return view('home.home', ["title" => "Home page"]);
    }
}
