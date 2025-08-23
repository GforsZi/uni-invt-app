<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Asset;
use App\Models\AssetDescription;
use App\Models\AssetOrigin;
use App\Models\CategoryAsset;
use App\Models\Location;
use App\Models\RelationAsset;
use Illuminate\Http\Request;

class ManageAssetController extends Controller
{
    public function manage_asset_page(Request $request)
    {
        $search = $request->query();
        if (!$search) {
            $assets = null;
            $categories = CategoryAsset::get();
        } else {
            if ($search['category'] == 'all') {
                $assets = Asset::with(['origin', 'category'])->paginate(10);
                $categories = CategoryAsset::get();
            } else {
                $assets = Asset::with(['origin', 'category'])->where('ast_category_id', $search['category'])->paginate(10);
                $categories = CategoryAsset::get();
            }
        }

        return view('asset.manage', ['title' => 'manage asset page', 'assets' => $assets, 'categories' => $categories]);
    }

    public function detail_asset_page(Request $request, $id)
    {
        $asset = Asset::with(['origin', 'category'])->where('ast_id', $id)->get();
        $relation = RelationAsset::with(['location', 'room'])->where('rltn_ast_asset_id', $id)->get();
        $description = AssetDescription::with(['description'])->where('ast_desc_asset_id', $id)->get();
        return view('asset.detail', ['title' => 'detail asset page', 'asset' => $asset, 'relation' => $relation, 'descriptions' => $description]);
    }

    public function add_asset_page()
    {
        $categories = CategoryAsset::get();
        $origins = AssetOrigin::get();
        $locations = Location::get();
        return view('asset.add', ['title' => 'add asset page', 'categories' => $categories, 'origins' => $origins, 'locations' => $locations]);
    }

    public function update_asset_page(Request $request, $id)
    {
        $asset = Asset::with(['origin', 'category'])->where('ast_id', $id)->get();
        $relation = RelationAsset::with(['location', 'room'])->where('rltn_ast_asset_id', $id)->get();
        $description = AssetDescription::with(['description'])->where('ast_desc_asset_id', $id)->get();
        $categories = CategoryAsset::get();
        $origins = AssetOrigin::get();
        $locations = Location::get();
        return view('asset.update', ['title' => 'edit asset page', 'asset' => $asset, 'categories' => $categories, 'origins' => $origins, 'relations' => $relation, 'descriptions' => $description, 'locations' => $locations]);
    }
}
