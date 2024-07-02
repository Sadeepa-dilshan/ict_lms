<!-- resources/views/video_lessons/index.blade.php -->

@extends('layouts.app')

@section('content')
<div class="container">
    @foreach ($courses as $course)
        <div class="row">
            <div class="col-md-12">
                <h3>{{ $course->name }}</h3>
                @if ($course->videoLessons->isEmpty())
                    <p>No video lessons available for this course.</p>
                @else
                    <div class="row">
                        @foreach ($course->videoLessons as $videoLesson)
                            <div class="col-md-6 mb-4">
                                <div class="card">
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
    @endforeach

    @if (auth()->check() && auth()->user()->role === 'admin')
        <a href="{{ route('video-lessons.create') }}" class="btn btn-primary mb-3">Upload Video Lesson</a>
    @endif
</div>
@endsection
