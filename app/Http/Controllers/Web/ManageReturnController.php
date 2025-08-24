<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\AssetLog;
use App\Models\LoaningAsset;
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

    public function detail_return_page($id)
    {
        $return = Returns::with('user')->where('rtrn_id', $id)->get();
        $loaning = LoaningAsset::with(['asset'])->where('lng_ast_loan_id', $return[0]['rtrn_loan_id'])->get();
        $asset = ReturningAsset::with('asset')->where('rtrng_ast_return_id', $id)->get();
        $log = AssetLog::where('ast_lg_return_id', $id)->get();
        return view('return.detail', ['title' => 'detail return page', 'return' => $return, 'assets' => $asset, 'loaningAsset' => $loaning, 'logs' => $log]);
    }

    public function accepted_return_system(Request $request, $id)
    {
        $return = Returns::find($id);
        $validateData = $request->validate([
            'rtrn_accepted' => 'sometimes | required | boolean'
        ]);

        $validateData['rtrn_approved_at'] = now();

        $return->update($validateData);
        return redirect('/manage/return/' . $id . '/detail')->with('success', 'return accepted');
    }

    public function rejected_return_system(Request $request, $id)
    {
        $return = Returns::find($id);
        $validateData = $request->validate([
            'rtrn_accepted' => 'sometimes | required | boolean'
        ]);
        $validateData['rtrn_approved_at'] = now();

        $return->update($validateData);
        return redirect('/manage/return/' . $id . '/detail')->with('success', 'return rejected');
    }

    public function delete_return_system($id)
    {
        $return = Returns::find($id);
        $return->delete();
        return redirect('/manage/return')->with('success', 'return deleted');
    }
}
