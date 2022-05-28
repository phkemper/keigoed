<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Quiz;
use App\Models\Question;

class QuestionController extends Controller
{
    /**
     * Show the questions in the quiz.
     * 
     * @param integer $id
     *   Quiz ID.
     */
    public function index(Request $request, $id)
    {
        $quiz = Quiz::where('id', $id)->first();
        
        // Check if the user is the quizmaster.
        if ( !$quiz || !Auth::user()->isQuizMaster($quiz) )
        {
            return redirect('/quizzes')->withErrors(['msg' => __('quiz.notfound')]);
        }
        
        return view('questions.index', ['quiz' => $quiz, 'questions' => $quiz->getQuestions()]);
    }
    
    /**
     * Create a question.
     * 
     * @param integer $id
     *   Quiz ID.
     */
    public function create(Request $request, $id)
    {
        $quiz = Quiz::where('id', $id)->first();
        
        // Check if the user is the quizmaster.
        if ( !$quiz || !Auth::user()->isQuizMaster($quiz) )
        {
            return redirect('/quizzes')->withErrors(['msg' => __('quiz.notfound')]);
        }
        
        return view('questions.create', ['quiz' => $quiz]);
    }
    
    /**
     * Store a newly created question.
     * 
     * @param integer $id
     *   Quiz ID.
     */
    public function store(Request $request, $id)
    {
        $quiz = Quiz::where('id', $id)->first();
        
        // Check if the user is the quizmaster.
        if ( !$quiz || !Auth::user()->isQuizMaster($quiz) )
        {
            return redirect('/quizzes')->withErrors(['msg' => __('quiz.notfound')]);
        }
        
        $validated = $request->validate([
            'questiontext' => 'required',
            'questionimage' => 'image|mimes:jpg,jpeg,png|max:1024',
            'explainimage' => 'image|mimes:jpg,jpeg,png|max:1024',
        ]);
        
        $newSeqNr = count($quiz->getQuestions());
        $question = new Question;
        $question->quizid = $id;
        $question->seqnr = $newSeqNr;
        $question->questiontext = $request->input('questiontext');
        if ( $request->file('questionimage') )
        {
            $mime = $request->file('questionimage')->getMimeType();
            $question->questionimage = 'data:' . $mime . ';base64,' . base64_encode(file_get_contents($request->file('questionimage')->getRealPath()));
        }
        else
        {
            $question->questionimage = '';
        }
        $question->explaintext = strlen($request->input('explaintext')) ? $request->input('explaintext') : ' ';
        if ( $request->file('explainimage') )
        {
            $mime = $request->file('explainimage')->getMimeType();
            $question->explainimage = 'data:' . $mime . ';base64,' . base64_encode(file_get_contents($request->file('explainimage')->getRealPath()));
        }
        else
        {
            $question->explainimage = '';
        }
        $question->save();
        
        return redirect('/quizzes/' . $quiz->id . '/questions');
    }
    
    /**
     * Show a single question for editing.
     *
     * @param integer $quizid
     *   Quiz ID.
     * @param integer $questionid
     *   Question ID.
     */
    public function show(Request $request, $quizid, $questionid)
    {
        $quiz = Quiz::where('id', $quizid)->first();
        
        // Check if the user is the quizmaster.
        if ( !$quiz || !Auth::user()->isQuizMaster($quiz) )
        {
            return redirect('/quizzes/' . $quizid . '/questions')->withErrors(['msg' => __('question.notfound')]);
        }
        
        $question = Question::find($questionid);
        if ( !$question )
        {
            return redirect('/quizzes/' . $quizid . '/questions')->withErrors(['msg' => __('question.notfound')]);
        }
        
        return view('questions.edit', ['quiz' => $quiz, 'question' => $question]);
    }
    
    /**
     * Update existing question.
     *
     * @param integer $quizid
     *   Quiz ID.
     * @param integer $questionid
     *   Question ID.
     */
    public function update(Request $request, $quizid, $questionid)
    {
        $validated = $request->validate([
            'questiontext' => 'required',
            'questionimage' => 'image|mimes:jpg,jpeg,png|max:1024',
            'explainimage' => 'image|mimes:jpg,jpeg,png|max:1024',
        ]);
        
        // Get the quiz if it exists.
        $quiz = Quiz::where('id', $quizid)->first();
        
        // Check if the user is the quizmaster.
        if ( !$quiz || !Auth::user()->isQuizMaster($quiz))
        {
            return redirect('/quizzes/' . $quizid . '/questions')->withErrors(['msg' => __('question.notfound')]);
        }
        
        $question = Question::find($questionid);
        if ( !$question )
        {
            return redirect('/quizzes/' . $quizid . '/questions')->withErrors(['msg' => __('question.notfound')]);
        }
        
        $question->questiontext = $request->input('questiontext', null);
        if ( $request->file('questionimage') )
        {
            $mime = $request->file('questionimage')->getMimeType();
            $question->questionimage = 'data:' . $mime . ';base64,' . base64_encode(file_get_contents($request->file('questionimage')->getRealPath()));
        }
        elseif ( $request->input('questionimagedelete', false))
        {
            $question->questionimage = '';
        }
        $question->explaintext = $request->input('explaintext', null);
        if ( $request->file('explainimage') )
        {
            $mime = $request->file('explainimage')->getMimeType();
            $question->explainimage = 'data:' . $mime . ';base64,' . base64_encode(file_get_contents($request->file('explainimage')->getRealPath()));
        }
        elseif ( $request->input('explainimagedelete', false))
        {
            $question->explainimage = '';
        }
        $question->save();
        
        return redirect('/quizzes/' . $quizid . '/questions')->with('status', __('question.saved'));
    }
}
