@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <x-card>
                <h1 class="mb-3">{{$quiz->title}}</h1>
                <div class="row">
                    <div class="col-md-6 col-sm-12 text-center">
                        <img 
                            src="{{$quiz->cover_image
                                ? asset('storage/' . $quiz->cover_image)
                                : asset('storage/quizzes/cover-images/no-image.png')
                            }}" 
                            class="img-fluid rounded"
                            alt="Quiz cover image">
                    </div>
                    <div class="col-md-6 col-sm-12">
                        <p>{{$quiz->description}}</p>
                        <p><span class="fw-semibold">Questions amount:</span> {{$questionsAmount}}</p>
                        <p><span class="fw-semibold">Average score:</span> {{$averageScore}}</p>
                    </div>
                </div>
                <div class="col-md-12 mt-3">
                    <a href="/quizzes/{{$quiz->slug}}/play" class="btn btn-primary">Let's go</a>
                </div>
            </x-card>
        </div>
    </div>
@endsection