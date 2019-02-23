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
            window.location.href= 'http://127.0.0.1:8000/workers_payement_history'; // the redirect goes here

        },120000);
    </script>

    <script type="text/javascript">
        $(document).on("click",".openworkermodel",function () {
            var id =$(this).data('id');
            var name = $(this).data('name');
            var username =$(this).data('username');
            var email = $(this).data('email');
            var mobile_number =$(this).data('mobile_number');
            var nic = $(this).data('nic');
            var address =$(this).data('address');
            var role = $(this).data('role');

            $(".modal-body #nametoedit").html(id);
            $(".modal-body #editnametext").html(name);
            $(".modal-body #editusernametext").html(username);
            $(".modal-body #editemailtext").html(email);
            $(".modal-body #editmobile_numbertext").html(mobile_number);
            $(".modal-body #editnictext").html(nic);
            $(".modal-body #editaddresstext").html(address);
            $(".modal-body #editroletext").html(role);
        });
    </script>
    <script type="text/javascript">
        $(document).on("click",".opensalarymodal",function () {
            var salary_id = $(this).data('id');
            var update_salary = $(this).data('salary');

            $(".modal-body #salarytoedit").html(salary_id);
            $(".modal-body #editsalarytext").html(update_salary);
        });
    </script>
    <script type="text/javascript">
        $(document).on("click",".open_update_bonus_modal",function () {
            var bonus_id = $(this).data('id');
            var update_bonus_salary = $(this).data('bonus');

            $(".modal-body #bonustoedit").html(bonus_id);
            $(".modal-body #editbonustext").html(update_bonus_salary);
        });
    </script>
@endsection
@section('title') Employees' Salary History @endsection

@section('body')
    <div class="content-wrapper" id="main_div">
        <div class="container-home" id="salary_sheet_update">
            <div class="container-fluid">
                <div class="row" id="calSalary_row2">
                    <div class="col-md-12" id="show_salary_sheet">
                        <div class="section-header text-center">
                            <br>
                            <h3 class="title" id="Header"><b>Employees' Salary Payments History</b></h3>
                        </div>
                        <div id="table-wrapper" style="position: relative">
                            <div id="table-scroll" style="height: 400px;overflow: auto">
                                <table class="table table-bordered">
                                    <tr id="show_salary_tr">
                                        <th>Name</th>
                                        <th>Username</th>
                                        <th>Role</th>
                                        <th>Month</th>
                                        <th>Working Percentage</th>
                                        <th>Basic Payment</th>
                                        <th>EPF</th>
                                        <th>ETF</th>
                                        <th>Bonus</th>
                                        <th>Full Payments</th>
                                        <th>Statement</th>
                                    </tr>
                                    @foreach($data as $row)
                                        <tr id="show_salary_tr1">
                                            <td>{{$row['name']}}</td>
                                            <td>{{$row['username']}}</td>
                                            <td>{{$row['role']}}</td>
                                            <td>{{$row['month']}}</td>
                                            <td>{{$row['percentage']}}</td>
                                            <td>{{$row['basic_payment']}}</td>
                                            <td>{{$row['epf']}}</td>
                                            <td>{{$row['etf']}}</td>
                                            <td>{{$row['bonus']}}</td>
                                            <td>{{$row['full_payment']}}</td>
                                            <td>{{$row['statement']}}</td>
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
