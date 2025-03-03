<!-- resources/views/past_papers/edit.blade.php -->

@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Edit Past Paper') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('past-papers.update', $pastPaper) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="form-group">
                            <label for="title">{{ __('Title') }}</label>
                            <input id="title" type="text" class="form-control @error('title') is-invalid @enderror" name="title" value="{{ $pastPaper->title }}" required autofocus>

                            @error('title')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="course_id">{{ __('Course') }}</label>
                            <select id="course_id" class="form-control @error('course_id') is-invalid @enderror" name="course_id" required>
                                @foreach($courses as $course)
                                    <option value="{{ $course->id }}" {{ $pastPaper->course_id == $course->id ? 'selected' : '' }}>{{ $course->name }}</option>
                                @endforeach
                            </select>

                            @error('course_id')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="file">{{ __('PDF File') }}</label>
                            <input id="file" type="file" class="form-control @error('file') is-invalid @enderror" name="file">

                            @error('file')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group mb-0">
                            <button type="submit" class="btn btn-primary">
                                {{ __('Update') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
