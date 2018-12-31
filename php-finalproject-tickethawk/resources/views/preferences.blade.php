@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Preferences</div>

                <div class="card-body">   
                    <p class="lead">Export Data</p>
                    <div class="btn-group row" style="padding-bottom:10px;">
                        <div class="col-md-3">
                            <form method="post" action="{{ url('/export/tickets') }}">
                                @csrf
                                <div style="padding-right:10px;">
                                    <button type="submit" class="btn btn-sm btn-primary pull-right">Export Tickets</button>
                                </div>
                            </form><br>
                        </div>

                        <div class="col-md-3">
                            <form method="post" action="{{ url('/export/users') }}">
                                @csrf
                                <div style="padding-right:10px;">
                                    <button type="submit" class="btn btn-sm btn-primary pull-right">Export Users</button>
                                </div>
                            </form><br>
                        </div>

                        <div class="col-md-3">
                            <form method="post" action="{{ url('/export/categories') }}">
                                @csrf
                                <div style="padding-right:10px;">
                                    <button type="submit" class="btn btn-sm btn-primary pull-right">Export Issue Categories</button>
                                </div>
                            </form>
                        </div>
                    </div>

                    <p class="lead">Twilio API Details</p><hr>
                    <form>
                        <div class="form-group">
                            <label for="twilioSID">Account SID #</label>
                            <input type="text" class="form-control" id="twilioSID" name="twilioSID" value="xxxxxxxxxxxxxxxxxxxxxxxxxxxxx{{ substr(getenv('TWILIO_SID'), -4) }}" disabled>
                        </div>
                        <div class="form-group">
                            <label for="twilioToken">Token</label>
                            <input type="text" class="form-control" id="twilioToken" name="twilioToken" value="xxxxxxxxxxxxxxxxxxxxxxxxxxxxxx{{ substr(getenv('TWILIO_TOKEN'), -4) }}" disabled>
                        </div>
                        <div class="form-group">
                            <label for="twilioNumber">From Number</label>
                            <input type="text" class="form-control" id="twilioNumber" name="twilioNumber" value="{{ getenv('TWILIO_FROM') }}" disabled>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
