<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\LoaningAsset;
use App\Models\LoanLocation;
use App\Models\Loans;
use Illuminate\Http\Request;

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

    public function accepted_loan_system(Request $request, $id)
    {
        $loan = Loans::find($id);

        $validateData = $request->validate([
            'ln_accepted' => 'sometimes | required | boolean'
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
