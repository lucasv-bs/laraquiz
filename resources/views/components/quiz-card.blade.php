@props(['quiz'])

<x-card>
    <div class="mb-3">
        <a href="/quizzes/{{$quiz->slug}}" class="d-block">
            <img 
                src="{{
                    $quiz->cover_image 
                    ? asset('storage/cover-images' . $quiz->cover_image)
                    : asset('storage/quizzes/cover-images/no-image.png')
                }}" 
                class="img-fluid rounded"
                alt="Quiz cover image">
        </a>
    </div>
    <div>
        <h3>
            <a href="/quizzes/{{$quiz->slug}}" class="link-dark text-decoration-none">{{$quiz->title}}</a>
        </h3>
        <p>{{$quiz->description}}</p>
        <a href="/quizzes/{{$quiz->slug}}" class="btn btn-primary">View quiz</a>
    </div>
</x-card>