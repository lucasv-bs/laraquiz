@extends('layouts.app')

@section('content')
    <div class="container">
        <x-card class="justify-content-center">
            <div class="row">
                <div class="col-md-6 col-sm-12 align-self-center">
                    <p class="fs-1 fw-bold text-center text-uppercase">
                        <a href="/quizzes" class="text-body">Take a Quiz</a>
                    </p>
                    <p class="fs-1 fw-bold text-center text-uppercase">
                        And see how you do
                    </p>
                </div>
                <div class="col-md-6 col-sm-12">
                    <img src="{{Storage::url('quizzes/home-take-quiz.jpg')}}" 
                        class="img-fluid"
                        alt="Take a Quiz">
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 col-sm-12">
                    <img src="{{Storage::url('quizzes/home-create-quiz.jpg')}}" 
                        class="img-fluid"
                        alt="Take a Quiz">
                </div>
                <div class="col-md-6 col-sm-12 align-self-center">
                    <p class="fs-1 fw-bold text-center text-uppercase">
                        <a href="/quizzes/create" class="text-body">Create a Quiz</a>
                    </p>
                    <p class="fs-1 fw-bold text-center text-uppercase">
                        And share with your friends
                    </p>
                </div>
            </div>
        </x-card>
    </div>
@endsection
