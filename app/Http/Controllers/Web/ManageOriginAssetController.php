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
}
