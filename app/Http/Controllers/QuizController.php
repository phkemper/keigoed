<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Quiz;
use App\Models\PricingPlan;
use App\Models\Role;
use App\Models\UserQuiz;

class QuizController extends Controller
{
    /**
     * Show a list of quizzes.
     */
    public function index()
    {
        $user = Auth::user();
        return view('quizzes.index', [
            'quizzes' => $user->ownsQuizzes()
        ]);
    }
    
    /**
     * Create a quiz.
     */
    public function create()
    {
        return view('quizzes.create');
    }
    
    /**
     * Store a newly created quiz.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|max:255',
            'introimage' => 'image|mimes:jpg,jpeg,png|max:1024',
            'outroimage' => 'image|mimes:jpg,jpeg,png|max:1024',
        ]);
        
        $quiz = new Quiz;
        $quiz->pin = Quiz::generatePIN();
        $quiz->name = $request->input('name');
        $quiz->introtext = $request->input('introtext', null);
        if ( $request->file('introimage') )
        {
            $mime = $request->file('introimage')->getMimeType();
            $quiz->introimage = 'data:' . $mime . ';base64,' . base64_encode(file_get_contents($request->file('introimage')->getRealPath()));
        }
        else
        {
            $quiz->introimage = '';
        }
        $quiz->outrotext = $request->input('outrotext', null);
        if ( $request->file('outroimage') )
        {
            $mime = $request->file('outroimage')->getMimeType();
            $quiz->outroimage = 'data:' . $mime . ';base64,' . base64_encode(file_get_contents($request->file('outroimage')->getRealPath()));
        }
        else
        {
            $quiz->outroimage = '';
        }
        $quiz->pricingplanid = PricingPlan::FREE;
        $quiz->save();
        
        $userQuiz = new UserQuiz;
        $userQuiz->userid = Auth::user()->id;
        $userQuiz->quizid = $quiz->id;
        $userQuiz->roleid = Role::QUIZMASTER;
        $userQuiz->save();
        
        return redirect('/quizzes');
    }
    
    /**
     * Show a single quiz.
     */
    public function show(Request $request, $id)
    {
        
    }
    
    /**
     * Update existing quiz.
     */
    public function update(Request $request, $id)
    {
        
    }
    
    /**
     * Delete an existing quiz.
     */
    public function destroy(Request $request, $id)
    {
        
    }
    
    /**
     * Rund the quiz.
     */
    public function run(Request $request, $id)
    {
        
    }
}
