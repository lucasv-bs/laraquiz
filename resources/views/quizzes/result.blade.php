@extends('layouts.app')

@section('content')
<div class="container px-4">
    <div class="row gx-5 gy-4">
        <x-card class="text-center">
            <h2>You finished the Quiz! Here is your result.</h2>
            <div>
                <p class="fs-4">{{$result}}</p>
            </div>
            <div>
                <img 
                    src="{{$quiz->cover_image
                        ? asset('storage/quizzes/' . $quiz->cover_image)
                        : asset('storage/quizzes/cover-images/no-image.png')
                    }}" 
                    alt="Quiz cover image">
            </div>
            <p class="fs-4">Would you like take another Quiz? <a href="/quizzes">Click here</a></p>
        </x-card>
    </div>
</div>
@endsection