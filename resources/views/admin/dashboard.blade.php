@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Admin Dashboard') }}</div>

                <div class="card-body">
                    <a href="{{ route('notes.create') }}" class="btn btn-primary">Upload Notes</a>
                    <a href="{{ route('past-papers.create') }}" class="btn btn-primary">Upload Past Papers</a>
                    <a href="{{ route('students.index') }}" class="btn btn-primary">Manage Students</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
