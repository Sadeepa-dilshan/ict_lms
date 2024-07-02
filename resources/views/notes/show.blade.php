<!-- resources/views/notes/show.blade.php -->

@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ $note->title }}</div>

                <div class="card-body">
                    <p>{{ $note->content }}</p>
                    @if($note->pdf_path)
                        <a href="{{ asset('storage/' . $note->pdf_path) }}" class="btn btn-primary" download>Download PDF</a>
                    @endif
                    <a href="{{ route('notes.index') }}" class="btn btn-secondary">Back</a>
                    @if(auth()->user()->is_admin)
                        <form action="{{ route('notes.destroy', $note->id) }}" method="POST" class="d-inline-block" onsubmit="return confirm('Are you sure you want to delete this note?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
