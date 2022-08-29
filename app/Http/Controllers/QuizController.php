<?php

namespace App\Http\Controllers;

use App\Models\Quiz;
use Illuminate\Http\Request;
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
            'description' => 'required'
        ]);
        $formData['slug'] = Str::slug($request->input('title'));

        if ($request->hasFile('cover_image')) {
            $formData['cover_image'] = $request->file('cover_image')->store('quizzes/cover-images', 'public');
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
}
