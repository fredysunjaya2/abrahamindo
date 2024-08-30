<?php

namespace App\Http\Controllers;

use App\Models\Friend;
use App\Models\Game;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GameController extends Controller
{
    //
    public function index(Request $request) {
        $gamesId = Game::all()->pluck('id');

        if($request->search != null) {
            $gamesId = Game::whereLike('name', '%' . $request->search . '%')->get()->pluck('id');
        }

        $games = Game::whereIn('id', $gamesId)
        ->paginate(24);

        return view('index', compact('games'));
    }

    public function detail($id) {
        $game = Game::where('id', '=', $id)->first();
        $friends = Friend::where('user_id', '=', Auth::user()->id)
        ->where('status', '=', 'accepted')
        ->get();

        return view('gamedetails', compact('game', 'friends'));
    }
}
