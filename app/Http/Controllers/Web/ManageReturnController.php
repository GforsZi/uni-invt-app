<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\ReturningAsset;
use App\Models\Returns;
use Illuminate\Http\Request;

class ManageReturnController extends Controller
{
    public function manage_return_page()
    {
        $returns = Returns::with('user')->paginate(10);
        return view('return.manage', ['title' => 'manage return page', 'returns' => $returns]);
    }

    public function detail_return_page(Request $request, $id)
    {
        $return = Returns::with('user')->where('rtrn_id', $id)->get();
        $asset = ReturningAsset::with('asset')->where('rtrng_ast_return_id', $id)->get();
        return view('return.detail', ['title' => 'detail return page', 'return' => $return, 'assets' => $asset]);
    }
}
