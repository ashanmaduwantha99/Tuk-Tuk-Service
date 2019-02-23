@extends('Layouts.UsersLayout')
@section('usercss')
    <style>
        table {
            font-family: arial, sans-serif;
            border-collapse: collapse;
            width: 100%;
        }

        td, th {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }

        tr:nth-child(even) {
            background-color: #dddddd;
        }
    </style>
@endsection
@section('user_js')
    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.9/angular.min.js"></script>
@endsection
@section('title') Customer Job Book @endsection
@section('body')

    <div class="container-home" id="firstContainerHome">
        <br><br><br>
        <div class="container">
            <div class="row">
                {{--<img src="{{URL::asset('/Media/Images/logot.png')}}" class="img-responsive" id="logo">--}}
            </div>
        </div>
    </div>

    <div class="container-home" id="secondContainerHome">
        <div class="container">
            <div class="row">
                <h2>View Job Book</h2>
                <div class="col-md-8">
                    <div id="table-scroll" style="height: 400px;overflow: auto">
                        <table class="table table-bordered">
                            <tr id="trhead">
                                <th>Job</th>
                                <th>Job Date</th>
                            </tr>
                            @foreach($get_details as $row)
                                <tr id="trdata">
                                    <td>{{$row['job_desc']}}</td>
                                    <td>{{$row['job_desc_created_at']}}</td>
                                </tr>
                            @endforeach
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
