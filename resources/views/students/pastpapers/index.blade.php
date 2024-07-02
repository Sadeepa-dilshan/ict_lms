@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Past Papers') }}</div>

                <div class="card-body">
                    @foreach ($pastPapers as $pastPaper)
                        <div class="card mb-3">
                            <div class="card-body">
                                <h5 class="card-title">{{ $pastPaper->title }}</h5>
                                <a href="{{ route('past-papers.show', $pastPaper) }}" class="btn btn-primary">Download</a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
