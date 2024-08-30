<?php

namespace App\Http\Controllers;

use App\Models\Friend;
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

    public function community(Request $request) {
        $status = ['pending', 'accepted'];
        $userId = User::all()->pluck('id');

        if($request->search != null) {
            $userId = User::whereLike('name', '%' . $request->search . '%')->get()->pluck('id');
        }

        $alreadyRequest = Friend::where('user_id', '=', Auth::id())
        ->whereIn('status', $status)
        ->get()->pluck('friend_id');

        $friends = User::whereNotIn('id', $alreadyRequest)
        ->whereIn('id', $userId)
        ->where('id', '!=', Auth::id())
        ->paginate(24);

        return view('community', compact('friends'));
    }
}
