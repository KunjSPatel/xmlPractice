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
                <div class="card-header">Users</div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">ID #</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Role</th>
                                    <th scope="col">Created</th>
                                    <th scope="col">Updated</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($users as $user)
                                    <tr>
                                        <th scope="row">
                                            @role('admin')
                                                <a href="{{ url('/users/edit/' . $user->id) }}">
                                            @endrole
                                            @role('manager')
                                                @if($user->hasRole('employee') || $user->hasRole('technician'))
                                                    <a href="{{ url('/users/edit/' . $user->id) }}">
                                                @endif
                                            @endrole
                                        {{ $user->id }}</a></th>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>{{ $user->roles->first()->display_name ?? 'Role not set' }}</td>
                                        <td>{{ $user->created_at->toDateString() }}</td>
                                        <td>{{ $user->updated_at->toDateString() }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {!!  $users->render() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
