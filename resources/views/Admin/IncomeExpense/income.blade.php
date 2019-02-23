@extends('Layouts.AdministrativeLayout')
@section('admin_css')
    <style>
        #income{
            background-color: white;
            color: black;
        }
        #income_tr{
            color: black;
            background-color: #3d6983;
        }
        #income_tr1{
            color: black;
        }
        #MonthlyIncomeButton{
            background-color: #3c763d;
        }
        #NoticeButtons{
            background-color: white
        }
    </style>
@endsection
@section('admin_js')
    <script type="text/javascript">
        $(document).on("click",".opendeletermodel",function () {
            var id =$(this).data('id');
            $(".modal-body #nametoedit").html(id);
        });
    </script>
    <script>
        setTimeout(function () {
            window.location.href= 'http://127.0.0.1:8000/income'; // the redirect goes here

        },120000);
    </script>
@endsection
@section('title') Income @endsection
@section('body')
    <div class="content-wrapper" id="main_div">
        <div class="container-home" id="NoticeButtons">
            <section class="content">
                <div class="row">
                    <div class="col-lg-3 col-xs-6">
                        <!-- small box -->
                        <div class="small-box bg-aqua">
                            <div class="inner">
                                <h4>Rs.{{$get_income}}/=</h4>
                                <p>Total Income for Current Month</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-bag"></i>
                            </div>
                            <a href="#" class="small-box-footer">TTS Income<i class="fa fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <!-- ./col -->
                    <div class="col-lg-3 col-xs-6">
                        <!-- small box -->
                        <div class="small-box bg-light-blue-active">
                            <div class="inner">
                                <h4>Rs.{{$get_all_income_statement}}/=</h4>
                                <p>Total Income Earned</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-stats-bars"></i>
                            </div>
                            <a href="#" class="small-box-footer">TTS Income <i class="fa fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <!-- ./col -->
                    <div class="col-lg-3 col-xs-6">
                        <!-- small box -->
                        <div class="small-box bg-light-blue-gradient">
                            <div class="inner">
                                <h4>Rs.{{$get_last_month_income_to_double}}/=</h4>
                                <p>Income for Last Month</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-person-add"></i>
                            </div>
                            <a href="#" class="small-box-footer">TTS Income<i class="fa fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <!-- ./col -->
                    <div class="col-lg-3 col-xs-6">
                        <!-- small box -->
                        <div class="small-box bg-red">
                            <div class="inner">
                                <h4>Rs.{{$get_upcoming_income}}/=</h4>
                                <p>Income for Have To Recieved</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-pie-graph"></i>
                            </div>
                            <a href="#" class="small-box-footer">TTS Income<i class="fa fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <!-- ./col -->
                </div>
            </section>
        </div>
        <div class="container-home" id="income">
            <br>
            <div class="container">
                <div class="row">
                    <div class="col-md-6">
                        <h4>Calculate Monthly Income and transferred details</h4>
                        <a id="editworker" class="opendeletermodel" data-toggle="modal" data-target="#deleteModel">
                            <button type="submit" class="btn btn-default" name="monthlyIncomeButton" id="MonthlyIncomeButton">Monthly Income</button>
                        </a>
                        <hr>
                        <h4>Day to Day Income Book</h4>
                        <div id="table-scroll" style="height: 400px;overflow: auto">
                            <table class="table table-bordered">
                                <tr id="income_tr">
                                    <th>Description</th>
                                    <th>Amount</th>
                                    <th>Date</th>
                                </tr>
                                @foreach($income_detail as $row)
                                    <tr id="income_tr1">
                                        <td>{{$row['description']}}</td>
                                        <td>{{$row['amount']}}</td>
                                        <td>{{$row['income_date']}}</td>
                                    </tr>
                                @endforeach
                            </table>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <h4>Monthly Income Book</h4>
                        <div id="table-scroll" style="height: 400px;overflow: auto">
                            <table class="table table-bordered">
                                <tr id="income_tr">
                                    <th>Description</th>
                                    <th>Amount</th>
                                    <th>Date</th>
                                </tr>
                                @foreach($monthly_income_detail as $row)
                                    <tr id="income_tr1">
                                        <td>{{$row['description']}}</td>
                                        <td>{{$row['amount']}}</td>
                                        <td>{{$row['income_date']}}</td>
                                    </tr>
                                @endforeach
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <hr>
            <div class="container">
                <div class="col-md-2"></div>
                <div class="col-md-8">
                    <h4>Fully Income Statements</h4>
                    <div id="table-scroll" style="height: 400px;overflow: auto">
                        <table class="table table-bordered">
                            <tr id="income_tr">
                                <th>Description</th>
                                <th>Amount</th>
                                <th>Date</th>
                            </tr>
                            @foreach($all_income_detail as $row)
                                <tr id="income_tr1">
                                    <td>{{$row['description']}}</td>
                                    <td>{{$row['amount']}}</td>
                                    <td>{{$row['income_date']}}</td>
                                </tr>
                            @endforeach
                        </table>
                    </div>
                </div>
                <div class="col-md-2"></div>
            </div>
        </div>>
    </div>
    <div class="modal fade" id="deleteModel" tabindex="-1" role="dialog" aria-labelledby="newsModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"></h5>
                    <form action="/calMonthlyIncome" method="post">
                        <div class="modal-body">
                            {{ csrf_field() }}
                            <h4><b>Are you sure do you want to collect Your monthly Income?</b></h4>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-default" name="monthlyIncomeButton" id="MonthlyIncomeButton">Monthly Income</button>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Exit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
