<?php

namespace App\Http\Controllers;

use App\Models\Answer;
use App\Models\Question;
use App\Models\Quiz;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class QuestionController extends Controller
{
    // Show form to create a Question
    public function create(Quiz $quiz)
    {
        $questionNumber = intval($quiz->questions()->count()) + 1;
        return view('questions.create', [
            'quiz' => $quiz,
            'questionNumber' => $questionNumber,

        ]);
    }


    // Store a Question
    public function store(Request $request, Quiz $quiz)
    {
        $questionData = $request->validate([
            'title' => 'required',
            'question_number' => 'required|numeric',
            'correct_answer' => 'required|numeric'
        ]);
        $question = new Question($questionData);
        $question->quiz_id = $quiz->id;
        $question->save();

        $answers = $request->input('answers');
        foreach($answers as $key => $data) {
            $answerDataValidator = Validator::make($request->all(), [
                "answers.$key.answer_text" => 'required',
                "answers.$key.answer_number" => 'required|numeric'
            ]);
            
            if($answerDataValidator->fails()) {
                return redirect("/quizzes/$quiz->slug/questions/create")
                    ->withErrors($answerDataValidator)
                    ->withInput();
            }

            $answer = new Answer($data);
            $answer->question_id = $question->id;
            $answer->save();
        }

        return redirect("/quizzes/$quiz->slug/questions/create")->with([
            'message' => 'Question created successfully',
            'status' => 'success'
        ]);
    }
}
