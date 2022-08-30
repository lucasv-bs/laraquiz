<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SelectedAnswer extends Model
{
    use HasFactory;

    protected $fillable = [
        'completed_quiz_id',
        'question_id',
        'answer_id'
    ];


    public function completedQuiz()
    {
        return $this->belongsTo(CompletedQuiz::class);
    }
}
