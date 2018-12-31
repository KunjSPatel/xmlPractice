@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
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
                <div class="card-header">Tickets</div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">ID #</th>
                                    <th scope="col">Submitted By</th>
                                    <th scope="col">Description</th>
                                    <th scope="col">Categories</th>
                                    <th scope="col">Urgency</th>
                                    <th scope="col">Submitted</th>
                                    <th scope="col">Updated</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($tickets as $ticket)
                                    <tr @if($ticket->status != "Open") style="background:#d3d3d3;" @endif>
                                        <th scope="row"><a href="{{ url('/tickets/' . $ticket->id) }}">{{ sprintf('%04d', $ticket->id) }}</a></th>
                                        <td>{{ $ticket->user['email'] }}</td>
                                        <td>{{ $ticket->description }}</td>
                                        <td><?php echo implode(", ", array_column($ticket->issues->toArray(), "name")); ?></td>

                                        @if($ticket->urgency == "High" && $ticket->status == "Open")
                                            <td class="text-danger">{{ $ticket->urgency }}</td>
                                        @elseif($ticket->urgency == "Medium" && $ticket->status == "Open")
                                            <td style="color: orange;">{{ $ticket->urgency }}</td>
                                        @elseif($ticket->urgency == "Low" && $ticket->status == "Open")
                                            <td style="color: #CCCC00;">{{ $ticket->urgency }}</td>
                                        @else
                                            <td>{{ $ticket->urgency }}</td>
                                        @endif

                                        <td>{{ $ticket->created_at->toDateString() }}</td>
                                        <td>{{ $ticket->updated_at->toDateString() }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {!! $tickets->render() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
