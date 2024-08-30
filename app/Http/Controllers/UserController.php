<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    //
    public function topupPage() {
        return view('topup');
    }

    public function topup(Request $request) {
        $user = User::where('id', '=', Auth::user()->id)
        ->update([
            'coin' => Auth::user()->coin + $request->coin,
        ]);

        return redirect()->route('topup-page');
    }
}
