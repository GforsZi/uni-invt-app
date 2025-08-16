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
        return view('asset.category.manage', ['title' => 'manage category asset page', 'categories' => $categories]);
    }

    public function add_asset_category_page()
    {
        return view('asset.category.add', ['title' => 'add category asset page']);
    }

    public function edit_asset_category_page(Request $request, $id)
    {
        $category = CategoryAsset::where('ctgy_ast_id', $id)->get();
        return view('asset.category.update', ['title' => 'edit category asset page', 'category' => $category]);
    }
}
