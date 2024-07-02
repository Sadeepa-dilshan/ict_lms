<!-- resources/views/classes/index.blade.php -->

@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        @if (auth()->check() && auth()->user()->role === 'admin')
            <a href="{{ route('classes.create') }}" class="btn btn-primary mb-3">Create Class</a>
        @endif
        @foreach ($classes as $class)
            <div class="col-md-4 mb-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">{{ $class->name }}</h5>
                        <p class="card-text">{{ Str::limit($class->description, 100) }}</p>
                        <a href="{{ route('classes.show', $class) }}" class="btn btn-primary">View</a>
                        @if(auth()->check() && auth()->user()->role === 'admin')
                            <a href="{{ route('classes.edit', $class) }}" class="btn btn-secondary">Edit</a>
                            <form action="{{ route('classes.destroy', $class) }}" method="POST" class="d-inline-block">
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
