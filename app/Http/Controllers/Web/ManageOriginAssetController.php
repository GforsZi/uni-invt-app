<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\AssetOrigin;
use Illuminate\Http\Request;

class ManageOriginAssetController extends Controller
{
    public function manage_asset_origin_page()
    {
        $origins = AssetOrigin::paginate(10);
        return view('asset.origin.manage', ['title' => 'manage asset origin page', 'origins' => $origins]);
    }

    public function add_asset_origin_page()
    {
        return view('asset.origin.add', ['title' => 'add asset origin page']);
    }

    public function update_asset_origin_page(Request $request, $id)
    {
        $origin = AssetOrigin::where('ast_orgn_id', $id)->get();
        return view('asset.origin.update', ['title' => 'edit asset origin page', 'origin' => $origin]);
    }

    public function add_asset_origin_system(Request $request)
    {
        $validateData = $request->validate([
            "ast_orgn_name" => "required | string | min:3 | max:255",
            "ast_orgn_description" => "max:255"
        ]);

        AssetOrigin::create($validateData);
        return redirect("/manage/asset/origin")->with("success", "asset origin created");
    }

    public function edit_asset_origin_system(Request $request, $id)
    {
        $origin = AssetOrigin::where('ast_orgn_id', $id)->get();

        $validateData = $request->validate([
            "ast_orgn_name" => "sometimes | required | string | min:3 | max:255",
            "ast_orgn_description" => "sometimes | max:255"
        ]);

        $origin->update($validateData);
        return redirect("/manage/asset/origin")->with("success", "asset origin updated");
    }

    public function delete_asset_origin_system(Request $request, $id)
    {
        $origin = AssetOrigin::where('ast_orgn_id', $id)->get();
        $origin->delete();
        return redirect("/manage/asset/origin")->with("success", "asset origin deleted");
    }
}
