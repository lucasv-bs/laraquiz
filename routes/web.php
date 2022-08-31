<?php

use App\Http\Controllers\CompletedQuizController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\QuizController;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

// Show all quizzes
Route::get('/quizzes', [QuizController::class, 'index']);

// Show form to create a Quiz
Route::get('/quizzes/create', 
    [QuizController::class, 'create']
)->middleware('auth');

// Store a Quiz
Route::post('/quizzes/store', 
    [QuizController::class, 'store']
)->middleware('auth');

// Store a Quiz with a flag to add a question
Route::post('/quizzes/store-and-add', 
    [QuizController::class, 'storeAndAdd']
)->middleware('auth');

// Show a Quiz
Route::get('/quizzes/{quiz:slug}', 
    [QuizController::class, 'show']
)->middleware('auth');


// Show form to create a Question
Route::get('/quizzes/{quiz:slug}/questions/create', 
    [QuestionController::class, 'create']
)->middleware('auth');

// Store a Question
Route::post('/quizzes/{quiz:slug}/questions/store', 
    [QuestionController::class, 'store']
)->middleware('auth');


// Plays a Quiz
Route::get('/quizzes/{quiz:slug}/play', 
    [QuizController::class, 'play']
)->middleware('auth');

// Performs a Quiz Question
Route::get('/quizzes/{quiz:slug}/play/{question:question_number}', 
    [QuestionController::class, 'perform']
)->middleware('auth');

// Store a Completed Quiz
Route::post('/quizzes/{quiz:slug}/play/{question:question_number}', 
    [CompletedQuizController::class, 'store']
)->middleware('auth');

// Show the result of a Completed Quiz
Route::get('/quizzes/{quiz:slug}/result/{completedQuiz}', 
    [CompletedQuizController::class, 'result']
);


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
