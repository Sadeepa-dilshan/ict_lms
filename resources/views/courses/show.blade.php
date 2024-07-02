<!-- resources/views/courses/show.blade.php -->

@extends('layouts.app')

@section('styles')
    <style>
        /* public/css/custom.css */
.card-header {
    background-color: #073b79;
    color: white;
}

.card {
    margin-bottom: 1.5rem;
    border: none;
    border-radius: 0.5rem;
}

.list-group-item {
    border: none;
    padding: 0.75rem 1.25rem;
}

.list-group-item a {
    color: #898f96;
    text-decoration: none;
}

.list-group-item a:hover {
    text-decoration: underline;
}

.card-body h5 {
    margin-bottom: 1rem;
}

.card-body iframe {
    border-radius: 0.5rem;
}

.embed-responsive {
    margin-bottom: 1rem;
}

    </style>
@endsection

@section('content')
<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">
                    <h2 class="mb-0">{{ $course->name }}</h2>
                </div>
                <div class="card-body">
                    <p class="text-muted">{{ $course->description }}</p>
                    <p><strong>Teacher:</strong> {{ $course->teacher->name }}</p>

                    <hr>

                    <h5 class="mt-4">Notes</h5>
                    @if($notes->isEmpty())
                        <p class="text-muted">No notes available for this course.</p>
                    @else
                        <ul class="list-group list-group-flush">
                            @foreach($notes as $note)
                                <li class="list-group-item">
                                    <a href="{{ route('notes.show', $note->id) }}" class="text-decoration-none">{{ $note->title }}</a>
                                </li>
                            @endforeach
                        </ul>
                    @endif

                    <hr>

                    <h5 class="mt-4">Past Papers</h5>
                    @if($pastPapers->isEmpty())
                        <p class="text-muted">No past papers available for this course.</p>
                    @else
                        <ul class="list-group list-group-flush">
                            @foreach($pastPapers as $pastPaper)
                                <li class="list-group-item">
                                    <a href="{{ asset('storage/' . $pastPaper->file_path) }}" download class="text-decoration-none">{{ $pastPaper->title }}</a>
                                </li>
                            @endforeach
                        </ul>
                    @endif

                    <hr>

                    <h5 class="mt-4">Video Lessons</h5>
                    @if($videoLessons->isEmpty())
                        <p class="text-muted">No video lessons available for this course.</p>
                    @else
                        <div class="row">
                            @foreach($videoLessons as $videoLesson)
                                <div class="col-md-6 mb-4">
                                    <div class="card shadow-sm">
                                        <div class="card-body">
                                            <h5 class="card-title">{{ $videoLesson->title }}</h5>
                                            <div class="embed-responsive embed-responsive-16by9">
                                                <iframe class="embed-responsive-item" src="https://www.youtube.com/embed/{{ \Illuminate\Support\Str::afterLast($videoLesson->youtube_link, '/') }}" allowfullscreen></iframe>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
