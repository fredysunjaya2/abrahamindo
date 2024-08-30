<?php

namespace App\Http\Controllers;

use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MessageController extends Controller
{
    //
    public function index($id) {
        $messages = Message::where('sender_id', '=', Auth::id())
        ->orWhere('receiver_id', '=', Auth::id())
        ->get();

        return view('message', compact('messages', 'id'));
    }

    public function sendMessage(Request $request) {
        $messages = Message::create([
            'sender_id' => Auth::id(),
            'receiver_id' => $request->receiver_id,
            'message' => $request->message,
        ]);

        return redirect()->route('message', $request->receiver_id);
    }
}
