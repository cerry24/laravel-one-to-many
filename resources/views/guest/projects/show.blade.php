@extends('layouts.guest')

@section('content')
    <div class="container py-5">
        <div class="row">
            <div class="col-12">
                <div class="card mb-3">
                    <div class="row g-0">
                        <div class="col-md-4">
                            <img src="{{ $project->thumbnail }}" class="img-fluid rounded-start" alt="Project thumbnail">
                        </div>
                        <div class="col-md-8">
                            <div class="card-body">
                                <h5 class="card-title">{{ $project->title }}</h5>
                                <p class="card-text">{{ $project->description }}</p>
                                <p class="card-text"><small class="text-muted">{{ $project->creation_date }}</small></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection