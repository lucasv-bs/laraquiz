<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'question_number',
        'correct_answer'
    ];


    public function quiz()
    {
        return $this->belongsTo(Quiz::class);
    }


    public function answers()
    {
        return $this->hasMany(Answer::class);
    }
}
