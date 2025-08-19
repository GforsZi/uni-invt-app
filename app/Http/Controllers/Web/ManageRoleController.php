<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Role;
use Illuminate\Http\Request;

class ManageRoleController extends Controller
{
    public function manage_role_page()
    {
        $roles = Role::paginate(10);
        return view('role.manage', ['title' => 'manage role page', 'roles' => $roles]);
    }

    public function add_role_page()
    {
        return view('role.add', ['title' => 'add role page']);
    }

    public function update_role_page(Request $request, $id)
    {
        $role = Role::where('rl_id', $id)->get();
        return view('role.update', ['title' => 'edit role page', 'role' => $role]);
    }
}
