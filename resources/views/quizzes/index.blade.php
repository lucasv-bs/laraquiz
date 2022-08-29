@extends('layouts.app')

@section('content')
    <div class="container px-4">
        <x-flash-message />
        
        <div class="row gx-5 gy-4">
            @foreach ($quizzes as $quiz)
            <div class="col-sm-12 col-md-6 col-xl-4">
                <x-quiz-card :quiz="$quiz" />
            </div>
            @endforeach
        </div>
    </div>
@endsection
