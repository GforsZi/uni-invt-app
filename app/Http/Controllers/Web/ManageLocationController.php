<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Location;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;
use Illuminate\Http\Request;

class ManageLocationController extends Controller
{
    public function manage_location_page()
    {
        $locations = Location::paginate(10);
        return view('location.manage', ['title' => 'manage location page', 'locations' => $locations]);
    }

    public function view_all_location_page()
    {
        $locations = Location::get();
        return view('location.view_all', ['title' => 'view location page', 'locations' => $locations]);
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

    public function add_location_system(Request $request)
    {
        $validateData = $request->validate([
            "lctn_name" => "required | min:3 | max:255",
            "lctn_latitude" => "required",
            "lctn_longitude" => "required",
            "lctn_description" => "nullable | string | max:255",
            'image' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $destinationPath = public_path('media/photo_location/');

            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0777, true);
            }

            $filename = time() . '_' . $request->file('image')->getClientOriginalName();

            $request->file('image')->move($destinationPath, $filename);

            $validateData['lctn_img_path'] = 'media/photo_location/' . $filename;
            $validateData['lctn_img_public_id'] = $filename;
        }

        Location::create($validateData);
        return redirect("/manage/location")->with("success", "location created");
    }

    public function update_location_system(Request $request, $id)
    {
        $location = Location::find($id);

        $validateData = $request->validate([
            "lctn_name" => "sometimes | required | min:3 | max:255",
            "lctn_latitude" => "sometimes | required",
            "lctn_longitude" => "sometimes | required",
            "lctn_description" => "sometimes | nullable | string | max:255",
            'image' => 'sometimes | nullable|image|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $path = $location->toArray();
            $filePath = public_path($path['lctn_img_path']);
            if ($path['lctn_img_path']) {
                if (file_exists($filePath)) {
                    unlink($filePath);
                }
            }
            $destinationPath = public_path('media/photo_location/');

            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0777, true);
            }

            $filename = time() . '_' . $request->file('image')->getClientOriginalName();

            $request->file('image')->move($destinationPath, $filename);

            $validateData['lctn_img_path'] = 'media/photo_location/' . $filename;
            $validateData['lctn_img_public_id'] = $filename;
        }

        if ($request->has('delete_image') === true) {
            $path = $location->toArray();
            $filePath = public_path($path['lctn_img_path']);
            if ($path['lctn_img_path']) {
                if (file_exists($filePath)) {
                    unlink($filePath);
                    $validateData['lctn_img_path'] = null;
                    $validateData['lctn_img_public_id'] = null;
                    $location->update($validateData);
                    return redirect("/manage/location/" . $id . '/detail')->with("success", "category updated");
                }
            }
        }

        $location->update($validateData);
        return redirect("/manage/location/" . $id . "/detail")->with("success", "location updated");
    }

    public function delete_location_system(Request $request, $id)
    {
        $location = Location::find($id);
        $path = $location->toArray();
        $filePath = public_path($path['lctn_img_path']);
        if ($path['lctn_img_path']) {
            if (file_exists($filePath)) {
                unlink($filePath);
            }
        }
        $location->delete();
        return redirect("/manage/location")->with("success", "location deleted");
    }
}
