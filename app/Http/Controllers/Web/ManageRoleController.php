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
}
