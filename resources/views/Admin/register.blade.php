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
                    <form action="/signup" method="post">
                        <div class="modal-body" >
                            {{ csrf_field() }}
                            <div class="form-group row">
                                <label for="username" class="col-sm-3 col-form-label">Name</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="name" id="reserve_inputs" placeholder="Your name" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="username" class="col-sm-3 col-form-label">NIC</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="nic" id="reserve_inputs" placeholder="NIC" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="username" class="col-sm-3 col-form-label">Email</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="email" id="reserve_inputs" placeholder="Email" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="username" class="col-sm-3 col-form-label">Mobile Number</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="mobile_number" id="reserve_inputs" placeholder="Mobile Number" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="username" class="col-sm-3 col-form-label">Threewheel Number</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="tw_number" id="reserve_inputs" placeholder="Threewheel Number" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="username" class="col-sm-3 col-form-label">Threewheel Chasie Number</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="tw_ch_number" id="reserve_inputs" placeholder="Threewheel Number" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="username" class="col-sm-3 col-form-label">Threewheel Engine Number</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="tw_eng_number" id="reserve_inputs" placeholder="Threewheel Number" required>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="username" class="col-sm-3 col-form-label">Threewheel Type</label>
                                <div class="col-sm-9">
                                    <select class="form-control" name="tw_type">
                                        <option value="2_stork">2-Stork</option>
                                        <option value="4_stork">4-Stork</option>
                                    </select>
                                </div>
                            </div>
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

                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary" name="RegWorker">Register</button>
                            <button type="reset" class="btn btn-success">Clear</button>
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

