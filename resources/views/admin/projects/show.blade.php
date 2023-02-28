@extends('layouts.admin')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-10">
                <div class="card mt-3">
                    @if ( $project->isThumbnailAUrl())
                        <img src="{{ $project->thumbnail }}" class="card-img-top" alt="Project thumbnail">
                    @else
                    <img src="{{ asset('storage/' . $project->thumbnail) }}" class="card-img-top" alt="Project thumbnail">
                    @endif

                    <div class="card-body">
                        <h5 class="card-title">{{ $project->title }}</h5>
                    <p class="card-text">{{ $project->description }}</p>
                    <p class="card-text"><small class="text-muted">{{ $project->creation_date }}</small></p>
                    </div>

                    <div class="card-footer d-flex justify-content-between">
                        @isset($prevProject)
                        <a class="btn btn-primary" href="{{ route('admin.projects.show', $prevProject->slug) }}">previous</a>
                        @endisset

                        <div class="btn-wrapper">
                            <a class="btn btn-warning me-4" href="{{ route('admin.projects.edit', $project->slug) }}">edit</a>
                            <form action="{{ route('admin.projects.destroy', $project->slug) }}" method="POST" class="d-inline-block element-deleter" data-element-name="{{ $project->title }}">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">delete</button>
                            </form>
                        </div>

                        @isset($nextProject)
                        <a class="btn btn-primary" href="{{ route('admin.projects.show', $nextProject->slug) }}">next</a>
                        @endisset
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection