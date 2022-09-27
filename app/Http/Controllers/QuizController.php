<?php

namespace App\Http\Controllers;

use App\Models\Quiz;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class QuizController extends Controller
{
    // Show all quizzes
    public function index()
    {
        $quizzes = Quiz::all();

        return view('quizzes.index', [
            'quizzes' => $quizzes
        ]);
    }

    
    // Show a Quiz
    public function show(Request $request, Quiz $quiz)
    {
        $questionsAmount = $quiz->questions()->count();
        $averageScore = $quiz->completedQuizzes()->avg('result');
        
        return view('quizzes.show', [
            'quiz' => $quiz,
            'questionsAmount' => $questionsAmount,
            'averageScore' => $averageScore
        ]);
    }


    // Show form to create a Quiz
    public function create(Request $request)
    {
        return view('quizzes.create');
    }


    // Store a Quiz
    public function store(Request $request, $addQuestion = false)
    {
        $formData = $request->validate([
            'title' => 'required',
            'description' => 'required',
            'cover_image' => 'nullable|image|max:2048'
        ]);
        $formData['slug'] = Str::slug($request->input('title'));

        if ($request->hasFile('cover_image')) {
            $formData['cover_image'] = $request->file('cover_image')->store('quizzes/cover-images', 's3');

            Storage::setVisibility($formData['cover_image'], 'public');
        }
        $formData['user_id'] = $request->user()->id;

        $quiz = Quiz::create($formData);

        if ($addQuestion) {
           return $quiz; 
        }

        return redirect('/quizzes')->with([
            'message' => 'Quiz created successfully',
            'status' => 'success'
        ]);
    }


    // Store a Quiz with a flag to add a question
    public function storeAndAdd(Request $request)
    {
        $quiz = $this->store($request, true);

        return redirect("/quizzes/$quiz->slug/questions/create")->with([
            'message' => 'Quiz created successfully',
            'status' => 'success'
        ]);
    }


    // Show form to edit a Quiz
    public function edit(Request $request, Quiz $quiz)
    {
        // Make sure logged in user is owner
        if($quiz->user_id != $request->user()->id) {
            abort(403, 'Unauthorized action');
        }
        
        return view('quizzes.edit', [
            'quiz' => $quiz,
            'questions' => $quiz->questions
        ]);
    }


    // Update a Quiz
    public function update(Request $request, Quiz $quiz)
    {
        $formData = $request->validate([
            'title' => 'required',
            'description' => 'required',
            'cover_image' => 'nullable|image|max:2048'
        ]);
        $formData['slug'] = Str::slug($request->input('title'));

        if ($request->hasFile('cover_image')) {
            $formData['cover_image'] = $request->file('cover_image')->store('quizzes/cover-images', 's3');

            Storage::setVisibility($formData['cover_image'], 'public');
        }
        $formData['user_id'] = $request->user()->id;

        $quiz->update($formData);

        return redirect("/quizzes/$quiz->slug/edit")->with([
            'message' => 'Quiz updated successfully',
            'status' => 'success'
        ]);
    }


    // Delete a Quiz
    public function destroy(Request $request, Quiz $quiz)
    {
        // Make sure logged in user is owner
        if($quiz->user_id != $request->user()->id) {
            abort(403, 'Unauthorized action');
        }
        // Delete all completed quizzes
        $completedQuizzes = $quiz->completedQuizzes;
        foreach($completedQuizzes as $completeQuiz) {
            $selectedAnswers = $completeQuiz->selectedAnswers;
            foreach($selectedAnswers as $selectedAnswer) {
                $selectedAnswer->delete();
            }

            $completeQuiz->delete();
        }
        // Delete all questions
        $questions = $quiz->questions;
        foreach($questions as $question) {
            $answers = $question->answers;
            foreach($answers as $answer) {
                $answer->delete();
            }

            $question->delete();
        }
        $quiz->delete();

        return back()->with([
            'message' => 'Quiz deleted successfully',
            'status' => 'danger'
        ]);
    }


    // Manage Quizzes
    public function manage(Request $request)
    {
        return view('quizzes.manage', [
            'quizzes' => $request->user()->quizzes()->get()       
        ]);
    }


    // Plays a Quiz
    public function play(Quiz $quiz)
    {
        $firstQuestion = $quiz->questions()
            ->orderBy('question_number')
            ->first();
        
        return redirect("/quizzes/$quiz->slug/play/$firstQuestion->question_number");
    }
}
