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
            "ctgy_ast_description" => "nullable | string | max:255",
            'image' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $destinationPath = public_path('media/photo_category_asset/');

            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0777, true);
            }

            $filename = time() . '_' . $request->file('image')->getClientOriginalName();

            $request->file('image')->move($destinationPath, $filename);

            $validateData['ctgy_ast_img_path'] = 'media/photo_category_asset/' . $filename;
            $validateData['ctgy_ast_img_public_id'] = $filename;
        }

        CategoryAsset::create($validateData);
        return redirect("/manage/asset/category")->with("success", "category created");
    }

    public function update_asset_category_system(Request $request, $id)
    {
        $category = CategoryAsset::find($id);

        $validateData = $request->validate([
            "ctgy_ast_name" => "sometimes | required | min:3 | max:255",
            "ctgy_ast_description" => "sometimes | nullable | string | max:255",
            'image' => 'sometimes | nullable | image | max:2048',
        ]);

        if ($request->hasFile('image')) {
            $path = $category->toArray();
            $filePath = public_path($path['ctgy_ast_img_path']);
            if ($path['ctgy_ast_img_path']) {
                if (file_exists($filePath)) {
                    unlink($filePath);
                }
            }
            $destinationPath = public_path('media/photo_category_asset/');

            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0777, true);
            }

            $filename = time() . '_' . $request->file('image')->getClientOriginalName();

            $request->file('image')->move($destinationPath, $filename);

            $validateData['ctgy_ast_img_path'] = 'media/photo_category_asset/' . $filename;
            $validateData['ctgy_ast_img_public_id'] = $filename;
        }

        if ($request->has('delete_image') === true) {
            $path = $category->toArray();
            $filePath = public_path($path['ctgy_ast_img_path']);
            if ($path['ctgy_ast_img_path']) {
                if (file_exists($filePath)) {
                    unlink($filePath);
                    $validateData['ctgy_ast_img_path'] = null;
                    $validateData['ctgy_ast_img_public_id'] = null;
                    $category->update($validateData);
                    return redirect("/manage/asset/category")->with("success", "category updated");
                }
            }
        }

        $category->update($validateData);
        return redirect("/manage/asset/category")->with("success", "category updated");
    }

    public function delete_asset_category_system(Request $request, $id)
    {
        $category = CategoryAsset::find($id);
        $path = $category->toArray();
        $filePath = public_path($path['ctgy_ast_img_path']);
        if ($path['ctgy_ast_img_path']) {
            if (file_exists($filePath)) {
                unlink($filePath);
            }
        }
        $category->delete();
        return redirect("/manage/asset/category")->with("success", "category deleted");
    }
}
