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

    public function add_role_system(Request $request)
    {
        $validateData = $request->validate([
            'rl_name' => 'required | string | min:3 | max:255',
            'rl_description' => 'nullable | string | max:255',
            'rl_admin' => 'nullable | boolean'
        ]);

        Role::create($validateData);
        return redirect('/manage/role')->with("success", "role created");
    }

    public function update_role_system(Request $request, $id)
    {
        $role = Role::find($id);
        $validateData = $request->validate([
            'rl_name' => 'sometimes | required | string | min:3 | max:255',
            'rl_description' => 'sometimes | nullable | string | max:255',
            'rl_admin' => 'sometimes | nullable | boolean'
        ]);

        $role->update($validateData);
        return redirect('/manage/role')->with("success", "role updated");
    }

    public function delete_role_system(Request $request, $id)
    {
        $role = Role::find($id);
        $role->delete();
        return redirect('/manage/role')->with("success", "role deleted");
    }
}
