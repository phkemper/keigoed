<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Quiz;
use App\Models\Question;
use App\Models\Answer;
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
        $quiz->introtext = strlen($request->input('introtext')) ? $request->input('introtext') : null;
        if ( $request->file('introimage') )
        {
            $mime = $request->file('introimage')->getMimeType();
            $quiz->introimage = 'data:' . $mime . ';base64,' . base64_encode(file_get_contents($request->file('introimage')->getRealPath()));
        }
        else
        {
            $quiz->introimage = '';
        }
        $quiz->outrotext = strlen($request->input('outrotext')) ? $request->input('outrotext') : null;
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
     * Show a single quiz for editing.
     * 
     * @param integer $id
     *   Quiz ID.
     */
    public function show(Request $request, $id)
    {
        $quiz = Quiz::where('id', $id)->first();
        
        // Check if the user is the quizmaster.
        if ( !$quiz || !Auth::user()->isQuizMaster($quiz) )
        {
            return redirect('/quizzes')->withErrors(['msg' => __('quiz.notfound')]);
        }
        
        return view('quizzes.edit', ['quiz' => $quiz]);
    }
    
    /**
     * Update existing quiz.
     * 
     * @param integer $id
     *   Quiz ID.
     */
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'required|max:255',
            'introimage' => 'image|mimes:jpg,jpeg,png|max:1024',
            'outroimage' => 'image|mimes:jpg,jpeg,png|max:1024',
        ]);
        
        // Get the quiz if it exists.
        $quiz = Quiz::where('id', $id)->first();
        
        // Check if the user is the quizmaster.
        if ( !$quiz || !Auth::user()->isQuizMaster($quiz))
        {
            return redirect('/quizzes')->withErrors(['msg' => __('quiz.notfound')]);
        }
        
        $quiz->name = $request->input('name');
        $quiz->introtext = $request->input('introtext', null);
        if ( $request->file('introimage') )
        {
            $mime = $request->file('introimage')->getMimeType();
            $quiz->introimage = 'data:' . $mime . ';base64,' . base64_encode(file_get_contents($request->file('introimage')->getRealPath()));
        }
        elseif ( $request->input('introimagedelete', false))
        {
            $quiz->introimage = '';
        }
        $quiz->outrotext = $request->input('outrotext', null);
        if ( $request->file('outroimage') )
        {
            $mime = $request->file('outroimage')->getMimeType();
            $quiz->outroimage = 'data:' . $mime . ';base64,' . base64_encode(file_get_contents($request->file('outroimage')->getRealPath()));
        }
        elseif ( $request->input('outroimagedelete', false))
        {
            $quiz->outroimage = '';
        }
        $quiz->save();
        
        return redirect('/quizzes')->with('status', __('quiz.saved'));
    }
    
    /**
     * Verify deletion.
     * 
     * @param integer $id
     *   Quiz ID.
     */
    public function delete(Request $request, $id)
    {
        // Get the quiz if it exists.
        $quiz = Quiz::where('id', $id)->first();
        
        // Check if the user is the quizmaster.
        if ( !$quiz || !Auth::user()->isQuizMaster($quiz))
        {
            return redirect('/quizzes')->withErrors(['msg' => __('quiz.notfound')]);
        }
        
        // Show delete verification message.
        return view('quizzes.delete', ['quiz' => $quiz]);
    }
    
    /**
     * Delete an existing quiz.
     * 
     * @param integer $id
     *   Quiz ID.
     */
    public function destroy(Request $request, $id)
    {
        // Get the quiz if it exists.
        $quiz = Quiz::where('id', $id)->first();
        
        // Check if the user is the quizmaster.
        if ( !$quiz || !Auth::user()->isQuizMaster($quiz))
        {
            return redirect('/quizzes')->withErrors(['msg' => __('quiz.notfound')]);
        }
        
        $questions = Question::where('quizid', $quizid)->get();
        foreach ( $questinos as $question )
        {
            $answers = Answer::where('questionid', $questionid)->get();
            foreach ( $answers as $answer )
            {
                DB::table('user_answers')->where('answerid', $answer->id)->delete();
                $answer->delete();
            }
            $question->delete();
        }
        
        DB::table('user_quizzes')->where('userid', Auth::user()->id)->where('quizid', $id)->delete();
        
        DB::table('quizzes')->where('id', $id)->delete();
        
        return redirect('/quizzes')->with('status', __('quiz.deleted'));
    }
    
    /**
     * Run the quiz.
     * 
     * @param integer $id
     *   Quiz ID.
     */
    public function run(Request $request, $id)
    {
        // Get the quiz if it exists.
        $quiz = Quiz::where('id', $id)->first();
        
        // Check if the user is the quizmaster.
        if ( !$quiz || !Auth::user()->isQuizMaster($quiz))
        {
            return redirect('/quizzes')->withErrors(['msg' => __('quiz.notfound')]);
        }
        
        $quiz->started_at = strftime('%Y-%m-%d %H:%M:%S');
        $quiz->save();
        
        return view('quizzes.run', ['quiz' => $quiz]);
    }
    
    /**
     * Stop the quiz.
     * 
     * @param integer $id
     *   Quiz ID.
     */
    public function stop(Request $request, $id)
    {
        // Get the quiz if it exists.
        $quiz = Quiz::where('id', $id)->first();
        
        // Check if the user is the quizmaster.
        if ( !$quiz || !Auth::user()->isQuizMaster($quiz))
        {
            return redirect('/quizzes')->withErrors(['msg' => __('quiz.notfound')]);
        }
        
        $quiz->started_at = null;
        $quiz->save();
        
        return redirect('/quizzes')->with('status', __('quiz.stopped'));
    }
}
