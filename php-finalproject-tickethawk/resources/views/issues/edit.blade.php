@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            @if($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            @if(session()->has('message'))
                <div class="alert alert-success">{{ session()->get('message') }}</div>
            @endif
            <div class="card">
                <div class="card-header">Edit Issue Category: {{ $issue->name }}</div>

                <div class="card-body">
                    <form class="form" method="post" action="{{ url('/categories/update/' . $issue->id) }}">
                        <div class="form-group">
                            <label for="name">Category Name</label>
                            <input type="text" class="form-control" id="name" name="name" aria-describedby="nameHelp" value="{{ $issue->name }}">
                            <small id="nameHelp" class="form-text text-muted">Please enter the category's name.</small>
                        </div>
                        @csrf
                        <div class="text-right">
                            <button type="submit" class="btn btn-primary pull-right">Update Category</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
