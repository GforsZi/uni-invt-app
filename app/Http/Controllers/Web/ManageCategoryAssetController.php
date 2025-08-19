<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\CategoryAsset;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;
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

    public function add_asset_category_system(Request $request)
    {
        $validateData = $request->validate([
            "ctgy_ast_name" => "required | min:3 | max:255",
            "ctgy_ast_description" => "string | max:255",
            'image' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $uploadedFile = Cloudinary::upload($request->file('image')->getRealPath(), [
                'folder' => 'category_asset_img'
            ]);

            $validateData['ctgy_ast_img_path'] = $uploadedFile->getSecurePath();
            $validateData['ctgy_ast_img_public_id'] = $uploadedFile->getPublicId();
        }

        CategoryAsset::create($validateData);
        return redirect("/manage/asset/category")->with("success", "category created");
    }

    public function edit_asset_category_system(Request $request, $id)
    {
        $category = CategoryAsset::where('ctgy_ast_id', $id)->get();

        $validateData = $request->validate([
            "ctgy_ast_name" => "sometimes | required | min:3 | max:255",
            "ctgy_ast_description" => "sometimes | string | max:255",
            'image' => 'sometimes | nullable | image | max:2048',
        ]);

        if ($request->hasFile('image')) {
            if ($category->ctgy_ast_img_public_id) {
                Cloudinary::destroy($category->ctgy_ast_img_public_id);
            }

            $uploadedFile = Cloudinary::upload($request->file('image')->getRealPath(), [
                'folder' => 'category_asset_img'
            ]);

            $validateData['ctgy_ast_img_path'] = $uploadedFile->getSecurePath();
            $validateData['ctgy_ast_img_public_id'] = $uploadedFile->getPublicId();
        }

        $category->update($validateData);
        return redirect("/manage/asset/category")->with("success", "category updated");
    }

    public function delete_asset_category_system(Request $request, $id)
    {
        $category = CategoryAsset::where('ctgy_ast_id', $id)->get();
        if ($category->ctgy_ast_img_public_id) {
            Cloudinary::destroy($category->ctgy_ast_img_public_id);
        }
        $category->delete();
        return redirect("/manage/asset/category")->with("success", "category deleted");
    }
}
