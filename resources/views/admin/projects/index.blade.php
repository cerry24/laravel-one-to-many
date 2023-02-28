@extends('layouts.admin')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th scope="col">id</th>
                            <th scope="col">title</th>
                            <th scope="col">creation date</th>
                            <th scope="col"><a class="btn btn-success" href="{{ route('admin.projects.create') }}">add new project</a></th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($projects as $project)
                        <tr>
                            <th scope="row">{{ $project->id }}</th>
                            <td>{{ $project->title }}</td>
                            <td>{{ $project->creation_date }}</td>
                            <td>
                                <a class="btn btn-primary" href="{{ route('admin.projects.show', $project->slug) }}">show</a>
                                <a class="btn btn-warning" href="{{ route('admin.projects.edit', $project->slug) }}">edit</a>
                                <form action="{{ route('admin.projects.destroy', $project->slug) }}" method="POST" class="d-inline-block element-deleter" data-element-name="{{ $project->title }}">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">delete</button>
                                </form>
                            </td>
                        </tr>
                        @empty
                            <p>There are no projects to be shown</p>
                        @endforelse
                    </tbody>
                </table>
                {{ $projects->links() }}
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    @vite('resources/js/deleteConfermation.js')
@endsection