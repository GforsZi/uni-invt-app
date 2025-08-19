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
            "lctn_description" => "max:255",
            'image' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $uploadedFile = Cloudinary::upload($request->file('image')->getRealPath(), [
                'folder' => 'location_img'
            ]);

            $validateData['lctn_img_path'] = $uploadedFile->getSecurePath();
            $validateData['lctn_img_public_id'] = $uploadedFile->getPublicId();
        }

        Location::create($validateData);
        return redirect("/manage/location")->with("success", "location created");
    }

    public function edit_location_system(Request $request, $id)
    {
        $location = Location::where('lctn_id', $id)->get();

        $validateData = $request->validate([
            "lctn_name" => "sometimes | required | min:3 | max:255",
            "lctn_latitude" => "sometimes | required",
            "lctn_longitude" => "sometimes | required",
            "lctn_description" => "sometimes | max:255",
            'image' => 'sometimes | nullable|image|max:2048',
        ]);

        if ($request->hasFile('image')) {
            if ($location->lctn_img_public_id) {
                Cloudinary::destroy($location->lctn_img_public_id);
            }

            $uploadedFile = Cloudinary::upload($request->file('image')->getRealPath(), [
                'folder' => 'location_img'
            ]);

            $validateData['lctn_img_path'] = $uploadedFile->getSecurePath();
            $validateData['lctn_img_public_id'] = $uploadedFile->getPublicId();
        }

        $location->update($validateData);
        return redirect("/manage/location/" . $id . "/detail")->with("success", "location updated");
    }

    public function delete_location_system(Request $request, $id)
    {
        $location = Location::where('lctn_id', $id)->get();
        if ($location->lctn_img_public_id) {
            Cloudinary::destroy($location->lctn_img_public_id);
        }
        $location->delete();
        return redirect("/manage/location")->with("success", "location deleted");
    }
}
