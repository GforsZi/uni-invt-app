<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Location;
use Illuminate\Http\Request;

class ManageLocationController extends Controller
{
    public function manage_location_page()
    {
        $locations = Location::paginate(10);
        return view('location.manage', ['title' => 'manage location page', 'locations' => $locations]);
    }
}
