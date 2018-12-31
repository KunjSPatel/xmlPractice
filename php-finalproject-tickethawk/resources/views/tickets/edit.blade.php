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
            <div class="card">
                <div class="card-header">Edit Ticket #{{ $ticket->id }}</div>

                <div class="card-body">
                    <form class="form" method="post" action="{{ url('tickets/update/' . $ticket->id) }}">
                        <div class="form-group">
                            <label for="categories">Ticket Categories</label>
                            <select multiple class="form-control" id="categories" name="categories[]" aria-describedby="categoriesHelp">
                                @foreach($issues as $issue)
                                    <option value="{{ $issue->id }}" <?php if(in_array($issue->id, array_column($ticket->issues->toArray(), 'id'))) { ?> selected <?php } ?>>
                                        {{ $issue->name }}
                                    </option>
                                @endforeach
                            </select>
                            <small id="categoriesHelp" class="form-text text-muted">You may use CTRL + click to select multiple applicable ticket categories.</small>
                        </div>
                        <div class="form-group">
                            <label for="description">Issue/Problem</label>
                            <textarea class="form-control" id="description" name="description" rows="3" aria-describedby="descriptionHelp">{{ $ticket->description }}</textarea>
                            <small id="descriptionHelp" class="form-text text-muted">Please enter a detailed description of the problem.</small>
                        </div>
                        <div class="form-group">
                            <label for="urgency">Urgency</label>
                            <select class="form-control" id="urgency" name="urgency" aria-describedby="urgencyHelp">
                                <option value="Low" @if($ticket->urgency == 'Low') selected @endif>Low</option>
                                <option value="Medium" @if($ticket->urgency == 'Medium') selected @endif>Medium</option>
                                <option value="High" @if($ticket->urgency == 'High') selected @endif>High</option>
                            </select>
                            <small id="urgencyHelp" class="form-text text-muted">Please enter an accurate urgency for your ticket.</small>
                        </div>
                        <div class="form-group">
                            <label for="department">Department/Location</label>
                            <input type="text" class="form-control" id="department" name="department" aria-describedby="departmentHelp" value="{{ $ticket->department }}">
                            <small id="departmentHelp" class="form-text text-muted">Please enter the department and location where the error is occuring.</small>
                        </div>
                        <div class="form-group">
                            <label for="status">Status</label>
                            <select class="form-control" id="status" name="status" aria-describedby="statusHelp">
                                <option value="Open" @if($ticket->status == 'Open') selected @endif>Open</option>
                                <option value="Closed" @if($ticket->status == 'Closed') selected @endif>Closed</option>
                            </select>
                            <small id="statusHelp" class="form-text text-muted">If the issue is resolved, please close the ticket.</small>
                        </div>
                        @csrf
                        <div class="text-right">
                            <button type="submit" class="btn btn-primary pull-right">Update Ticket</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
