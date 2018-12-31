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
                <div class="card-header">Create a User</div>

                <div class="card-body">
                    <form class="form" method="post" action="{{ url('/users/store') }}">
                        <div class="form-group">
                            <label for="name">Full Name</label>
                            <input type="text" class="form-control" id="name" name="name" aria-describedby="nameHelp">
                            <small id="nameHelp" class="form-text text-muted">Please enter the user's full name.</small>
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" id="email" name="email" aria-describedby="emailHelp">
                            <small id="emailHelp" class="form-text text-muted">Please enter the user's current email.</small>
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" class="form-control" id="password" name="password" aria-describedby="passwordHelp">
                            <small id="passwordHelp" class="form-text text-muted">Please enter the new user's password.</small>
                        </div>
                        <div class="form-group">
                            <label for="confirmPassword">Confirm Password</label>
                            <input type="password" class="form-control" id="confirmPassword" name="confirmPassword" aria-describedby="confirmPasswordHelp">
                            <small id="confirmPasswordHelp" class="form-text text-muted">Please confirm the password.</small>
                        </div>
                        <div class="form-group">
                            <label for="role">Account Role</label>
                            <select class="form-control" id="role" name="role" aria-describedby="roleHelp" @if(!Auth::user()->hasRole('admin')) disabled @endif>
                                <option value="1" selected>Employee</option>
                                <option value="2">Technician</option>
                                <option value="3">Manager</option>
                                <option value="4">Administrator</option>
                            </select>
                            <small id="roleHelp" class="form-text text-muted">Please set an account role for the new user.</small>
                        </div>
                        @csrf
                        <div class="text-right">
                            <button type="submit" class="btn btn-primary pull-right">Create User</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
