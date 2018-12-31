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
                <div class="card-header">Issue Categories</div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Created</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($issues as $issue)
                                    <tr>
                                        <td scope="row"><a href="{{ url('/categories/edit/' . $issue->id) }}">{{ sprintf('%04d', $issue->id) }}</a></td>
                                        <td>{{ $issue->name }}</td>
                                        <td>{{ $issue->created_at }}</td>
                                        <td>
                                            <form method="post" action="{{ url('/categories/destroy/' . $issue->id) }}">
                                                @csrf
                                                <button type="submit" class="btn btn-outline-danger btn-sm">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {!!  $issues->render() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
