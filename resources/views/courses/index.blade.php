<!-- resources/views/courses/index.blade.php -->

@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        @if (auth()->check() && auth()->user()->role === 'admin')
            <a href="{{ route('courses.create') }}" class="btn btn-primary mb-3">Create Course</a>
        @endif
        @foreach ($courses as $course)
            <div class="col-md-4 mb-4">
                <div class="card">
                    @if($course->image_path)
                        <img src="{{ asset('storage/' . $course->image_path) }}" class="card-img-top" alt="{{ $course->name }}">
                    @else
                        <img src="{{ asset('storage/default.jpeg') }}" class="card-img-top" alt="Default Course Image">
                    @endif
                    <div class="card-body">
                        <h5 class="card-title">{{ $course->name }}</h5>
                        <p class="card-text">{{ Str::limit($course->description, 100) }}</p>
                        <a href="{{ route('courses.show', $course) }}" class="btn btn-primary">View</a>
                        @if(auth()->check() && auth()->user()->role === 'admin')
                            <a href="{{ route('courses.edit', $course) }}" class="btn btn-secondary">Edit</a>
                            <form action="{{ route('courses.destroy', $course) }}" method="POST" class="d-inline-block">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form>
                        @endif
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection

@section('script')
<script>
    $(document).ready(function() {
        // Add any custom jQuery scripts if needed
    });
</script>
@endsection
