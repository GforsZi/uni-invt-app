<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Returns;
use Illuminate\Http\Request;

class ManageReturnController extends Controller
{
    public function manage_return_page()
    {
        $returns = Returns::with('user')->paginate(10);
        return view('return.manage', ['title' => 'manage return page', 'returns' => $returns]);
    }
}
