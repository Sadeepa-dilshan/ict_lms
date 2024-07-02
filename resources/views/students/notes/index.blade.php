@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Notes') }}</div>

                <div class="card-body">
                    @foreach ($notes as $note)
                        <div class="card mb-3">
                            <div class="card-body">
                                <h5 class="card-title">{{ $note->title }}</h5>
                                <p class="card-text">{{ $note->content }}</p>
                                <a href="{{ route('notes.show', $note) }}" class="btn btn-primary">View</a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
