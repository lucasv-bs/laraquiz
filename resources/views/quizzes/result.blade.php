@extends('layouts.app')

@section('content')
<div class="container px-4">
    <div class="row gx-5 gy-4">
        <x-card class="col text-center">
            <h2>You finished the Quiz! Here is your result.</h2>
            <div class="row">
                <p class="fs-4">{{$result}}</p>
            </div>
            <div class="row">
                <img 
                    src="{{$quiz->cover_image
                        ? Storage::url($quiz->cover_image)
                        : Storage::url('quizzes/cover-images/no-image.jpg')
                    }}" 
                    class="img-fluid rounded"
                    alt="Quiz cover image">
            </div>
            <p class="fs-4 mt-3">Would you like take another Quiz? <a href="/quizzes">Click here</a></p>
        </x-card>
    </div>
</div>
@endsection