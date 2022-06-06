<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Quiz;

class HomeController extends Controller
{
    /**
     * Main home page.
     */
    public function index()
    {
        return view('home');
    }
    
    /**
     * User has submitted a PIN to join.
     * 
     * @param Request $request
     */
    public function join(Request $request)
    {
        $validated = $request->validate([
            'nickname' => 'required|max:255',
            'pin' => 'required|numeric',
        ]);
        
        // Get the quiz if it exists.
        $quiz = Quiz::where('pin', $request->input('pin'))->first();
        
        // Check if the quiz exists and has been started.
        if ( !$quiz || !$quiz->started_at )
        {
            return redirect('/')->withErrors(['msg' => __('quiz.notstarted')]);
        }
        
        $request->session()->put('nickname', $request->input('nickname'));
        $request->session()->put('quizid', $quiz->id);
        
        // Quiz exists and has been started.
        return redirect('/play');
    }
}
