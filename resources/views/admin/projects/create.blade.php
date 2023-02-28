@extends('layouts.admin')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-10">
            @include('admin.projects.partials.createEditForm', ['routeName' => 'admin.projects.store', 'method' => 'POST'])
        </div>
    </div>
</div>
@endsection