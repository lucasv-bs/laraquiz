@extends('layouts.app')

@section('content')
    <div class="container px-4">
        <div class="row">
            <x-card class="col">
                <form method="POST" action="/quizzes/store" enctype="application/x-www-form-urlencoded"
                    class="needs-validation">
                    @csrf

                    <div class="mb-3 row">
                        <label for="quizTitle" class="form-label">Quiz title</label>
                        <input type="text" class="form-control @error('title') is-invalid @enderror" 
                            id="quizTitle" name="title" 
                            value="{{old('title')}}"
                            placeholder="Enter the Quiz title">

                        @error('title')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3 row">
                        <label for="quizDescription" class="form-label">Quiz description</label>
                        <textarea class="form-control @error('description') is-invalid @enderror" 
                            id="quizDescription" name="description">{{old('description')}}</textarea>

                        @error('description')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3 row">
                        <label for="quizCoverImage" class="form-label">Quiz cover image</label>
                        <input type="file" class="form-control @error('cover_image') is-invalid @enderror" 
                            id="quizCoverImage" name="cover_image" 
                            value="{{old('cover_image')}}">

                        @error('title')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3 row gx-1">
                        <div class="col bg-light">
                            <button class="btn btn-primary">Save</button>
                        </div>
                        <div class="col">
                            <button class="btn btn-success" formaction="/quizzes/store-and-add">Save and add questions</button>
                        </div>
                    </div>

                </form>
            </x-card>
        </div>
    </div>
@endsection
