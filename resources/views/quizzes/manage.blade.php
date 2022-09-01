@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <x-flash-message />
        
        <x-card>
            <h1 class="mb-3">Manage Quizzes</h1>
            
            <div class="row mt-3">
                <table class="table table-striped table-hover table-responsive align-middle">
                    <thead>
                        <tr>
                            <th>Quiz title</th>
                            <th>Questions Amount</th>
                            <th class="text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($quizzes as $quiz)
                        <tr>
                            <td>{{$quiz->title}}</td>
                            <td>{{$quiz->questions()->count()}}</td>
                            <td class="text-center">
                                <a href="/quizzes/{{$quiz->slug}}/edit" class="btn btn-success">Edit</a>
                                <form method="POST" action="/quizzes/{{$quiz->slug}}/delete"
                                    class="d-inline-block">
                                    @csrf
                                    @method('DELETE')

                                    <button class="btn btn-danger">Delete</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </x-card>
    </div>
</div>
@endsection