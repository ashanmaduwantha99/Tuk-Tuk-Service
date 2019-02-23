@extends('Layouts.AdministrativeDashboardLayout')
@section('admin_css')
    <style>
        #sidebar_height{
            height: 900px;
        }
    </style>
@endsection
@section('admin_js')
    <script>
        setTimeout(function () {
            window.location.href= 'http://127.0.0.1:8000/dashboard'; // the redirect goes here

        },150000);
    </script>
    <script type="text/javascript">
        $(document).on("click",".opensalarymodal",function () {
            var notice_id = $(this).data('notice_id');
            var note = $(this).data('note');

            $(".modal-body #service_idtoedit").html(notice_id);
            $(".modal-body #editservice_name").html(note);
        });
    </script>
@endsection
@section('title') Dashboard @endsection

@section('body')
    <div class="content-wrapper" id="sidebar_height">
        <div class="container-home" id="noticeButton">
            <section class="content">
                <div class="row">
                    <div class="col-lg-3 col-xs-6">
                        <!-- small box -->
                        <div class="small-box bg-aqua">
                            <div class="inner">
                                {{--<p>Rs.{{$get_income}}/=</p>--}}
                                <h4>{{$get_today_reservation}}</h4>
                                <p>Reservation count for Today</p>
                            </div>
                            <div class="icon">
                                <i class="fas fa-hand-holding-usd"></i>
                            </div>
                            <a href="/reservation_check" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <!-- ./col -->
                    <div class="col-lg-3 col-xs-6">
                        <!-- small box -->
                        <div class="small-box bg-green-gradient">
                            <div class="inner">
                                {{--<h4>Rs.{{$get_expense}}/=</h4>--}}
                                <h4>{{$get_today_reservation}}</h4>
                                <p>Serviced ThreeWheelers Count:</p>
                            </div>
                            <div class="icon">
                                <i class="fas fa-file-invoice-dollar"></i>
                            </div>
                            <a href="/reservation_check" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <!-- ./col -->
                    <div class="col-lg-3 col-xs-6">
                        <!-- small box -->
                        <div class="small-box bg-yellow">
                            <div class="inner">
                                {{--<h4>Rs.{{$get_profit_percentage}}/=</h4>--}}
                                <h4>{{$get_today_reservation}}</h4>
                                <p>Number of Threewheelers for Service</p>
                            </div>
                            <div class="icon">
                                <i class="fas fa-dollar-sign"></i>
                            </div>
                            <a href="/reservation_check" class="small-box-footer">More info<i class="fa fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <!-- ./col -->
                    <div class="col-lg-3 col-xs-6">
                        <!-- small box -->
                        <div class="small-box bg-light-blue-gradient">
                            <div class="inner">
                                <h4>{{$get_todoList}}</h4>
                                <p>Reminders for Today</p>
                            </div>
                            <div class="icon">
                                <i class="fas fa-hand-holding-usd"></i>
                            </div>
                            <a href="/view_comments" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <!-- ./col -->
                </div>

                {{--<div class="row">--}}
                    {{--<div class="col-lg-3 col-xs-6">--}}
                        {{--<!-- small box -->--}}
                        {{--<div class="small-box bg-light-blue-gradient">--}}
                            {{--<div class="inner">--}}
                                {{--<h4>{{$get_todoList}}</h4>--}}
                                {{--<p>To-Do List for Today</p>--}}
                            {{--</div>--}}
                            {{--<div class="icon">--}}
                                {{--<i class="fas fa-hand-holding-usd"></i>--}}
                            {{--</div>--}}
                            {{--<a href="/view_comments" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                    {{--<!-- ./col -->--}}
                    {{--<div class="col-lg-3 col-xs-6">--}}
                        {{--<!-- small box -->--}}
                        {{--<div class="small-box bg-light-blue-gradient">--}}
                            {{--<div class="inner">--}}
                                {{--<h4>Update Settings</h4>--}}
                                {{--<p>Administrative settings update</p>--}}
                            {{--</div>--}}
                            {{--<div class="icon">--}}
                                {{--<i class="fas fa-file-invoice-dollar"></i>--}}
                            {{--</div>--}}
                            {{--<a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                    {{--<!-- ./col -->--}}
                    {{--<div class="col-lg-3 col-xs-6">--}}
                        {{--<!-- small box -->--}}
                        {{--<div class="small-box bg-light-blue-gradient">--}}
                            {{--<div class="inner">--}}
                                {{--<h4>{{$get_today_reservation}}</h4>--}}
                                {{--<p>Reservation for Today</p>--}}
                            {{--</div>--}}
                            {{--<div class="icon">--}}
                                {{--<i class="fas fa-dollar-sign"></i>--}}
                            {{--</div>--}}
                            {{--<a href="/reservation_check" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                    {{--<!-- ./col -->--}}
                    {{--<div class="col-lg-3 col-xs-6">--}}
                        {{--<!-- small box -->--}}
                        {{--<div class="small-box bg-light-blue-gradient">--}}
                            {{--<div class="inner">--}}
                                {{--<h4>{{$get_today_workers_count}}</h4>--}}
                                {{--<p>Workers Attendance for Today</p>--}}
                            {{--</div>--}}
                            {{--<div class="icon">--}}
                                {{--<i class="fas fa-comments"></i>--}}
                            {{--</div>--}}
                            {{--<a href="/worker_attendance" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                    {{--<!-- ./col -->--}}
                {{--</div>--}}
                <div class="row">
                    <section class="col-lg-7 connectedSortable">
                        <!-- this section is commented by me-->
                        <div class="box box-primary">
                            <div class="box-header">
                                <i class="ion ion-clipboard"></i>

                                <h3 class="box-title">Reminders</h3>

                            </div>
                            <!-- /.box-header -->
                            <div class="box-body">
                                <!-- See dist/js/pages/dashboard.js to activate the todoList plugin -->
                                <ul class="todo-list">
                                    <li>
                                    @foreach($get_notices as $row)
                                        <!-- drag handle -->
                                            <span class="handle">
                                            <i class="fa fa-ellipsis-v"></i>
                                            <i class="fa fa-ellipsis-v"></i>
                                        </span>
                                            <!-- checkbox -->
                                            <input type="checkbox" value="">
                                            <span class="text">{{$row['note']}} {{$row['date']}} </span>
                                            <!-- Emphasis label -->
                                            {{--<small class="label label-primary"><i class="fa fa-clock-o"></i> 4 days</small>--}}
                                            <!-- General tools such as edit or delete-->
                                            <div class="tools">
                                                <a id="updatesalary" class="opensalarymodal" data-toggle="modal" data-target="#salaryModal"
                                                   data-notice_id="{{$row['notice_id']}}"
                                                   data-note="{{$row['note']}}">
                                                    <i class="fa fa-trash-o"></i>
                                                </a>
                                            </div>
                                            <br>
                                        @endforeach
                                    </li>
                                    <div class="modal fade" id="salaryModal" tabindex="-1" role="dialog" aria-labelledby="newsModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document" style="background-color:white">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel"><b>Delete Notices</b></h5>
                                            </div>
                                            <h4 style="padding-left: 20px;">Are you sure Do you wanna delete this Notice</h4>
                                            <form action="/deleteNotice" method="post">
                                                <div class="modal-body">
                                                    {{ csrf_field() }}
                                                    <div class="form-group">
                                                        <textarea rows="1" cols="1" class="hidden" id="service_idtoedit" name="notice_id"></textarea>
                                                        <textarea rows="1" cols="1" class="hidden" id="editservice_name" name="notice">
                                                        </textarea>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Reset</button>
                                                    <button type="submit" class="btn btn-danger">Delete</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </ul>

                            </div>
                            <div class="box-footer clearfix no-border">

                                <button type="button" class="btn btn-default pull-right"><i class="fa fa-plus"></i>
                                    <a id="updatebonus" class="open_update_bonus_modal" data-toggle="modal" data-target="#update_bonusModal">
                                        Add Reminder
                                    </a>
                                </button>
                                <div class="modal fade" id="update_bonusModal" tabindex="-1" role="dialog" aria-labelledby="newsModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document" style="background-color:white">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Add TO-Do List</h5>
                                        </div>
                                        <form action="/addToDoList" method="post">
                                            <div class="modal-body">
                                                {{ csrf_field() }}
                                                <div class="form-group">

                                                    <label for="salary id">Add Note</label>
                                                    <textarea rows="1" cols="1" class="form-control" id="note" name="note"></textarea>

                                                    <label for="news">Date</label>
                                                    <input type="date" name="date" id="date" class="form-control" required>

                                                    <label for="news">Time</label>
                                                    <input type="time" name="time" id="time" class="form-control" required>

                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Reset</button>
                                                <button type="submit" class="btn btn-primary">Add To-Do List</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="box box-info">
                            <div class="box-header">
                                <i class="fa fa-envelope"></i>

                                <h3 class="box-title">Quick Email</h3>
                                @if(session()->has('email'))
                                    <div class="alert alert-success">
                                        {{ session()->get('email') }}
                                    </div>
                            @endif
                            <!-- tools box -->
                                <div class="pull-right box-tools">
                                    <button type="button" class="btn btn-info btn-sm" data-widget="remove" data-toggle="tooltip"
                                            title="Remove">
                                        <i class="fa fa-times"></i></button>
                                </div>
                                <!-- /. tools -->
                            </div>
                            <div class="box-body">
                                <form action="/send_email" method="post">
                                    {{ csrf_field() }}
                                    <div class="form-group">
                                        <input type="email" class="form-control" name="email_to" placeholder="Email to:">
                                    </div>
                                    <div class="form-group">
                                        <input type="text" class="form-control" name="subject" placeholder="Subject">
                                    </div>
                                    <div>
                                        <textarea class="textarea" name="email_text" placeholder="Message" style="width: 100%; height: 125px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;">
                                        </textarea>
                                    </div>
                                    <button type="submit" class="btn btn-primary" style="margin-top:10px">Send</button>
                                </form>
                            </div>
                            <div class="box-footer clearfix">
                            </div>
                        </div>


                        <!-- quick email widget -->
                    </section>
                    <section class="col-lg-5 connectedSortable">
                        <!-- Calendar -->
                        <div class="box box-solid bg-green-gradient">
                            <div class="box-header">
                                <i class="fa fa-calendar"></i>

                                <h3 class="box-title">Calendar</h3>
                                <!-- tools box -->
                                <div class="pull-right box-tools">
                                    <!-- button with a dropdown -->
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-success btn-sm dropdown-toggle" data-toggle="dropdown">
                                            <i class="fa fa-bars"></i></button>
                                        <ul class="dropdown-menu pull-right" role="menu">
                                            <li><a href="#">Add new event</a></li>
                                            <li><a href="#">Clear events</a></li>
                                            <li class="divider"></li>
                                            <li><a href="#">View calendar</a></li>
                                        </ul>
                                    </div>
                                    <button type="button" class="btn btn-success btn-sm" data-widget="collapse"><i class="fa fa-minus"></i>
                                    </button>
                                    <button type="button" class="btn btn-success btn-sm" data-widget="remove"><i class="fa fa-times"></i>
                                    </button>
                                </div>
                                <!-- /. tools -->
                            </div>
                            <!-- /.box-header -->
                            <div class="box-body no-padding">
                                <!--The calendar -->
                                <div id="calendar" style="width: 100%"></div>
                            </div>
                            <!-- /.box-body -->
                            {{--<div class="box-footer text-black">--}}
                            {{--<div class="row">--}}
                            {{--<div class="col-sm-6">--}}
                            {{--<!-- Progress bars -->--}}
                            {{--<div class="clearfix">--}}
                            {{--<span class="pull-left">Income</span>--}}
                            {{--<small class="pull-right">{{$get_today_income_percentage}}</small>--}}
                            {{--</div>--}}
                            {{--<div class="progress xs">--}}
                            {{--<div class="progress-bar progress-bar-green" style="width: 26.05%;"></div>--}}
                            {{--</div>--}}

                            {{--<div class="clearfix">--}}
                            {{--<span class="pull-left">Expense</span>--}}
                            {{--<small class="pull-right">{{$get_today_expense_percentage}}</small>--}}
                            {{--</div>--}}
                            {{--<div class="progress xs">--}}
                            {{--<div class="progress-bar progress-bar-green" style="width: 16.88%;"></div>--}}
                            {{--</div>--}}
                            {{--</div>--}}
                            {{--<!-- /.col -->--}}
                            {{--<div class="col-sm-6">--}}
                            {{--<div class="clearfix">--}}
                            {{--<span class="pull-left">Workers Attendance</span>--}}
                            {{--<small class="pull-right">{{$get_today_workers_count}}</small>--}}
                            {{--</div>--}}
                            {{--<div class="progress xs">--}}
                            {{--<div class="progress-bar progress-bar-green" style="width: 25%;"></div>--}}
                            {{--</div>--}}

                            {{--<div class="clearfix">--}}
                            {{--<span class="pull-left">Reservation</span>--}}
                            {{--<small class="pull-right">{{$get_today_reservation}}</small>--}}
                            {{--</div>--}}
                            {{--<div class="progress xs">--}}
                            {{--<div class="progress-bar progress-bar-green" style="width: 10%;"></div>--}}
                            {{--</div>--}}
                            {{--</div>--}}
                            {{--<!-- /.col -->--}}
                            {{--</div>--}}
                            {{--<!-- /.row -->--}}
                            {{--</div>--}}
                        </div>
                        <!-- /.box -->

                    </section>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <h4><b>Income Chart</b></h4>
                        <div id="app1">
                            {!! $chart1->container() !!}
                        </div>
                    </div>
                    <div class="col-md-6">
                        <h4><b>Income/Expense Chart</b></h4>
                        <div id="app">
                            {!! $chart->container() !!}
                        </div>
                    </div>
                </div>




                <script src="https://unpkg.com/vue"></script>
                <script>
                    var app1 = new Vue({
                        el: '#app1',
                    });
                    var app = new Vue({
                        e2: '#app',
                    });
                </script>
                <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.min.js" charset="utf-8"></script>
                <script src=https://cdnjs.cloudflare.com/ajax/libs/echarts/4.0.2/echarts-en.min.js charset=utf-8></script>
                {!! $chart1->script() !!}
                {!! $chart->script() !!}

            </section>
        </div>
        <footer class="main-footer">
            <strong>Copyright &copy; 2018 <a href="#">Tuk-Tuk Service</a>.</strong> All rights
            reserved.
        </footer>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.3/js/bootstrap-select.min.js" charset="utf-8"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.6.0/Chart.bundle.js" charset="utf-8"></script>


@endsection
