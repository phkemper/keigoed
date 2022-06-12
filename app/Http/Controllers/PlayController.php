<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Quiz;
use App\Models\Player;

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
        
        // Calculate the intro image size.
        $w = $quiz->introwidth;
        $h = $quiz->introheight;
        $aspect = $w / $h;
        if ( $aspect > 1.4 )
        {
            $width = '95vw';
            $height = (95 / $aspect) . 'vw';
        }
        else
        {
            $width = (60 * $aspect) . 'vh';
            $height = '60vh';
        }
        
        
        return view('play', ['quiz' => $quiz, 'player' => $player, 'stage' => 'intro', 'width' => $width, 'height' => $height,]);
    }
}
