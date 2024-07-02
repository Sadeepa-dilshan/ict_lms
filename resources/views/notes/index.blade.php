<!-- resources/views/notes/index.blade.php -->

@extends('layouts.app')

@section('content')
<div class="container">
    @foreach ($courses as $course)
        <div class="row">
            <div class="col-md-12">
                <h3>{{ $course->name }}</h3>
                @if ($course->notes->isEmpty())
                    <p>No notes available for this course.</p>
                @else
                    <div class="row">
                        @foreach ($course->notes as $note)
                            <div class="col-md-4 mb-4">
                                <div class="card">
                                    @if ($note->image_path)
                                        <img src="{{ asset('storage/' . $note->image_path) }}" class="card-img-top" alt="{{ $note->title }}">
                                    @endif
                                    <div class="card-body">
                                        <h5 class="card-title">{{ $note->title }}</h5>
                                        <p class="card-text">{{ Str::limit($note->content, 100) }}</p>
                                        <a href="{{ route('notes.show', $note) }}" class="btn btn-primary">View</a>
                                        @if ($note->pdf_path)
                                            <a href="{{ asset('storage/' . $note->pdf_path) }}" class="btn btn-secondary" target="_blank" download>Download PDF</a>
                                        @endif
                                        @if(auth()->check() && auth()->user()->role === 'admin')
                                            <form action="{{ route('notes.destroy', $note) }}" method="POST" class="d-inline-block">
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
        <a href="{{ route('notes.create') }}" class="btn btn-primary mb-3">Create Note</a>
    @endif
</div>
@endsection
