<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Models\Loans;
use Carbon\Carbon;
use App\Models\Returns;

class DashboardController extends Controller
{
    public function dashboard_page()
    {
        $loanTotal = Loans::get()->count();
        $loanTotalAcc = Loans::where('ln_accepted', 1)->get()->count();
        $loanTotalRej = Loans::where('ln_accepted', 0)->get()->count();
        $loanTotalPen = Loans::where('ln_accepted', null)->get()->count();
        $loanNew = Loans::whereMonth('ln_created_at',  Carbon::now()->month)->whereYear('ln_created_at', Carbon::now()->year)->get()->count();
        $loanNewAcc = Loans::where('ln_accepted', 1)->whereMonth('ln_created_at',  Carbon::now()->month)->whereYear('ln_created_at', Carbon::now()->year)->get()->count();
        $loanNewRej = Loans::where('ln_accepted', 0)->whereMonth('ln_created_at',  Carbon::now()->month)->whereYear('ln_created_at', Carbon::now()->year)->get()->count();
        $loanNewPen = Loans::where('ln_accepted', null)->whereMonth('ln_created_at',  Carbon::now()->month)->whereYear('ln_created_at', Carbon::now()->year)->get()->count();
        $percentageLoanAcc = $loanNew > 0 ? ($loanNewAcc / $loanNew) * 100 : 0;
        $percentageLoanRej = $loanNew > 0 ? ($loanNewRej / $loanNew) * 100 : 0;
        $percentageLoanPen = $loanNew > 0 ? ($loanNewPen / $loanNew) * 100 : 0;
        $returnTotal = Returns::get()->count();
        $returnTotalAcc = Returns::where('rtrn_accepted', 1)->get()->count();
        $returnTotalRej = Returns::where('rtrn_accepted', 0)->get()->count();
        $returnTotalPen = Returns::where('rtrn_accepted', null)->get()->count();
        $returnNew = Returns::whereMonth('rtrn_created_at',  Carbon::now()->month)->whereYear('rtrn_created_at', Carbon::now()->year)->get()->count();
        $returnNewAcc = Returns::where('rtrn_accepted', 1)->whereMonth('rtrn_created_at', Carbon::now()->month)->whereYear('rtrn_created_at', Carbon::now()->year)->get()->count();
        $returnNewRej = Returns::where('rtrn_accepted', 0)->whereMonth('rtrn_created_at', Carbon::now()->month)->whereYear('rtrn_created_at', Carbon::now()->year)->get()->count();
        $returnNewPen = Returns::where('rtrn_accepted', null)->whereMonth('rtrn_created_at', Carbon::now()->month)->whereYear('rtrn_created_at', Carbon::now()->year)->get()->count();
        $percentageReturnAcc = $returnNew > 0 ? ($returnNewAcc / $returnNew) * 100 : 0;
        $percentageReturnRej = $returnNew > 0 ? ($returnNewRej / $returnNew) * 100 : 0;
        $percentageReturnPen = $returnNew > 0 ? ($returnNewPen / $returnNew) * 100 : 0;
        $user = User::where('usr_id', Auth::user()->usr_id)->with('roles')->get()->first();
        return view('admin.dashboard', ['title' => 'Dashboard page', 'users' => $user], compact('loanTotal', 'loanTotalAcc', 'loanTotalRej', 'loanTotalPen', 'loanNew', 'loanNewAcc', 'loanNewRej', 'loanNewPen', 'percentageLoanAcc', 'percentageLoanRej', 'percentageLoanPen', 'returnTotal', 'returnTotalAcc', 'returnTotalRej', 'returnTotalPen',  'returnNew', 'returnNewAcc', 'returnNewRej', 'returnNewPen', 'percentageReturnAcc', 'percentageReturnRej', 'percentageReturnPen'));
    }

    public function admin_profile_page()
    {
        $user = User::where('usr_id', Auth::user()->usr_id)->with('roles')->get()->first();
        return view('admin.profile', ["title" => "Admin profile page", 'users' => $user]);
    }

    public function update_profile_page()
    {
        $user = User::find(Auth::user()->usr_id);
        return view('admin.update_profile', ['title' => 'update profile page', 'user' => $user]);
    }

    public function update_profile_system(Request $request)
    {
        $user = User::find(Auth::user()->usr_id);
        if ($request->email == Auth::user()->email) {
            $validateData = $request->validate([
                "name" => "sometimes | required | min:3 | max:255",
                "email" => "sometimes | required",
                'image' => 'sometimes | nullable|image|max:2048',
            ]);
        } else {
            $validateData = $request->validate([
                "name" => "sometimes | required | min:3 | max:255",
                "email" => "sometimes | required | email:dns | unique:users,email",
                'image' => 'sometimes | nullable|image|max:2048',
            ]);
        }

        if ($request->hasFile('image')) {
            $destinationPath = public_path('media/photo_profile/');

            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0777, true);
            }

            $filename = time() . '_' . $request->file('image')->getClientOriginalName();

            $request->file('image')->move($destinationPath, $filename);

            $validateData['usr_photo_path'] = 'media/photo_profile/' . $filename;
            $validateData['usr_photo_public_id'] = $filename;
        }

        if ($request->has('delete_image') === true) {
            $path = $user->toArray();
            $filePath = public_path($path['usr_photo_path']);
            if ($path['usr_photo_path']) {
                if (file_exists($filePath)) {
                    unlink($filePath);
                    $validateData['usr_photo_path'] = null;
                    $validateData['usr_photo_public_id'] = null;
                    $user->update($validateData);
                    return redirect('/admin/profile')->with('success', 'profile updated');
                }
            }
        }
        $user->update($validateData);
        return redirect('/admin/profile')->with('success', 'profile updated');
    }
}
