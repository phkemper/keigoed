<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Question;
use App\Models\User;

class Quiz extends Model
{
    use HasFactory;
    
    public function questions()
    {
        return $this->hasMany(Question::class);
    }
    
    public function users()
    {
        return $this->hasMany(User::class);
    }
    
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
}
