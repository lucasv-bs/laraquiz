@props(['quiz'])

<x-card>
    <div class="mb-3">
        <a href="/quizzes/{{$quiz->slug}}" class="d-block">
            <img 
                src="{{
                    $quiz->cover_image 
                    ? Storage::url($quiz->cover_image)
                    : Storage::url('quizzes/cover-images/no-image.jpg')
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