@extends('Layouts.AdministrativeLayout')
@section('admin_css')
    <style>
        #Header{
            color: black;
        }
        #workerAttendance{
            background-color:white;
        }
        #att_sheet_tr{
            color: midnightblue;
            background-color: skyblue;
            border: 2px solid black;
        }
        #att_sheet_tr_1{
            color: black;
            border: 2px solid black;
        }
        #WorkerPercentage{
            background-color: white;
        }
    </style>
@endsection
@section('admin_js')
    <script>
        setTimeout(function () {
            window.location.href= 'http://127.0.0.1:8000/worker_attendance_history'; // the redirect goes here

        },120000);
    </script>
@endsection
@section('title') Employee Attendance History @endsection

@section('body')
    <div class="content-wrapper" id="main_div">
        <div class="container-home" id="WorkerPercentage">
            <div class="container">
                <div class="row">
                    <div class="col-md-8" id="attendance_present_count">
                        <div class="section-header text-center">
                            <br>
                            <h3 class="title"><b>Employees Attendance History</b></h3>
                        </div>
                        <div id="table-wrapper" style="position: relative">
                            <div id="table-scroll" style="height: 350px;overflow: auto">
                                <table class="table table-bordered">
                                    <tr id="att_sheet_tr">
                                        <th>Name</th>
                                        <th>Username</th>
                                        <th>Date</th>
                                        <th>Attendance</th>
                                    </tr>
                                    @foreach($detail2 as $row)
                                        <tr id="att_sheet_tr_1">
                                            <td>{{$row['name']}}</td>
                                            <td>{{$row['username']}}</td>
                                            <td>{{$row['date']}}</td>
                                            <td>{{$row['attendance']}}</td>
                                        </tr>
                                    @endforeach
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container-home" id="WorkerPercentage">
            <div class="container">
                <div class="row">
                    <div class="col-md-8" id="attendance_present_count">
                        <div class="section-header text-center">
                            <br>
                            <h3 class="title"><b>Attendance-Date Count for past Month</b></h3>
                        </div>
                        <div id="table-wrapper" style="position: relative">
                            <div id="table-scroll" style="height: 350px;overflow: auto">
                                <table class="table table-bordered">
                                    <tr id="att_sheet_tr">
                                        <th>Username</th>
                                        <th>Present Count</th>
                                        <th>Absence Count</th>
                                        <th>Transfer Date</th>
                                    </tr>
                                    @foreach($detail1 as $row)
                                        <tr id="att_sheet_tr_1">
                                            <td>{{$row['username']}}</td>
                                            <td>{{$row['count']}}</td>
                                            <td>{{$row['absance_count']}}</td>
                                            <td>{{$row['created_at']}}</td>
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
