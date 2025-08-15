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
}
