<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Asset;
use App\Models\AssetDescription;
use App\Models\AssetLog;
use App\Models\CategoryAsset;
use App\Models\LoaningAsset;
use App\Models\LoanLocation;
use App\Models\Loans;
use App\Models\Location;
use App\Models\RelationAsset;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Contracts\Database\Eloquent\Builder;

class HomeController extends Controller
{
    public function home_page()
    {
        $user = User::where('usr_id', Auth::user()->usr_id)->with('roles')->get()->first();
        return view('user.home', ["title" => "Home page", 'users' => $user]);
    }

    public function profile_page()
    {
        $loan = Loans::where('ln_user_id', Auth::user()->usr_id)->paginate(10);
        $user = User::where('usr_id', Auth::user()->usr_id)->with('roles')->get()->first();
        return view('user.profile', ["title" => "Profile page", 'users' => $user, 'loans' => $loan]);
    }

    public function update_profile_page()
    {
        $user = User::find(Auth::user()->usr_id);
        return view('user.update_profile', ['title' => 'update profile page', 'user' => $user]);
    }

    public function update_profile_system(Request $request)
    {
        $user = User::find(Auth::user()->usr_id);
        if ($request->email == Auth::user()->email) {
            $validateData = $request->validate([
                "name" => "sometimes | required | min:3 | max:255",
                "email" => "sometimes | required",
                'image' => 'sometimes | nullable|image|max:2048',
            ]);
        } else {
            $validateData = $request->validate([
                "name" => "sometimes | required | min:3 | max:255",
                "email" => "sometimes | required | email:dns | unique:users,email",
                'image' => 'sometimes | nullable|image|max:2048',
            ]);
        }

        if ($request->hasFile('image')) {
            $destinationPath = public_path('media/photo_profile/');

            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0777, true);
            }

            $filename = time() . '_' . $request->file('image')->getClientOriginalName();

            $request->file('image')->move($destinationPath, $filename);

            $validateData['usr_photo_path'] = 'media/photo_profile/' . $filename;
            $validateData['usr_photo_public_id'] = $filename;
        }

        if ($request->has('delete_image') === true) {
            $path = $user->toArray();
            $filePath = public_path($path['usr_photo_path']);
            if ($path['usr_photo_path']) {
                if (file_exists($filePath)) {
                    unlink($filePath);
                    $validateData['usr_photo_path'] = null;
                    $validateData['usr_photo_public_id'] = null;
                    $user->update($validateData);
                    return redirect('/profile')->with('success', 'profile updated');
                }
            }
        }
        $user->update($validateData);
        return redirect('/profile')->with('success', 'profile updated');
    }

    public function view_asset_page()
    {
        $category = CategoryAsset::get();
        return view('user.asset.view_category', ['title' => 'view asset page', 'categories' => $category]);
    }

    public function view_asset_by_category_page($category)
    {
        $asset = Asset::where('ast_category_id', $category)->paginate(10);
        return view('user.asset.view_asset', ['title' => 'view asset by category page', 'assets' => $asset]);
    }

    public function view_detail_asset_page($id)
    {
        $asset = Asset::find($id);
        $relation = RelationAsset::with(['location', 'room'])->where('rltn_ast_asset_id', $id)->get();
        $description = AssetDescription::with(['description'])->where('ast_desc_asset_id', $id)->get();
        $log = AssetLog::where('ast_lg_asset_id', $id)->get();
        return view('user.asset.view_detail', ['title' => 'view detail asset page', 'asset' => $asset, 'relation' => $relation, 'descriptions' => $description, 'logs' => $log]);
    }

    public function add_loan_page()
    {
        $location = Location::get();
        $asset = Asset::get();
        return view('user.loan.add', ['title' => 'add loan page', 'locations' => $location, 'assets' => $asset]);
    }

    public function update_loan_page(Request $request, $id)
    {
        $location = Location::get();
        $asset = Asset::get();
        $loaningAsset = LoaningAsset::with('asset')->where('lng_ast_loan_id', $id)->get();
        $loanLocation = LoanLocation::with('location')->where('ln_lctn_loan_id', $id)->get();
        $loan = Loans::where('ln_id', $id)->get();
        return view('user.loan.update', ['title' => 'edit loan page', 'locations' => $location, 'assets' => $asset, 'loaningAssets' => $loaningAsset, 'loanLocation' => $loanLocation, 'loan' => $loan]);
    }

    public function detail_loan_page($id)
    {
        $loan = Loans::with('user')->where('ln_id', $id)->get();
        $asset = LoaningAsset::with('asset')->where('lng_ast_loan_id', $id)->get();
        $location = LoanLocation::with(['asset', 'location', 'room'])->where('ln_lctn_loan_id', $id)->get();
        return view('user.loan.detail', ['title' => 'detail loan page', 'loan' => $loan, 'assets' => $asset, 'location' => $location]);
    }
}
