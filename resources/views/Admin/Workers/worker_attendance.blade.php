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
        #input_att_form{
            background-color: transparent;
            border-color: #3d6983;
            color: black;
        }
        #attbutton{
            width:auto;
            background-color:forestgreen;
        }
        #show_att_tr{
            color: darkblue;
            background-color: skyblue;
            border: 2px solid black;
        }
        #show_att_tr1{
            color: black;
            border: 2px solid black;
        }
        #option_att{
            color: black;
        }
        #WorkerPercentage{
            background-color: white;
        }
    </style>
@endsection
@section('admin_js')
    <script>
        setTimeout(function () {
            window.location.href= 'http://127.0.0.1:8000/worker_attendance'; // the redirect goes here

        },120000);
    </script>
@endsection
@section('title') Employee Handling @endsection

@section('body')
    <div class="content-wrapper" id="main_div">
        <div class="container-home" id="workerAttendance">
            <div class="container">
                <div class="row">
                    <div class="col-md-5">
                        <h3><b>Upload daily attendace sheet</b></h3>
                        <hr>
                        <form action="/import_attendance" method="post" enctype="multipart/form-data">
                            <div class="col-md-6">
                                {{csrf_field()}}
                                <input type="file" name="import_file"/>
                            </div>
                            <div class="col-md-6">
                                <button class="btn btn-primary" type="submit">Import</button>
                            </div>
                        </form>
                        <hr>
                        <div class="section-header text-center">
                            <br>
                            <h3 class="title" id="Header"><b>Today Attendance </b></h3>
                        </div>
                        <div id="table-wrapper" style="position: relative">
                            <div id="table-scroll" style="height: 400px;overflow: auto">
                                <table class="table table-bordered">
                                    <tr id="att_sheet_tr">
                                        <th>Name</th>
                                        <th>Username</th>
                                        <th>Date({{$TodayDate}})</th>
                                        <th>Attendance</th>
                                    </tr>
                                    @if(session()->has('messageatt'))
                                        <div class="alert alert-success">
                                            {{ session()->get('messageatt') }}
                                        </div>
                                    @endif
                                    @if(session()->has('messageatt_dgr'))
                                        <div class="alert alert-danger">
                                            {{ session()->get('messageatt_dgr') }}
                                        </div>
                                    @endif
                                    @foreach($detail as $row)
                                        <tr id="att_sheet_tr_1">
                                            <td>{{$row['name']}}</td>
                                            <td>{{$row['username']}}</td>
                                            {{--<td>{{$TodayDate}}</td>--}}
                                            <form action="/mark_attendance" method="post">
                                                {{ csrf_field() }}
                                                <td>
                                                    <input type="text" class="hidden" id="input_att_form" name="name" value="{{$row['name']}}">
                                                    <input type="text" class="hidden" id="input_att_form" name="username" value="{{$row['username']}}">
                                                    <input type="date" class="hidden" id="input_att_form" name="date" value="{{$TodayDate}}">
                                                    <select id="input_att_form" class="form-control" name="attendance" required >
                                                        {{--<option selected id="option_att">Mark Attendance</option>--}}
                                                        <option id="option_att" value="present">Present</option>
                                                        <option id="option_att" value="absance">Absance</option>
                                                    </select>
                                                </td>
                                                <td>
                                                    <button type="submit" class="btn btn-default" name="AttMarkBtn" id="attbutton">Fill</button>
                                                </td>
                                            </form>
                                        </tr>
                                    @endforeach
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-7" id="show_attendance">
                        <div class="section-header text-center">
                            <br>
                            <h3 class="title" id="Header"><b>Monthly Employee Attendance View</b></h3>
                        </div>
                        <div class="table-wrapper"style="position: relative" id="attedanceView">
                            <div id="table-scroll" style="height: 400px;overflow: auto">
                                <table class="table table-bordered">
                                    <tr id="show_att_tr">
                                        <th>Name</th>
                                        <th>Username</th>
                                        <th>Date</th>
                                        <th>Attendance</th>
                                    </tr>
                                    @foreach($attdetail as $row)
                                        <tr id="show_att_tr1">
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
                            <h3 class="title"><b>Current Percentage of Attendance</b></h3>
                        </div>
                        <div id="table-wrapper" style="position: relative">
                            <div id="table-scroll" style="height: 350px;overflow: auto">
                                <table class="table table-bordered">
                                    <tr id="att_sheet_tr">
                                        <th>Username</th>
                                        <th>Present Count</th>
                                        <th>Absence Count</th>
                                        <th>Fully Work Day Count</th>
                                        <th>Attendance Percentage</th>
                                    </tr>
                                    @foreach($count_data as $row)
                                        <tr id="att_sheet_tr_1">
                                            <td>{{$row['username']}}</td>
                                            <td>{{$row['count']}}</td>
                                            <td>{{$row['absance_count']}}</td>
                                            <td>{{$row['fully_work_day_count']}}</td>
                                            <td>{{$row['work_day_percentage']}}</td>
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
