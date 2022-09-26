<?php

namespace App\Http\Controllers;

use App\Models\Answer;
use App\Models\CompletedQuiz;
use App\Models\Question;
use App\Models\Quiz;
use App\Models\SelectedAnswer;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CompletedQuizController extends Controller
{
    // Store a Completed Quiz
    public function store(Request $request, Quiz $quiz, Question $question)
    {
        $validator = Validator::make($request->all(), [
            'answer_number' => 'required|numeric'
        ]);

        if ($validator->fails()) {
            return redirect("/quizzes/$quiz->slug/play/$question->question_number")
                ->withErrors($validator)
                ->withInput();
        }

        $answer = Answer::where([
            ['question_id', $question->id],
            ['answer_number', $request->input('answer_number')]
        ])->first();

        $completedQuiz = CompletedQuiz::where([
            ['quiz_id', $quiz->id],
            ['user_id', $request->user()->id]
        ])->first();

        if(!$completedQuiz) {
            $completedQuiz = CompletedQuiz::create([
                'quiz_id' => $quiz->id,
                'user_id' => $request->user()->id,
                'total_questions' => $quiz->questions()->count(),
                'result' => $request->input('answer_number') == $question->correct_answer ? 1 : 0
            ]);
        } else {
            $currentResult = $completedQuiz->result;
            $completedQuiz->result = $request->input('answer_number') == $question->correct_answer
                ? $currentResult + 1
                : $currentResult;
            $completedQuiz->save();
        }

        $selectedAnswer = new SelectedAnswer([
            'completed_quiz_id' => $completedQuiz->id,
            'question_id' => $question->id,
            'answer_id' => $answer->id
        ]);
        $selectedAnswer->save();

        $nextQuestion = $quiz->questions()
            ->where('question_number', $question->question_number + 1)
            ->first();

        if(empty($nextQuestion) && intval($question->question_number) == intval($quiz->questions()->count())) {
            return redirect("/quizzes/$quiz->slug/result/$completedQuiz->id");
        }
        return redirect("/quizzes/$quiz->slug/play/$nextQuestion->question_number");
    }


    // Show the Quiz result
    public function result(Quiz $quiz, CompletedQuiz $completedQuiz)
    {
        $result = "You got $completedQuiz->result hits out of $completedQuiz->total_questions";

        return view('quizzes.result', [
            'completedQuiz' => $completedQuiz,
            'quiz' => $quiz,
            'result' => $result
        ]);
    }
}
