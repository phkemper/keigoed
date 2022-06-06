<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Quiz;
use App\Models\Question;
use App\Models\Answer;

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
            'answeraimage' => 'image|mimes:jpg,jpeg,png|max:1024',
            'answerbimage' => 'image|mimes:jpg,jpeg,png|max:1024',
            'answercimage' => 'image|mimes:jpg,jpeg,png|max:1024',
            'answerdimage' => 'image|mimes:jpg,jpeg,png|max:1024',
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
        $question->explaintext = strlen($request->input('explaintext')) ? $request->input('explaintext') : null;
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
        
        // Save the answers.
        foreach ( ['a', 'b', 'c', 'd'] as $n => $l )
        {
            if ( ($l == 'c' || $l == 'd') && !$request->input('answer' . $l . 'text') && !$request->file('answer' . $l . 'image') ) continue;
            $answer = new Answer;
            $answer->questionid = $question->id;
            $answer->seqnr = $n;
            $answer->answertext = $request->input('answer' . $l . 'text');
            if ( $request->file('answer' . $l . 'image') )
            {
                $mime = $request->file('answer' . $l . 'image')->getMimeType();
                $answer->answerimage = 'data:' . $mime . ';base64,' . base64_encode(file_get_contents($request->file('answer' . $l . 'image')->getRealPath()));
            }
            else
            {
                $answer->answerimage = '';
            }
            $answer->correct = $request->input('answercorrect') == $l;
            $answer->save();
        }
        
        return redirect('/quizzes/' . $quiz->id . '/questions#question-' . $question->id);
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
        
        // Get all answers.
        $answers = Answer::where('questionid', $questionid)->orderBy('seqnr')->get();
        
        return view('questions.edit', ['quiz' => $quiz, 'question' => $question, 'answers' => $answers]);
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
            'answeraimage' => 'image|mimes:jpg,jpeg,png|max:1024',
            'answerbimage' => 'image|mimes:jpg,jpeg,png|max:1024',
            'answercimage' => 'image|mimes:jpg,jpeg,png|max:1024',
            'answerdimage' => 'image|mimes:jpg,jpeg,png|max:1024',
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
        
        // Save the answers.
        foreach ( ['a', 'b', 'c', 'd'] as $n => $l )
        {
            $answer = Answer::find($request->input('answer' . $l . 'id'));
            if ( !$answer )
            {
                $answer = new Answer;
                $answer->questionid = $questionid;
            }
            $answer->seqnr = $n;
            $answer->answertext = $request->input('answer' . $l . 'text');
            if ( $request->has('answer' . $l . 'imagedelete') )
            {
                $answer->answerimage = '';
            }
            elseif ( $request->file('answer' . $l . 'image') )
            {
                $mime = $request->file('answer' . $l . 'image')->getMimeType();
                $answer->answerimage = 'data:' . $mime . ';base64,' . base64_encode(file_get_contents($request->file('answer' . $l . 'image')->getRealPath()));
            }
            $answer->correct = $request->input('answercorrect') == $l;
            if ( strlen($answer->answertext) || strlen($answer->answerimage) )
            {
                $answer->save();
            }
            else
            {
                $answer->delete();
            }
        }
        
        return redirect('/quizzes/' . $quizid . '/questions#question-' . $questionid)->with('status', __('question.saved'));
    }

    /**
     * Verify deletion.
     *
     * @param integer $quizid
     *   Quiz ID.
     * @param integer $questionid
     *   Question ID.
     */
    public function delete(Request $request, $quizid, $questionid)
    {
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
        
        // Show delete verification message.
        return view('questions.delete', ['quiz' => $quiz, 'question' => $question]);
    }
    
    /**
     * Delete an existing quiz.
     *
     * @param integer $quizid
     *   Quiz ID.
     * @param integer $questionid
     *   Question ID.
     */
    public function destroy(Request $request, $quizid, $questionid)
    {
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
        
        $answers = Answer::where('questionid', $questionid)->get();
        foreach ( $answers as $answer )
        {
            DB::table('user_answers')->where('answerid', $answer->id)->delete();
            $answer->delete();
        }
        
        $question->delete();
        
        $this->reSequence($quizid);
        
        return redirect('/quizzes/' . $quizid . '/questions')->with('status', __('question.deleted'));
    }
    
    /**
     * Move question up.
     *
     * @param integer $quizid
     *   Quiz ID.
     * @param integer $questionid
     *   Question ID.
     */
    public function up(Request $request, $quizid, $questionid)
    {
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
        
        $previousQuestion = Question::where('seqnr', '<', $question->seqnr)->orderBy('seqnr', 'desc')->first();
        $question->seqnr--;
        $question->save();
        $previousQuestion->seqnr++;
        $previousQuestion->save();
        
        $this->reSequence($quizid);
        
        return redirect('/quizzes/' . $quizid . '/questions#question-' . $questionid);
    }
    
    /**
     * Move question down.
     *
     * @param integer $quizid
     *   Quiz ID.
     * @param integer $questionid
     *   Question ID.
     */
    public function down(Request $request, $quizid, $questionid)
    {
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
        
        $nextQuestion = Question::where('seqnr', '>', $question->seqnr)->orderBy('seqnr', 'asc')->first();
        $question->seqnr++;
        $question->save();
        $nextQuestion->seqnr--;
        $nextQuestion->save();
        
        $this->reSequence($quizid);
        
        return redirect('/quizzes/' . $quizid . '/questions#question-' . $questionid);
    }
    
    /**
     * Resequence all questions, so the sequence number starts at 1
     * and incrementsbij one for every question.
     * 
     * @param integer $quizid
     *   Quiz ID.
     */
    public function reSequence($quizid)
    {
        $questions = Question::where('quizid', $quizid)->orderBy('seqnr')->get();
        
        foreach ( $questions as $index => $question )
        {
            $question->seqnr = $index + 1;
            $question->save();
        }
    }
}
