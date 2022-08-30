<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompletedQuiz extends Model
{
    use HasFactory;

    protected $fillable = [
        'quiz_id',
        'user_id',
        'total_questions',
        'result'
    ];


    public function selectedAnswers()
    {
        return $this->hasMany(SelectedAnswer::class);
    }
    
    
    public function quiz()
    {
        return $this->belongsTo(Quiz::class);
    }


    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
