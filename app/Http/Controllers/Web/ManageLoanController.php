<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Asset;
use App\Models\LoaningAsset;
use App\Models\LoanLocation;
use App\Models\Loans;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ManageLoanController extends Controller
{
    public function manage_loan_page()
    {
        $loans = Loans::with('user')->paginate(10);
        return view('loan.manage', ['title' => 'manage loan page', 'loans' => $loans]);
    }

    public function detail_loan_page(Request $request, $id)
    {
        $loan = Loans::with('user')->where('ln_id', $id)->get();
        $asset = LoaningAsset::with('asset')->where('lng_ast_loan_id', $id)->get();
        $location = LoanLocation::with(['asset', 'location', 'room'])->where('ln_lctn_loan_id', $id)->get();
        return view('loan.detail', ['title' => 'detail loan page', 'loan' => $loan, 'assets' => $asset, 'location' => $location]);
    }

    public function add_loan_system(Request $request)
    {
        $validateDataLoan = $request->validate([
            'ln_description' => 'nullable | string |max:255'
        ]);
        $validateDataLoan['ln_user_id'] = Auth::user()->usr_id;

        $validateDataLocation = $request->validate([
            'ln_lctn_location_id' => 'required | exists:locations,lctn_id'
        ]);

        $validateDataAsset = $request->validate([
            'asset_id.*' => 'required | exists:assets,ast_id'
        ]);

        $loan = Loans::create($validateDataLoan);
        if ($request->has('asset_id')) {
            foreach ($request->asset_id as $ast) {
                if ($ast) {
                    $asset = LoaningAsset::firstOrCreate([
                        'lng_ast_asset_id' => $ast,
                    ]);

                    $loan->assets()->attach($asset->lng_ast_asset_id);
                    $assetAvb = Asset::find($ast)->update(['ast_available' => false]);
                }
            }
        }


        if ($request->has('ln_lctn_location_id')) {
            LoanLocation::create([
                'ln_lctn_location_id' => $request->ln_lctn_location_id,
                'ln_lctn_loan_id' => $loan->ln_id,
            ]);
        }

        return redirect('/profile')->with('success', 'loan created');
    }

    public function update_loan_system(Request $request, $id)
    {
        $loan = Loans::find($id);

        $validateDataLoan = $request->validate([
            'ln_description' => 'sometimes | nullable | string |max:255'
        ]);
        $validateDataLoan['ln_user_id'] = Auth::user()->usr_id;

        $validateDataLocation = $request->validate([
            'ln_lctn_location_id' => 'sometimes | required | exists:locations,lctn_id'
        ]);

        $validateDataAsset = $request->validate([
            'asset_id.*' => 'sometimes | nullable | exists:assets,ast_id'
        ]);


        $loan->update($validateDataLoan);
        $loan->assets()->detach();
        if ($request->has('asset_id')) {
            foreach ($request->asset_id as $ast) {
                if ($ast) {
                    $asset = LoaningAsset::firstOrCreate([
                        'lng_ast_asset_id' => $ast,
                    ]);

                    $loan->assets()->attach($asset->lng_ast_id);
                    $assetAvb = Asset::find($ast)->update(['ast_available' => false]);
                }
            }
        }


        if ($request->has('ln_lctn_location_id')) {
            LoanLocation::where('ln_lctn_loan_id', $id)->delete();
            LoanLocation::create([
                'ln_lctn_location_id' => $request->ln_lctn_location_id,
                'ln_lctn_loan_id' => $loan->ln_id,
            ]);
        }

        return redirect('/loan' . '/' . $id . '/detail')->with('success', 'loan created');
    }

    public function accepted_loan_system(Request $request, $id)
    {
        $loan = Loans::find($id);

        $validateData = $request->validate([
            'ln_accepted' => 'sometimes | required | boolean',
            'ln_loan_limit' => 'sometimes | required | date'
        ]);
        $validateData['ln_approved_at'] = now();

        $loan->update($validateData);
        return redirect('/manage/loan/' . $id . '/detail')->with('success', 'loan accepted');
    }

    public function rejected_loan_system(Request $request, $id)
    {
        $loan = Loans::find($id);

        $validateData = $request->validate([
            'ln_accepted' => 'sometimes | required | boolean'
        ]);
        $validateData['ln_approved_at'] = now();
        $validateData['ln_loan_limit'] = null;

        $loan->update($validateData);
        return redirect('/manage/loan/' . $id . '/detail')->with('success', 'loan rejected');
    }

    public function delete_loan_system($id)
    {
        $loan = Loans::find($id);
        $loan->delete();
        return redirect('/manage/loan/')->with('success', 'loan deleted');
    }
}
