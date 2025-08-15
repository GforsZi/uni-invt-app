<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ManageDescriptionAssetController extends Controller
{
    public function manage_asset_description_page()
    {
        return view('asset.description.manage', ['title' => 'manage asset description page']);
    }
}
