<?php

namespace App\Http\Controllers;

use App\Models\Friend;
use App\Models\Game;
use App\Models\UserGame;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserGameController extends Controller
{
    //
    public function index(Request $request) {
        $gamesId = Game::all()->pluck('id');

        if($request->search != null) {
            $gamesId = Game::whereLike('name', '%' . $request->search . '%')->get()->pluck('id');
        }

        $userGames = UserGame::where('user_id', '=', Auth::user()->id)
        ->whereIn('game_id', $gamesId)
        ->paginate(24);

        return view('mygame', compact('userGames'));
    }

    public function buyGame(Request $request) {
        $userGame = UserGame::where('user_id', '=', Auth::user()->id)
        ->where('game_id', '=', $request->game_id)->first();

        $friends = Friend::where('user_id', '=', Auth::user()->id)
        ->where('status', '=', 'accepted')
        ->get();

        if($userGame == null) {
            $userGame = UserGame::create([
                'user_id' => Auth::user()->id,
                'game_id' => $request->game_id,
            ]);

            $status = 'done';

            return view('buygame', compact('status', 'userGame', 'friends'));
        } else {
            $status = 'already';

            return view('buygame', compact('status', 'userGame', 'friends'));
        }
    }

    public function giftGame(Request $request) {
        $userGame = UserGame::where('user_id', '=', $request->friend)
        ->where('game_id', '=', $request->game_id)->first();

        $friends = Friend::where('user_id', '=', Auth::user()->id)
        ->where('status', '=', 'accepted')
        ->get();

        if($userGame == null) {
            $userGame = UserGame::create([
                'user_id' => $request->friend,
                'game_id' => $request->game_id,
            ]);

            $status = 'done';

            return view('buygame', compact('status', 'userGame', 'friends'));
        } else {
            $status = 'already';

            return view('buygame', compact('status', 'userGame', 'friends'));
        }
    }
}
