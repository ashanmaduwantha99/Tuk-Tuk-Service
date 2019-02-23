@extends('Layouts.AdministrativeLayout')
@section('admin_css')
    <style>
        #Header{
            color: black;
        }
        #att_sheet_tr{
            color: black;
            background-color: #2a88bd;
            border: 2px solid black;
        }
        #att_sheet_tr_1{
            color: black;
            border-color: #0d3625;
            border: 2px solid black;
        }
        #input_att_form{
            background-color: transparent;
            border-color: #0d3625;
            color: black;
        }
        #attbutton{
            width:auto;
            background-color:forestgreen;
        }
        #inputreg_details{
            background-color: transparent;
            color: midnightblue;
        }
        #workerSalary{
            background-color: white;
        }
        #calSalary{
            background-color: white;
        }
        #show_salary_tr{
            color: black;
            background-color: #3d6983;
            border: 2px solid black;
        }
        #show_salary_tr1{
            color: black;
            border: 2px solid black;
        }
        #salary_sheet_update{
            background-color: white;
        }
    </style>
@endsection
@section('admin_js')
    <script>
        setTimeout(function () {
            window.location.href= 'http://127.0.0.1:8000/workers_salary'; // the redirect goes here

        },120000);
    </script>
@endsection
@section('title') Employees' Salary Calculation @endsection

