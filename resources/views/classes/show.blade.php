<!-- resources/views/classes/show.blade.php -->

@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ $class->name }}</div>

                <div class="card-body">
                    <p>{{ $class->description }}</p>
                    <p>Teacher: {{ $class->teacher->name }}</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
