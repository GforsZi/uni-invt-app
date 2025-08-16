<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;

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
        return view('account.update', ['title' => 'edit account page', 'accounts' => $account, 'roles' => $roles]);
    }
}
