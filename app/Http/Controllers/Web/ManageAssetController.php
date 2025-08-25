<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Asset;
use App\Models\AssetDescription;
use App\Models\AssetLog;
use App\Models\AssetOrigin;
use App\Models\CategoryAsset;
use App\Models\DescriptionAsset;
use App\Models\Location;
use App\Models\RelationAsset;
use Illuminate\Http\Request;

class ManageAssetController extends Controller
{
    public function manage_asset_page(Request $request)
    {
        $search = $request->query();
        if (!$search || !isset($search['category'])) {
            $assets = null;
            $search = 'all';
            $categories = CategoryAsset::get();
        } else {
            $search = $search['category'];
            if ($search == 'all') {
                $assets = Asset::with(['origin', 'category'])->paginate(10);
                $categories = CategoryAsset::get();
            } else {
                $assets = Asset::with(['origin', 'category'])->where('ast_category_id', $search)->paginate(10);
                $categories = CategoryAsset::get();
            }
        }

        return view('asset.manage', ['title' => 'manage asset page', 'assets' => $assets, 'categories' => $categories, 'search' => '&category=' . $search]);
    }

    public function detail_asset_page(Request $request, $id)
    {
        $asset = Asset::with(['origin', 'category'])->where('ast_id', $id)->get();
        $relation = RelationAsset::with(['location', 'room'])->where('rltn_ast_asset_id', $id)->get();
        $description = AssetDescription::with(['description'])->where('ast_desc_asset_id', $id)->get();
        $log = AssetLog::where('ast_lg_asset_id', $id)->get();
        return view('asset.detail', ['title' => 'detail asset page', 'asset' => $asset, 'relation' => $relation, 'descriptions' => $description, 'logs' => $log]);
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

    public function add_asset_system(Request $request)
    {
        $validateDataAsset = $request->validate([
            'ast_codename' => 'required | string | max:255',
            'ast_category_id' => 'required | exists:category_assets,ctgy_ast_id',
            'ast_origin_id' => 'nullable | exists:asset_origins,ast_orgn_id',
        ]);


        $validateDataDescription = $request->validate([
            'descriptions.*.title' => 'required|string | max:255',
            'descriptions.*.value' => 'required|string | max:255',
        ]);

        $validateDataLocation = $request->validate([
            'rltn_ast_location_id' => 'nullable | exists:locations,lctn_id',
        ]);

        $asset = Asset::create($validateDataAsset);

        if ($request->has('descriptions')) {
            foreach ($request->descriptions as $desc) {
                if ($desc['title'] && $desc['value']) {
                    $description = DescriptionAsset::firstOrCreate([
                        'desc_ast_description' => $desc['title'],
                        'desc_ast_value' => $desc['value'],
                    ]);

                    $asset->descriptions()->attach($description->desc_ast_id);
                }
            }
        }

        if ($request->has('rltn_ast_location_id')) {
            RelationAsset::create([
                'rltn_ast_asset_id' => $asset->ast_id,
                'rltn_ast_location_id' => $validateDataLocation['rltn_ast_location_id'],
            ]);
        }

        return redirect('/manage/asset?category=all')->with('success', 'asset created');
    }

    public function update_asset_system(Request $request, $id)
    {
        $asset = Asset::find($id);

        $validateDataAsset = $request->validate([
            'ast_codename' => 'sometimes | required | string | max:255',
            'ast_category_id' => 'sometimes | required | exists:category_assets,ctgy_ast_id',
            'ast_origin_id' => 'sometimes | nullable | exists:asset_origins,ast_orgn_id',
        ]);

        $validateDataDescription = $request->validate([
            'descriptions.*.title' => 'sometimes| nullable |string | max:255',
            'descriptions.*.value' => 'sometimes| nullable |string | max:255',
        ]);

        $validateDataLocation = $request->validate([
            'rltn_ast_location_id' => 'sometimes | nullable | exists:locations,lctn_id',
        ]);

        $asset->update($validateDataAsset);

        $asset->descriptions()->detach();

        if ($request->has('descriptions')) {
            foreach ($request->descriptions as $desc) {
                if ($desc['title'] && $desc['value']) {
                    $description = DescriptionAsset::firstOrCreate([
                        'desc_ast_description' => $desc['title'],
                        'desc_ast_value' => $desc['value'],
                    ]);

                    $asset->descriptions()->attach($description->desc_ast_id);
                }
            }
        }

        if ($request->has('rltn_ast_location_id')) {
            RelationAsset::where('rltn_ast_asset_id', $id)->delete();
            RelationAsset::create([
                'rltn_ast_asset_id' => $asset->ast_id,
                'rltn_ast_location_id' => $validateDataLocation['rltn_ast_location_id'],
            ]);
        }

        return redirect('/manage/asset/' . $id . '/detail')->with('success', 'asset created');
    }

    public function delete_asset_system($id)
    {
        $asset = Asset::find($id)->delete();
        return redirect('/manage/asset?category=all')->with('success', 'asset deleted');
    }
}
