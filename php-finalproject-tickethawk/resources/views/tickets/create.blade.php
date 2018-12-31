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
                <div class="card-header">Submit a Ticket</div>

                <div class="card-body">
                    <form class="form" method="post" action="{{ url('tickets/store') }}">
                        <div class="form-group">
                            <label for="categories">Ticket Categories</label>
                            <select multiple class="form-control" id="categories" name="categories[]" aria-describedby="categoriesHelp">
                                @foreach($issues as $issue)
                                    <option value="{{ $issue->id }}">{{ $issue->name }}</option>
                                @endforeach
                            </select>
                            <small id="categoriesHelp" class="form-text text-muted">You may use CTRL + click to select multiple applicable ticket categories.</small>
                        </div>
                        <div class="form-group">
                            <label for="description">Issue/Problem</label>
                            <textarea class="form-control" id="description" name="description" rows="7" style="resize:none;" aria-describedby="descriptionHelp"></textarea>
                            <small id="descriptionHelp" class="form-text text-muted">Please enter a detailed description of the problem.</small>
                        </div>
                        <div class="form-group">
                            <label for="urgency">Urgency</label>
                            <select class="form-control" id="urgency" name="urgency" aria-describedby="urgencyHelp">
                                <option value="Low">Low</option>
                                <option value="Medium">Medium</option>
                                <option value="High">High</option>
                            </select>
                            <small id="urgencyHelp" class="form-text text-muted">Please enter an accurate urgency for your ticket.</small>
                        </div>
                        <div class="form-group">
                            <label for="department">Department/Location</label>
                            <input type="text" class="form-control" id="department" name="department" aria-describedby="departmentHelp">
                            <small id="departmentHelp" class="form-text text-muted">Please enter the department and location where the error is occuring.</small>
                        </div>
                        @csrf
                        <div class="text-right">
                            <button type="submit" class="btn btn-primary pull-right">Create Ticket</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
