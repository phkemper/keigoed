<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Question;
use App\Models\User;

class Quiz extends Model
{
    use HasFactory;
    
    /**
     * Generate a unique PIN.
     * 
     * @return string
     */
    public static function generatePIN()
    {
        while ( true )
        {
            $pin = rand(100000,999999);
            $quiz = Quiz::where('pin', '=', $pin)->first();
            if ($quiz === null) {
                return $pin;
            }
        }
    }
    
    /**
     * Return the questions.
     *
     * @return Question[]
     */
    public function getQuestions()
    {
        $questions = Question::where('quizid', $this->id)
                    ->orderBy('seqnr')->get();
        
        return $questions;
    }
}
