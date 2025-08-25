<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Asset;
use App\Models\AssetLog;
use App\Models\LoaningAsset;
use App\Models\Loans;
use App\Models\ReturningAsset;
use App\Models\Returns;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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

    public function add_return_system(Request $request, $id)
    {
        $loan = Loans::with('assets')->find($id);

        $validateData = $request->validate([
            'rtrn_description' => 'required | string | max:255'
        ]);

        $validateDataAsset = $request->validate([
            'asset_id.*' => 'nullable | exists:assets,ast_id'
        ]);

        $validateData['rtrn_loan_id'] = $id;
        $validateData['rtrn_user_id'] = Auth::user()->usr_id;

        $return = Returns::create($validateData);

        if ($request->has('asset_id')) {
            foreach ($request->asset_id as $ast) {
                if ($ast) {
                    $asset = ReturningAsset::firstOrCreate([
                        'rtrng_ast_asset_id' => $ast,
                    ]);

                    $return->assets()->attach($asset->rtrng_ast_id);
                    $assetAvb = Asset::find($ast)->update(['ast_available' => true]);
                }
            }
        }
        $loan->update(['ln_status' => false]);
        return redirect('/manage/asset/' . $id . '/detail')->with('success', 'asset created');
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
