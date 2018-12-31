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
                <div class="card-header">Edit User Account</div>

                <div class="card-body">
                    <form class="form" method="post" action="{{ url('/updatemyaccount') }}">
                        <input type="hidden" name="userId" value="{{ $user->id }}">
                        <div class="form-group">
                            <label for="name">Full Name</label>
                            <input type="text" class="form-control" id="name" name="name" aria-describedby="nameHelp" value="{{ $user->name }}">
                            <small id="nameHelp" class="form-text text-muted">Please enter the user's full name.</small>
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" id="email" name="email" aria-describedby="emailHelp" value="{{ $user->email }}">
                            <small id="emailHelp" class="form-text text-muted">Please enter the user's current email.</small>
                        </div>
                        <div class="form-group">
                            <label for="phone">Phone Number</label>
                            <input type="text" class="form-control" id="phone" name="phone" aria-describedby="phoneHelp" value="{{ $user->phone }}">
                            <small id="phoneHelp" class="form-text text-muted">Please enter your cellphone number.</small>
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" class="form-control" id="password" name="password" aria-describedby="passwordHelp">
                            <small id="passwordHelp" class="form-text text-muted">Please enter the new user's password. Leave blank to leave current password.</small>
                        </div>
                        <div class="form-group">
                            <label for="confirmPassword">Confirm Password</label>
                            <input type="password" class="form-control" id="confirmPassword" name="confirmPassword" aria-describedby="confirmPasswordHelp">
                            <small id="confirmPasswordHelp" class="form-text text-muted">Please confirm the password. Leave blank to leave current password.</small>
                        </div>
                        <div class="form-group">
                            <label for="role">Account Role</label>
                            <select class="form-control" id="role" name="role" aria-describedby="roleHelp" @if(!Auth::user()->hasRole('admin')) disabled @endif>
                                <option value="1" @if($user->hasRole("employee")) selected @endif>Employee</option>
                                <option value="2" @if($user->hasRole("technician")) selected @endif>Technician</option>
                                <option value="3" @if($user->hasRole("manager")) selected @endif>Manager</option>
                                <option value="4" @if($user->hasRole("admin")) selected @endif>Administrator</option>
                            </select>
                            <small id="roleHelp" class="form-text text-muted">This can only be edited by an administrator.</small>
                        </div>
                        @csrf
                        <div class="text-right">
                            <button type="submit" class="btn btn-primary pull-right">Update User</button>
                        </div>
                    </form>

                    <p class="lead">Notification Settings</p><hr>
                    <form method="post" action="{{ url('/preferences') }}">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="emailNotifications" name="emailNotifications[]"
                                @if($user->email_notifications == 1) checked @endif>
                            <label class="form-check-label" for="emailNotifications">
                                Yes, I want to recieve email notifications of new tickets.
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="smsNotifications" name="smsNotifications[]"
                                @if($user->text_notifications == 1) checked @endif>
                            <label class="form-check-label" for="smsNotifications">
                                Yes, I want to recieve text message notifications of new tickets.
                            </label>
                        </div>
                        @csrf
                        <div class="text-right">
                            <button type="submit" class="btn btn-primary pull-right">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
