<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quiz extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'description',
        'cover_image',
        'user_id'
    ];


    public function completedQuizzes()
    {
        return $this->hasMany(CompletedQuiz::class);
    }
    
    
    public function questions()
    {
        return $this->hasMany(Question::class);
    }


    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
