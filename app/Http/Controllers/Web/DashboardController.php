<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function dashboard_page()
    {
        return view('admin.dashboard', ['title' => 'Dashboard page']);
    }
}
