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

    public function detail_location_page(Request $request, $id)
    {
        $location = Location::where('lctn_id', $id)->get();
        return view('location.detail', ['title' => 'detail location page', 'location' => $location]);
    }

    public function add_location_page()
    {
        return view('location.add', ['title' => 'add location page']);
    }

    public function update_location_page(Request $request, $id)
    {
        $location = Location::where('lctn_id', $id)->get();
        return view('location.update', ['title' => 'edit location page', 'location' => $location]);
    }
}
