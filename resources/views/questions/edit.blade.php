@extends('layouts.app')

@section('scripts')
    @vite('resources/js/questions/manageAnswer.js')
@endsection

@section('content')
    <div class="container px-4">
        <x-flash-message />
        
        <div class="row">
            <x-card class="col">
                <form method="POST" action="/quizzes/{{ $quiz->slug }}/questions/{{$question->question_number}}/update"
                    enctype="application/x-www-form-urlencoded" class="needs-validation">
                    @csrf
                    @method('PUT')

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
                                value="{{$question->title}}"
                                placeholder="Enter the Question title">

                            @error('title')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-3 col-sm-12">
                            <label for="correctAnswer" class="form-label">Enter the correct answer number</label>
                            <input type="number" class="form-control @error('correct_answer') is-invalid @enderror"
                                id="correctAnswer" name="correct_answer" 
                                value="{{$question->correct_answer}}">

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
                        @foreach ($answers as $answer)
                            <div class="row mb-3 align-items-end answer">
                                <div class="col-md-3 col-sm-12">
                                    <label for="answerNumber{{$answer->answer_number}}" class="form-label"
                                        data-field-label="answerNumber">Answer number</label>
                                    <input type="number" class="form-control @error('answer_number') is-invalid @enderror"
                                        id="answerNumber{{$answer->answer_number}}" 
                                        name="answers[{{$answer->answer_number - 1}}][answer_number]" 
                                        data-field-name="answerNumber"
                                        value="{{$answer->answer_number}}"
                                        readonly>

                                    @error('answer_number')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col">
                                    <label for="answerText{{$answer->answer_number}}" class="form-label"
                                        data-field-label="answerText">Answer text</label>
                                    <input type="text" class="form-control @error('answer_text') is-invalid @enderror"
                                        id="answerText{{$answer->answer_number}}" 
                                        name="answers[{{$answer->answer_number - 1}}][answer_text]" 
                                        data-field-name="answerText"
                                        value="{{$answer->answer_text}}"
                                        placeholder="Enter the Answer text">

                                    @error('answer_text')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-1">
                                    <button type="button" class="btn btn-danger answerDelete">Delete</button>
                                </div>
                            </div>
                        @endforeach
                    </fieldset>

                    <div class="row justify-content-between">
                        <div class="col">
                            <button class="btn btn-primary">Save</button>
                        </div>
                        <div class="col text-end">
                            <a href="/quizzes/{{$quiz->slug}}/edit" class="btn btn-secondary">Return to Quiz</a>
                        </div>
                    </div>
                </form>
            </x-card>
        </div>
    </div>
@endsection
