@extends('Layouts.AdministrativeLayout')
@section('admin_css')
    <style>
    </style>
@endsection
@section('admin_js')
    <script>
        setTimeout(function () {
            window.location.href= 'http://127.0.0.1:8000/update_settings'; // the redirect goes here

        },120000);
    </script>
@endsection
@section('title') Update Admin Settings @endsection
@section('body')
    <div class="content-wrapper" id="job_book_content">
        <div class="container-home">
            <div class="container">
                <div class="row">
                    <div class="col-md-6">
                        <div class="section-header text-center">
                            <h3 class="title" id="header"><b>Update User Details</b></h3>
                        </div>
                        @if(session()->has('update_user'))
                            <div class="alert alert-success">
                                {{ session()->get('update_user') }}
                            </div>
                        @endif
                        @if(count($errors)>0)
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach($errors->all() as $errorlogin)
                                        <li>{{$errorlogin}}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        @foreach($userData as $row)
                            <form action="/EditAdminUsername" method="post">
                                {{ csrf_field() }}

                                <div class="form-group row">
                                    <label for="address" class="col-sm-3 col-form-label">Username</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="username" class="form-control" id="staticEmail" value="{{$row['username']}}">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-6">
                                        <button type="submit" class="btn btn-primary" name="RegWorker">Update</button>
                                    </div>
                                    <div class="col-sm-6">

                                    </div>
                                </div>
                            </form>
                        @endforeach
                    </div>
                    <div class="col-md-6">
                        <div class="section-header text-center">
                            <h3 class="title" id="header"><b>Update Username/Password</b></h3>
                            @if (session('error'))
                                <div class="alert alert-danger">
                                    {{ session('error') }}
                                </div>
                            @endif
                            @if (session('success'))
                                <div class="alert alert-success">
                                    {{ session('success') }}
                                </div>
                            @endif

                            <form class="form-horizontal" method="POST" action="/updateAdminpassword">
                                {{ csrf_field() }}

                                <div class="form-group{{ $errors->has('current-password') ? ' has-error' : '' }}">
                                    <label for="new-password" class="col-md-4 control-label">Current Password</label>

                                    <div class="col-md-6">
                                        <input id="current-password" type="password" class="form-control" name="current-password" placeholder="Current Password" required>

                                        @if ($errors->has('current-password'))
                                            <span class="help-block">
                                        <strong>{{ $errors->first('current-password') }}</strong>
                                    </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group{{ $errors->has('new-password') ? ' has-error' : '' }}">
                                    <label for="new-password" class="col-md-4 control-label">New Password</label>

                                    <div class="col-md-6">
                                        <input id="new-password" type="password" class="form-control" name="new-password" placeholder="New password" required>

                                        @if ($errors->has('new-password'))
                                            <span class="help-block">
                                        <strong>{{ $errors->first('new-password') }}</strong>
                                    </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="new-password-confirm" class="col-md-4 control-label">Confirm New Password</label>

                                    <div class="col-md-6">
                                        <input id="new-password-confirm" type="password" class="form-control" name="new-password_confirmation" placeholder="New password" required>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-md-6 col-md-offset-4">
                                        <button type="submit" class="btn btn-primary">
                                            Change Password
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