@section('body')
    <div class="content-wrapper" id="main_div">
        <div class="container-home" id="calSalary">
            <div class="container">
                <div class="row">
                    <div class="col-md-6">
                        <div class="section-header text-center">
                            <br>
                            <h3 class="title" id="Header"><b>Calculate Salary</b></h3>
                        </div>
                        @if(session()->has('message_calSalary'))
                            <div class="alert alert-success">
                                {{ session()->get('message_calSalary') }}
                            </div>
                        @endif
                        @if(session()->has('message_calSalary_dgr'))
                            <div class="alert alert-danger">
                                {{ session()->get('message_calSalary_dgr') }}
                            </div>
                        @endif
                        <form action="/calculateSalary" method="post" id="RegisterForm" name="myForm">
                            {{ csrf_field() }}
                            <div class="form-group row">
                                <label for="name" class="col-sm-3 col-form-label" id="label_reg">Start Date</label>
                                <div class="col-sm-9">
                                    <input type="date" class="form-control" id="input_att_form" name="start_date" placeholder=" End Date">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="username" class="col-sm-3 col-form-label" id="label_reg">End Date</label>
                                <div class="col-sm-9">
                                    <input type="date" class="form-control" id="input_att_form" name="end_date" placeholder=" End Date">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="email" class="col-sm-3 col-form-label" id="label_reg">Month</label>
                                <div class="col-sm-9">
                                    <input type="month" class="form-control" name="month" id="inputreg_details" placeholder="Month" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="mobile_number" class="col-sm-3 col-form-label" id="label_reg">Work Days</label>
                                <div class="col-sm-9">
                                    <input type="number" class="form-control" min="0" max="31" step="1" value="26" id="inputreg_details" name="work_days" placeholder="Days of Work" required>
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-sm-6">
                                    <button type="submit" class="btn btn-default" name="AttMarkBtn" id="attbutton">Calculate Salary</button>
                                </div>
                                <div class="col-sm-6">
                                    <button type="reset" class="btn btn-success">Clear</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!--
            <div class="container">
                <div class="row" id="calSalary_row1">
                    <div class="col-md-12">
                        <div class="section-header text-center">
                            <br>
                            <h3 class="title" id="Header"><b>Calculate Salary</b></h3>
                        </div>
                        <div id="table-wrapper" style="position: relative">
                            <div id="table-scroll" style="height: 400px;overflow: auto">
                                <table class="table table-bordered">
                                    <tr id="att_sheet_tr">
                                        <th>Name</th>
                                        <th>Username</th>
                                        <th>Start Date</th>
                                        <th>End Date</th>
                                        <th>Month/Year</th>
                                        <th>Working Days</th>
                                        <th>Calculate Salary</th>
                                    </tr>

                                    @foreach($detail as $row)
                                        <tr id="att_sheet_tr_1">
                                            <td>{{$row['name']}}</td>
                                            <td>{{$row['username']}}</td>
                                            <form action="/calSalary" method="post">
                                                {{ csrf_field() }}
                                                <td>
                                                    <input type="text" class="hidden" id="input_att_form" name="name" value="{{$row['name']}}">
                                                    <input type="text" class="hidden" id="input_att_form" name="username" value="{{$row['username']}}">
                                                    <input type="text" class="hidden" id="input_att_form" name="role" value="{{$row['role']}}">
                                                    <input type="date" class="form-control" id="input_att_form" name="start_date" placeholder="Start Date">
                                                </td>
                                                <td>
                                                    <input type="date" class="form-control" id="input_att_form" name="end_date" placeholder=" End Date">
                                                </td>
                                                <td>
                                                    <input type="month" class="form-control" name="month" id="inputreg_details" placeholder="Month" required>
                                                </td>
                                                <td>
                                                    <input type="number" class="form-control" min="0" max="31" step="1" value="26" id="inputreg_details" name="work_days" placeholder="Days of Work" required>
                                                </td>
                                                <td>
                                                    <button type="submit" class="btn btn-default" name="AttMarkBtn" id="attbutton">Calculate Salary</button>
                                                </td>
                                            </form>
                                        </tr>
                                    @endforeach
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            -->
        </div>
        <div class="container-home" id="salary_sheet_update">
            <div class="container-fluid">
                <div class="row" id="calSalary_row2">
                    <div class="col-md-12" id="show_salary_sheet">
                        <div class="section-header text-center">
                            <br>
                            <h3 class="title" id="Header"><b>Employees' Salary Payments</b></h3>
                        </div>
                        <div id="table-wrapper" style="position: relative">
                            <div id="table-scroll" style="height: 400px;overflow: auto">
                                <table class="table table-bordered">
                                    <tr id="show_salary_tr">
                                        <th>Name</th>
                                        <th>Username</th>
                                        <th>Role</th>
                                        <th>Start Date</th>
                                        <th>End Date</th>
                                        <th>Month</th>
                                        <th>Working Percentage</th>
                                        <th>Basic Payment</th>
                                        <th>EPF</th>
                                        <th>ETF</th>
                                        <th>Bonus</th>
                                        <th>Full Payments</th>
                                        <th>Pay</th>
                                    </tr>
                                    @foreach($salary_data as $row)
                                        <tr id="show_salary_tr1">
                                            <td>{{$row['name']}}</td>
                                            <td>{{$row['username']}}</td>
                                            <td>{{$row['role']}}</td>
                                            <td>{{$row['start_date']}}</td>
                                            <td>{{$row['end_date']}}</td>
                                            <td>{{$row['month']}}</td>
                                            <td>{{$row['percentage']}}</td>
                                            <td>{{$row['basic_payments']}}</td>
                                            <td>{{$row['epf']}}</td>
                                            <td>{{$row['etf']}}</td>
                                            <td>{{$row['bonus']}}</td>
                                            <td>{{$row['full_payment']}}</td>
                                            <td>
                                                <form action="PaySalary" method="post">
                                                    {{ csrf_field() }}
                                                    <input type="text" name="worker_name" value="{{$row['name']}}" class="hidden">
                                                    <input type="text" name="worker_username" value="{{$row['username']}}" class="hidden">
                                                    <input type="text" name="worker_month" value="{{$row['month']}}" class="hidden">
                                                    <input type="text" name="worker_percentage" value="{{$row['percentage']}}" class="hidden">
                                                    <input type="text" name="worker_bonus" value="{{$row['bonus']}}" class="hidden">
                                                    <input type="text" name="worker_etf" value="{{$row['etf']}}" class="hidden">
                                                    <input type="text" name="worker_epf" value="{{$row['epf']}}" class="hidden">
                                                    <input type="text" name="worker_basic_payment" value="{{$row['basic_payments']}}" class="hidden">
                                                    <input type="text" name="worker_fullpayment" value="{{$row['full_payment']}}" class="hidden">
                                                    <button type="submit" class="btn btn-default" name="AttMarkBtn" id="attbutton">Paid</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection
