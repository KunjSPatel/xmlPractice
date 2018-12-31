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
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            {!! $submissionChart->container() !!}
                        </div>
                        <div class="col-md-6">
                            {!! $userChart->container() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
{!! $submissionChart->script() !!}
{!! $userChart->script() !!}
@endsection
