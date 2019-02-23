@extends('Layouts.loginLayout')
@section('homecss')
<style>
    #LoginForm{
        width: 350px;
    }
</style>
@endsection
@section('title') Login @endsection

@section('body')
<div class="container-home">
    <br><br><br><br>
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <h3><b>Tuk-Tuk Service Login Page</b></h3>
                <hr>
                <form action="/signin" method="post" id="LoginForm">
                    {{ csrf_field() }}
                    <div class="form-group row">
                        <label for="username" class="col-sm-3 col-form-label">Username</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="username" id="reserve_inputs" placeholder="Username" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="password" class="col-sm-3 col-form-label">Password</label>
                        <div class="col-sm-9">
                            <input type="password" class="form-control" id="reserve_inputs" name="password" placeholder="Password" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-6">
                            <button type="submit" class="btn btn-primary" name="RegWorker">Login</button>
                            <button type="reset" class="btn btn-success">Clear</button>
                        </div>
                        <div class="col-sm-6">
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-md-6">
                <img src="{{URL::asset('/Media/Images/logot.png')}}" class="img-responsive" id="logo">
                <br>
                <img src="{{URL::asset('/Media/Images/quote.png')}}" class="img-responsive" id="sp1">
            </div>
        </div>
    </div>
</div>
@endsection

