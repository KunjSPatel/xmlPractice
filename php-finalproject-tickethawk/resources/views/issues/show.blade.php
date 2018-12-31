@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Ticket #{{ $ticket->id }} - {{ $ticket->status }}</div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table">
                            <tbody>
                                <tr>
                                    <td>Ticket ID:</td>
                                    <td>{{ $ticket->id }}</td>
                                </tr>
                                <tr>
                                    <td>Submitted By:</td>
                                    <td>{{ $ticket->user['email'] }}</td>
                                </tr>
                                <tr>
                                    <td>Description:</td>
                                    <td>{{ $ticket->description }}</td>
                                </tr>
                                <tr>
                                    <td>Issue Categories:</td>
                                    <td><?php echo implode(", ", array_column($ticket->issues->toArray(), "name")); ?></td>
                                </tr>
                                <tr>
                                    <td>Urgency:</td>
                                    <td>{{ $ticket->urgency }}</td>
                                </tr>
                                <tr>
                                    <td>Submitted On:</td>
                                    <td>{{ $ticket->created_at }}</td>
                                </tr>
                                <tr>
                                    <td>Last Update:</td>
                                    <td>{{ $ticket->updated_at }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="text-right">
                        <form action="{{ url('/tickets/edit/' . $ticket->id) }}">
                            <button type="submit" class="btn btn-primary pull-right" @if($ticket->status == 'Closed') disabled @endif>Edit Ticket</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div><br>
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Comments</div>

                <div class="card-body">

                    @foreach($ticket->comments->sortBy('created_at') as $comment)
                        <p>{{ $comment->comment }}</p>
                        <small>- {{ $comment->author->email }}, {{ $comment->author->roles->first()->display_name }},
                            <cite title="Source Title">{{ $comment->created_at }}</cite>
                        </small><hr>
                    @endforeach

                    <form>
                        <div class="form-group">
                            <label for="comment">Post a Comment:</label>
                            <textarea class="form-control" id="comment" name="comment" rows="3"></textarea>
                        </div>
                        <div class="text-right">
                            <button type="submit" class="btn btn-primary pull-right" @if($ticket->status == 'Closed') disabled @endif>Submit Comment</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
