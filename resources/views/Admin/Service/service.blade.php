@extends('Layouts.AdministrativeLayout')
@section('admin_css')
@endsection
@section('admin_js')
    <script>
        setTimeout(function () {
            window.location.href= 'http://127.0.0.1:8000/dashboard'; // the redirect goes here

        },120000);
    </script>
@endsection
@section('title') Services @endsection

@section('body')
    <div class="content-wrapper" id="main_div">
        <div class="container-home" id="service1">
            <div class="container">
                <div class="row">
                    <div class="col-md-8">
                        <div class="section-header text-center" id="WR">
                            <br>
                            <h3 class="title"><b>Service Detail</b></h3>
                            <hr>
                        </div>
                        @if(session()->has('message_service_detail'))
                            <div class="alert alert-success">
                                {{ session()->get('message_service_detail') }}
                            </div>
                        @endif
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <form action="/service_detail" method="post" id="RegisterForm">
                            {{ csrf_field() }}
                            <div class="form-group row">
                                <label for="role" class="col-sm-3 col-form-label" id="label_reg">Washing</label>
                                <div class="col-sm-9">
                                    <select id="inputreg_details" class="form-control" name="washing" required>
                                        <option selected id="option_reg">Select the washing type</option>
                                        <option value="not_free" id="option_reg">Not-Free</option>
                                        <option value="free" id="option_reg">Free</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="role" class="col-sm-3 col-form-label" id="label_reg">Repair</label>
                                <div class="col-sm-9">
                                    <select id="inputreg_details" class="form-control" name="repair" required>
                                        <option selected id="option_reg">Select the repair type</option>
                                        <option value="not_free" id="option_reg">Not-Free</option>
                                        <option value="free" id="option_reg">Free</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="address" class="col-sm-3 col-form-label" id="label_reg">Customer Name</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="inputreg_details" name="customer_name" placeholder="Customer Name" required>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="nic" class="col-sm-3 col-form-label" id="label_reg">Customer NIC</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="inputreg_details" name="customer_nic" placeholder="Customer NIC" required>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="twnumber" class="col-sm-3 col-form-label" id="label_reg">Three Wheel Number</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="inputreg_details" name="tw_number" placeholder="Three Wheel Number" required>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="tw_chasie_number" class="col-sm-3 col-form-label" id="label_reg">Three Wheel Chasie Number</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="inputreg_details" name="tw_chasie_number" placeholder="Three Wheel Chasie Number" required>
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-sm-6">
                                    <button type="submit" class="btn btn-primary" name="RegWorker">Register</button>
                                    <button type="reset" class="btn btn-success">Clear</button>
                                </div>
                                <div class="col-sm-6">
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection
