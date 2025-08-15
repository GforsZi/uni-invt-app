<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\CategoryAsset;
use Illuminate\Http\Request;

class ManageCategoryAssetController extends Controller
{
    public function manage_asset_category_page()
    {
        $categories = CategoryAsset::paginate(10);
        return view('asset.category.manage', ['title' => 'manage asset category page', 'categories' => $categories]);
    }
}
