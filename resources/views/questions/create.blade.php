@extends('layouts.app')

@section('scripts')
    @vite('resources/js/questions/addAnswer.js')
@endsection

@section('content')
    <div class="container px-4">
        <x-flash-message />
        
        <div class="row">
            <x-card class="col">
                <form method="POST" action="/quizzes/{{ $quiz->slug }}/questions/store"
                    enctype="application/x-www-form-urlencoded" class="needs-validation">
                    @csrf

                    <div class="mb-3 row">
                        <div class="col-md-3 col-sm-12">
                            <label for="questionNumber" class="form-label">Question number</label>
                            <input type="number" class="form-control @error('question_number') is-invalid @enderror"
                                id="questionNumber" name="question_number" 
                                value="{{ $questionNumber }}" readonly>

                            @error('question_number')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <div class="col">
                            <label for="questionTitle" class="form-label">Question title</label>
                            <input type="text" class="form-control @error('title') is-invalid @enderror"
                                id="questionTitle" name="title" 
                                value="{{ old('title') }}"
                                placeholder="Enter the Question title">

                            @error('title')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-3 col-sm-12">
                            <label for="correctAnswer" class="form-label">Enter the correct answer number</label>
                            <input type="number" class="form-control @error('correct_answer') is-invalid @enderror"
                                id="correctAnswer" name="correct_answer" 
                                value="{{ old('correct_answer') }}">

                            @error('correct_answer')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <fieldset class="mb-3">
                        <div class="mb-3 row justify-content-between">
                            <div class="col">
                                <legend>Answers</legend>
                            </div>
                            <div class="col text-end">
                                <button type="button" 
                                    class="btn btn-success" 
                                    id="btnAddAnswer"
                                    data-element=".answer">Add answer</button>
                            </div>
                        </div>
                        <div class="mb-3 row answer">
                            <div class="col-md-3 col-sm-12">
                                <label for="answerNumber1" class="form-label"
                                    data-field-label="answerNumber">Answer number</label>
                                <input type="number" class="form-control @error('answer_number') is-invalid @enderror"
                                    id="answerNumber1" name="answers[0][answer_number]" 
                                    data-field-name="answerNumber"
                                    value="1"
                                    readonly>

                                @error('answer_number')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col">
                                <label for="answerText1" class="form-label"
                                    data-field-label="answerText">Answer text</label>
                                <input type="text" class="form-control @error('answer_text') is-invalid @enderror"
                                    id="answerText1" name="answers[0][answer_text]" 
                                    data-field-name="answerText"
                                    value=""
                                    placeholder="Enter the Answer text">

                                @error('answer_text')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        
                    </fieldset>

                    <div class="row justify-content-between">
                        <div class="col">
                            <button class="btn btn-primary">Save</button>
                        </div>
                        <div class="col text-end">
                            <a href="/quizzes/{{$quiz->slug}}/edit" class="btn btn-danger">Return to Quiz</a>
                        </div>
                    </div>
                </form>
            </x-card>
        </div>
    </div>
@endsection
