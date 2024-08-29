<?php

namespace App\Http\Controllers;

use App\Models\UserGame;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserGameController extends Controller
{
    //
    public function index() {
        $userGames = UserGame::where('user_id', '=', Auth::user()->id)->paginate(24);

        return view('mygame', compact('userGames'));
    }

    public function buyGame(Request $request) {
        $userGame = UserGame::where('user_id', '=', Auth::user()->id)
        ->where('game_id', '=', $request->game_id)->first();

        if($userGame == null) {
            $userGame = UserGame::create([
                'user_id' => Auth::user()->id,
                'game_id' => $request->game_id,
            ]);

            $status = 'done';

            return view('buygame', compact('status', 'userGame'));
        } else {
            $status = 'already';

            return view('buygame', compact('status', 'userGame'));
        }
    }

    public function giftGame(Request $request) {
        $userGame = UserGame::where('user_id', '=', $request->friend)
        ->where('game_id', '=', $request->game_id)->first();

        if($userGame == null) {
            $userGame = UserGame::create([
                'user_id' => $request->friend,
                'game_id' => $request->game_id,
            ]);

            $status = 'done';

            return view('buygame', compact('status', 'userGame'));
        } else {
            $status = 'already';

            return view('buygame', compact('status', 'userGame'));
        }
    }
}
