@extends('layouts.app')

@section('content')
    <div class="container px-4">
        <div class="row">
            <x-flash-message />

            <x-card class="col">
                <h1 class="mb-4">Edit Quiz</h1>
                <form method="POST" action="/quizzes/{{$quiz->slug}}/update" enctype="multipart/form-data"
                    class="needs-validation">
                    @csrf
                    @method('PUT')

                    <div class="row">
                        <label for="quizTitle" class="form-label">Quiz title</label>
                        <input type="text" class="form-control @error('title') is-invalid @enderror" 
                            id="quizTitle" name="title" 
                            value="{{$quiz->title}}"
                            placeholder="Enter the Quiz title">

                        @error('title')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="row mt-3">
                        <label for="quizDescription" class="form-label">Quiz description</label>
                        <textarea class="form-control @error('description') is-invalid @enderror" 
                            id="quizDescription" name="description">{{$quiz->description}}</textarea>

                        @error('description')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="row mt-3">
                        <label for="quizCoverImage" class="form-label">Quiz cover image</label>
                        <input type="file" class="form-control @error('cover_image') is-invalid @enderror" 
                            id="quizCoverImage" name="cover_image" 
                            value="{{$quiz->cover_image}}">

                        @error('title')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="row mt-3 justify-content-between">
                        <div class="col">
                            <p class="h3 mb-3">Questions</p>
                        </div>
                        <div class="col text-end">
                            <a href="/quizzes/{{$quiz->slug}}/questions/create"
                                class="btn btn-success" 
                                id="addQuestionLink">Add Question</a>
                        </div>
                    </div>
                    <table class="table table-striped table-hover table-responsive align-middle">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Question title</th>
                                <th class="text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($questions as $question)
                            <tr>
                                <td>{{$question->question_number}}</td>
                                <td>{{$question->title}}</td>
                                <td class="text-center">
                                    <a href="/quizzes/{{$quiz->slug}}/questions/{{$question->question_number}}/edit" class="btn btn-success">Edit</a>
                                    <a href="/quizzes/{{$quiz->slug}}/questions/{{$question->question_number}}/delete" class="btn btn-danger">Delete</a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    
                    <div class="row justify-content-between">
                        <div class="col">
                            <button class="btn btn-primary">Update</button>
                        </div>
                        <div class="col text-end">
                            <a href="/quizzes/manage" class="btn btn-secondary">Return to Quizzes</a>
                        </div>
                    </div>
                </form>
            </x-card>
        </div>
    </div>
@endsection
