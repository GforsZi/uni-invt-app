<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
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
        return view('loan.detail', ['title' => 'detail loan page', 'loan' => $loan]);
    }
}
