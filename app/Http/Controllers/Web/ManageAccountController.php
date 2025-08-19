<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;

class ManageAccountController extends Controller
{
    public function manage_account_page()
    {
        $accounts = User::with('roles')->paginate(10);
        return view('account.manage', ['title' => 'manage account page', 'accounts' => $accounts]);
    }

    public function detail_account_page(Request $request, $id)
    {
        $account = User::where('usr_id', $id)->with('roles')->get();
        return view('account.detail', ['title' => 'detail account page', 'account' => $account]);
    }

    public function add_account_page()
    {
        return view('account.add', ['title' => 'add account page']);
    }

    public function update_account_page(Request $request, $id)
    {
        $account = User::where('usr_id', $id)->with('roles')->get();
        $roles = Role::get();
        return view('account.update', ['title' => 'edit account page', 'account' => $account, 'roles' => $roles]);
    }

    public function add_account_system(Request $request)
    {
        $validateData = $request->validate([
            "name" => "required | min:3 | max:255",
            "email" => "required | email:dns | unique:users,email",
            "password" => "required | min:5 | max:30 | confirmed",
            "usr_activation" => "required | boolean",
            "usr_role_id" => "required | exists:roles,id",
            'image' => 'nullable|image|max:2048',
        ]);

        $validateData["password"] = Hash::make($validateData["password"]);

        if ($request->hasFile('image')) {
            $uploadedFile = Cloudinary::upload($request->file('image')->getRealPath(), [
                'folder' => 'photo_profile_img'
            ]);

            $validateData['usr_photo_path'] = $uploadedFile->getSecurePath();
            $validateData['usr_photo_public_id'] = $uploadedFile->getPublicId();
        }

        User::create($validateData);
        return redirect("/manage/account")->with("success", "account created");
    }

    public function change_role_account_system(Request $request, $id)
    {
        $user = User::where('usr_id', $id)->get();

        $validateData = $request->validate([
            "usr_role_id" => "required | exists:roles,id",
        ]);

        $user->update($validateData);
        return redirect("/manage/account/" . $id . "/detail")->with("success", "role account changed");
    }

    public function banned_account_system(Request $request, $id)
    {
        $user = User::where('usr_id', $id)->get();

        $validateData = $request->validate([
            "usr_activation" => "required | boolean",
        ]);

        $user->update($validateData);
        return redirect("/manage/account/" . $id . "/detail")->with("success", "account banned");
    }

    public function delete_account_system(Request $request, $id)
    {
        $user = User::where('usr_id', $id)->get();
        if ($user->usr_photo_public_id) {
            Cloudinary::destroy($user->usr_photo_public_id);
        }
        $user->delete();
        return redirect("/manage/account")->with("success", "account deleted");
    }
}
