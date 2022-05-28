<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Quiz;
use App\Models\UserQuiz;
use App\Models\Role;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    
    /**
     * Quizzes the user is quiz master of.
     * 
     * @return Quiz[]
     */
    public function ownsQuizzes()
    {
        $userID = Auth::user()->id;
        
        $quizzes = DB::table('quizzes')
            ->join('user_quizzes', 'user_quizzes.quizid', '=', 'quizzes.id')
            ->where('user_quizzes.roleid', Role::QUIZMASTER)
            ->where('user_quizzes.userid', $userID)
            ->orderBy('quizzes.created_at', 'desc')
            ->select('quizzes.id', 'quizzes.name', 'quizzes.created_at')
            ->get();
        
        if ( $quizzes )
        {
            foreach ( $quizzes as $quiz )
            {
                $quiz->expires = strftime(__('general.datefmt'), strtotime($quiz->created_at) + 30*24*60*60);
            }
        }
        
        return $quizzes;
    }
    
    /**
     * Check if a user is quizmaster of a quiz.
     * 
     * @param Quiz $quiz
     *   Quiz to check.
     * @return boolean
     */
    public function isQuizMaster(Quiz $quiz)
    {
        $uq = UserQuiz::where('quizid', $quiz->id)
        ->where('userid', $this->id)
        ->where('roleid', Role::QUIZMASTER)
        ->first();
        
        return !empty($uq);
    }
}
