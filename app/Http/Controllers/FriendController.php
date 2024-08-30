<?php

namespace App\Http\Controllers;

use App\Models\Friend;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FriendController extends Controller
{
    //
    public function index() {
        $friends = Friend::where(function($query){
            $query->where('user_id', '=', Auth::user()->id)
            ->whereIn('status', ['accepted', 'pending']);
        })->orWhere(function($query) {
            $query->where('friend_id', '=', Auth::user()->id)
            ->whereIn('status', ['pending']);
        })->paginate(24);

        return view('friends', compact('friends'));
    }

    public function community() {
        $status = ['pending', 'accepted'];

        $alreadyRequest = Friend::where('user_id', '=', Auth::id())
        ->whereIn('status', $status)
        ->get()->pluck('friend_id');

        $friends = User::whereNotIn('id', $alreadyRequest)
        ->where('id', '!=', Auth::id())
        ->paginate(24);

        return view('community', compact('friends'));
    }

    public function addFriend(Request $request) {
        Friend::create([
            'user_id' => Auth::id(),
            'friend_id' => $request->friend_id,
            'status' => 'pending',
        ]);

        return redirect()->route('community');
    }

    public function removeFriend(Request $request) {
        Friend::where('user_id', '=', Auth::id())
        ->where('friend_id', '=', $request->friend_id)
        ->delete();

        Friend::where('user_id', '=', $request->friend_id)
        ->where('friend_id', '=', Auth::id())
        ->delete();

        return redirect()->route('friends');
    }

    public function acceptFriend(Request $request) {
        $friends = Friend::where('user_id', '=', $request->friend_id)
        ->where('friend_id', '=', Auth::id())
        ->update([
            'status' => 'accepted'
        ]);

        Friend::create([
            'user_id' => Auth::id(),
            'friend_id' => $request->friend_id,
            'status' => 'accepted',
        ]);

        return redirect()->route('friends');
    }

    public function declineFriend(Request $request) {
        $friends = Friend::where('user_id', '=', Auth::user()->id)
        ->where('friend_id', '=', $request->friend_id)
        ->update([
            'status' => 'declined'
        ]);

        Friend::create([
            'user_id' => Auth::id(),
            'friend_id' => $request->friend_id,
            'status' => 'accepted',
        ]);

        return redirect()->route('friends');
    }
}
