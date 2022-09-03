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


    // Show form to edit a Question
    public function edit(Request $request, Quiz $quiz, Question $question)
    {
        // Check if user is Quiz owner
        if($quiz->user_id != $request->user()->id) {
            abort(403, 'Unauthorized Action');
        }

        return view('questions.edit', [
            'quiz' => $quiz,
            'question' => $question,
            'questionNumber' => $question->question_number,
            'answers' => $question->answers
        ]);
    }


    // Update a Question
    public function update(Request $request, Quiz $quiz, Question $question)
    {
        $questionData = $request->validate([
            'title' => 'required',
            'question_number' => 'required|numeric',
            'correct_answer' => 'required|numeric'
        ]);
        
        // Validate the correct answer number entered
        $correctAnswerValidator = Validator::make($request->all(), [
            'correct_answer' => 'required|numeric'
        ]);
        
        $answersAmount = count($request->input('answers'));
        $correctAnswerValidator->sometimes('correct_answer', "between:1,$answersAmount", function($input, $value) {
            $answersAmount = count($input->answers);
            return $input->correct_answer > $answersAmount;
        });
        if($correctAnswerValidator->fails()) {
            return redirect("/quizzes/$quiz->slug/questions/$question->question_number/edit")
                        ->withErrors($correctAnswerValidator)
                        ->withInput();
        }

        // Update the question
        $question->update($questionData);

        // Update the answers
        $newAnswers = $request->input('answers');
        $storedListAnswers = $question->answers;
        foreach($storedListAnswers as $storedAnswer) {
            $existInNewAnswers = false;

            foreach($newAnswers as $key => $data) {
                $answerDataValidator = Validator::make($request->all(), [
                    "answers.$key.answer_text" => 'required',
                    "answers.$key.answer_number" => 'required|numeric'
                ]);
                
                if($answerDataValidator->fails()) {
                    return redirect("/quizzes/$quiz->slug/questions/$question->question_number/edit")
                        ->withErrors($answerDataValidator)
                        ->withInput();
                }
                // Updates existing answers
                if ($storedAnswer->answer_number == intval($data['answer_number'])) {
                    $existInNewAnswers = true;
                    $storedAnswer->answer_text = $data['answer_text'];
                    $storedAnswer->save();
                }
            }
            // Removes the answer of the database
            if($existInNewAnswers == false) {
                $storedAnswer->delete();
            }
        }
        
        // Adds new answers
        $storedAnswersAmount = $question->answers()->count();
        foreach($newAnswers as $key => $data) {
            if ($storedAnswersAmount < intval($data['answer_number'])) {
                $answer = new Answer($data);
                $answer->question_id = $question->id;
                $answer->save();
            }
        }

        return redirect("/quizzes/$quiz->slug/questions/$question->question_number/edit")->with([
            'message' => 'Question updated successfully',
            'status' => 'success'
        ]);
    }


    // Delete a Question
    public function destroy(Request $request, Quiz $quiz, Question $question)
    {
        // Check if user is Quiz owner
        if($quiz->user_id != $request->user()->id) {
            abort(403, 'Unauthorized Action');
        }
        
        $completedQuizzes = $quiz->completedQuizzes()->count();
        if ($completedQuizzes > 0) {
            return back()->with([
                'message' => 'Unable to delete question, because this quiz has already played at least once',
                'status' => 'danger'
            ]);
        }
        // Delete the question
        $answers = $question->answers;
        foreach($answers as $answer) {
            $answer->delete();
        }
        $question->delete();
        $this->adjustQuestionNumber($quiz);

        return redirect("/quizzes/$quiz->slug/edit")
            ->with([
            'message' => 'Question deleted successfully',
            'status' => 'success'
        ]);
    }


    // Performs a Question
    public function perform(Quiz $quiz, Question $question)
    {
        $answers = $question->answers;
        $lastAnswersKey = array_keys($answers->modelKeys());
        $lastAnswersKey = end($lastAnswersKey);
        return view('questions.perform', [
            'quiz' => $quiz,
            'question' => $question,
            'answers' => $answers,
            'lastAnswersKey' => $lastAnswersKey
        ]);
    }


    // Adjust Questions number
    public function adjustQuestionNumber(Quiz $quiz)
    {
        $questions = $quiz->questions()->orderBy('id')->get();
        
        $questionNumber = 1;
        foreach($questions as $question) {
            if(intval($question->question_number) != intval($questionNumber)) {

                $question->question_number = $questionNumber;
                $question->save();
            }
            $questionNumber += 1;
        }
    }
}
