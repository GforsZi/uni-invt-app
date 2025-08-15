<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Asset;
use Illuminate\Http\Request;

class ManageAssetController extends Controller
{
    public function manage_asset_page(Request $request)
    {
        $search = $request->query();
        if (!$search) {
            $assets = null;
        } else {
            $assets = Asset::with(['origin', 'category'])->where('ast_category_id', $search['category'])->paginate(10);
        }

        return view('asset.manage', ['title' => 'manage asset page', 'assets' => $assets]);
    }
}
