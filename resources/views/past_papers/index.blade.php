<!-- resources/views/past_papers/index.blade.php -->

@extends('layouts.app')

@section('content')
<div class="container">
    @foreach ($courses as $course)
        <div class="row">
            <div class="col-md-12">
                <h3>{{ $course->name }}</h3>
                @if ($course->pastPapers->isEmpty())
                    <p>No past papers available for this course.</p>
                @else
                    <div class="row">
                        @foreach ($course->pastPapers as $pastPaper)
                            <div class="col-md-4 mb-4">
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="card-title">{{ $pastPaper->title }}</h5>
                                        <a href="{{ asset('storage/' . $pastPaper->file_path) }}" class="btn btn-secondary" target="_blank" download>Download PDF</a>
                                        @if(auth()->check() && auth()->user()->role === 'admin')
                                            <a href="{{ route('admin.past-papers.edit', $pastPaper) }}" class="btn btn-primary">Edit</a>
                                            <form action="{{ route('past-papers.destroy', $pastPaper) }}" method="POST" class="d-inline-block">
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
                @endif
            </div>
        </div>
    @endforeach

    @if (auth()->check() && auth()->user()->role === 'admin')
        <a href="{{ route('past-papers.create') }}" class="btn btn-primary mb-3">Upload Past Paper</a>
    @endif
</div>
@endsection
