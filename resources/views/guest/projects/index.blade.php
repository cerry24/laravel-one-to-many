@extends('layouts.guest')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-9">
                @forelse ($projects as $project)
                <div class="card bg-dark text-white my-5">
                    <div class="card-body d-flex justify-content-between">
                        <h5 class="card-title">{{ $project->title }}</h5>
                        <a class="btn btn-success" href="{{ route('projects.show', $project->slug) }}">more detail</a>
                    </div>
                    <img src="{{ $project->thumbnail }}" class="card-img-bottom" alt="Project thumbnail">
                </div>
                @empty
                    <p>There are no projects to be shown</p>
                @endforelse
            </div>
        </div>
    </div>
@endsection

@section('footer-content')
    {{ $projects->links() }}
@endsection