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
        
        return view('play', ['quiz' => $quiz, 'nickname' => $nickname, 'stage' => 'intro']);
    }
}
