<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\AssetLog;
use Illuminate\Http\Request;

class ManageLogAssetController extends Controller
{
    public function add_asset_log_system(Request $request, $id)
    {
        $request->validate([
            'rtrn_id' => 'required | exists:returns,rtrn_id'
        ]);

        $validateData = $request->validate([
            'ast_lg_status' => 'required|in:good,damage,lost',
            'ast_lg_note' => 'nullable | string | max:255',
        ]);

        $validateData['ast_lg_asset_id'] = $id;
        $validateData['ast_lg_return_id'] = $request->rtrn_id;

        AssetLog::create($validateData);
        return redirect('/manage/return/' . $request->rtrn_id . '/detail')->with('success', 'log created');
    }

    public function update_asset_log_system(Request $request, $id)
    {
        $request->validate([
            'rtrn_id' => 'sometimes | required | exists:returns,rtrn_id'
        ]);

        $validateData = $request->validate([
            'ast_lg_status' => 'sometimes | required|in:good,damage,lost',
            'ast_lg_note' => 'sometimes | nullable | string | max:255',
        ]);

        $validateData['ast_lg_asset_id'] = $id;
        $validateData['ast_lg_return_id'] = $request->rtrn_id;

        AssetLog::where('ast_lg_id', $request->ast_lg_id)->update($validateData);
        return redirect('/manage/return/' . $request->rtrn_id . '/detail')->with('success', 'log updated');
    }
}
