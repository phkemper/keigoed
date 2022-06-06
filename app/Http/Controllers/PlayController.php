<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Quiz;

class PlayController extends Controller
{
    /**
     * Main play page.
     */
    public function index(Request $request)
    {
        $nickname = $request->session()->get('nickname');
        $quizid = $request->session()->get('quizid');
        
        $quiz = Quiz::find($quizid);
        
        // Register the player.
        $player = new Player;
        $player->quizid = $quizid;
        $player->nickname = $nickname;
        $player->save();
        
        
        return view('play', ['quiz' => $quiz, 'player' => $player, 'stage' => 'intro']);
    }
}
