<?php

namespace App\Http\Controllers;

use App\Models\Friend;
use App\Models\User;
use Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

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

    public function profile() {
        return view('profile');
    }

    public function updateProfile(Request $request) {
        $credentials = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255'],
            'password' => ['required', 'string'],
            'profile_pic' => 'mimes:jpg,png,jpeg,gif|max:2046'
        ]);

        if (Hash::check($request->password, Auth::user()->password)) {
            $profile_pic = Auth::user()->profile_pic;

            if($request->file('profile_pic') != null) {
                $fileLampiran = $request->file('profile_pic');

                $profile_pic = time().".".$fileLampiran->getClientOriginalExtension();

                $pathFileLampiran = Storage::disk('public')->putFileAs('assets/profile_pic', $fileLampiran, $profile_pic);

                $profile_pic = 'storage/assets/profile_pic/' . $profile_pic;
            }

            User::where('id', '=', Auth::user()->id)
            ->update([
                'name' => $request->name,
                'email' => $request->email,
                'profile_pic' => $profile_pic,
            ]);

            return redirect()->route('profile');
        } else {
            $status = 'wrong';
            return view('passwordWrong', compact('status'));
        }
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
