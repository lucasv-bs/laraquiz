@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center mt-5">
            <x-card class="col-md-12">
                <form method="POST" action="/quizzes/{{ $quiz->slug }}/play/{{ $question->question_number }}"
                    enctype="application/x-www-form-urlencoded"
                    class="needs-validation">
                    @csrf

                    <div class="px-3">
                        <h3 class="mb-3">{{ $question->title }}</h3>
                        @foreach ($answers as $key => $answer)
                            <div class="form-check">
                                <input type="radio" 
                                    class="form-check-input @error('answer_number') is-invalid @enderror" 
                                    name="answer_number" id="answer_{{ $answer->answer_number }}" 
                                    value="{{ $answer->answer_number }}">
                                <label for="answer_{{ $answer->answer_number }}"
                                    class="form-check-label">{{ $answer->answer_text }}</label>
                                @error('answer_number')
                                    @if ($lastAnswersKey == $key)
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @endif
                                @enderror
                            </div>
                        @endforeach
                        <button type="submit" class="btn btn-primary mt-3">Send</button>
                    </div>
                </form>
            </x-card>
        </div>
    </div>
@endsection
