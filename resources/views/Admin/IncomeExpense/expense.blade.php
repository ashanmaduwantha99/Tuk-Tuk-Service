@extends('Layouts.AdministrativeLayout')
@section('admin_css')
    <style>
        #expense{
            background-color: white;
        }
        #show_store_list_tr{
            background-color: #3d6983;
        }
        #NoticeButtons{
            background-color: white
        }
    </style>
@endsection
@section('admin_js')
    <script>
        setTimeout(function () {
            window.location.href= 'http://127.0.0.1:8000/expense'; // the redirect goes here

        },120000);
    </script>
@endsection
@section('title') Expense @endsection
@section('body')
    <div class="content-wrapper" id="main_div">
        <div class="container-home" id="NoticeButtons">
            <section class="content">
                <div class="row">
                    <div class="col-lg-3 col-xs-6">
                        <!-- small box -->
                        <div class="small-box bg-aqua">
                            <div class="inner">
                                <h4>Rs.{{$get_expense}}/=</h4>
                                <p>Total Expense for cuurent Month</p>
                            </div>
                            <div class="icon">
                                {{--<i class="ion ion-bag"></i>--}}
                            </div>
                            <a href="#" class="small-box-footer">TTS Expense<i class="fa fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <!-- ./col -->
                    <div class="col-lg-3 col-xs-6">
                        <!-- small box -->
                        <div class="small-box bg-green">
                            <div class="inner">
                                <h4>Rs.{{$get_all_expense_statement}}/=</h4>
                                <p>Total Amount of Expense</p>
                            </div>
                            <div class="icon">
                                {{--<i class="ion ion-stats-bars"></i>--}}
                            </div>
                            <a href="#" class="small-box-footer">TTS Expense<i class="fa fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <!-- ./col -->
                    <div class="col-lg-3 col-xs-6">
                        <!-- small box -->
                        <div class="small-box bg-yellow">
                            <div class="inner">
                                <h4>Rs.{{$get_last_month_expense_to_double}}/=</h4>
                                <p>Expense of Last Month</p>
                            </div>
                            <div class="icon">
                                {{--<i class="ion ion-person-add"></i>--}}
                            </div>
                            <a href="#" class="small-box-footer">TTS Expense<i class="fa fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <!-- ./col -->
                    <div class="col-lg-3 col-xs-6">
                        <!-- small box -->
                        {{--<div class="small-box bg-red">--}}
                            {{--<div class="inner">--}}
                                {{--<h4>Rs.{{$get_expense}}/=</h4>--}}
                                {{--<p>Expense have to Pay</p>--}}
                            {{--</div>--}}
                            {{--<div class="icon">--}}
                                {{--<i class="ion ion-pie-graph"></i>--}}
                            {{--</div>--}}
                            {{--<a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>--}}
                        {{--</div>--}}
                    </div>
                    <!-- ./col -->
                </div>
            </section>
        </div>
        <div class="container-home" id="expense">
            <div class="container">
                <h4><b>Calculate Monthly Expense and transferred details</b></h4>
                <a id="editworker" class="opendeletermodel" data-toggle="modal" data-target="#deleteModel">
                    <button type="submit" class="btn btn-primary" name="monthlyIncomeButton" id="MonthlyIncomeButton">Monthly Expence</button>
                </a>
                <div class="row">
                    <div class="col-md-6">
                        <h4><b>Day to Day Expense Book</b></h4>
                        <div id="table-scroll" style="height: 400px;overflow: auto">
                            <table class="table table-bordered">
                                <tr id="show_store_list_tr">
                                    <th>Description</th>
                                    <th>Amount</th>
                                    <th>Date</th>
                                </tr>
                                @foreach($expense_detail as $row)
                                    <tr id="show_store_list_data_tr1">
                                        <td>{{$row['description']}}</td>
                                        <td>{{$row['amount']}}</td>
                                        <td>{{$row['expense_date']}}</td>
                                    </tr>
                                @endforeach
                            </table>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <h4><b>Monthly Expense Book</b></h4>
                        <div id="table-scroll" style="height: 400px;overflow: auto">
                            <table class="table table-bordered">
                                <tr id="show_store_list_tr">
                                    <th>Description</th>
                                    <th>Amount</th>
                                    <th>Date</th>
                                </tr>
                                @foreach($monthly_expense_detail as $row)
                                    <tr id="show_store_list_data_tr1">
                                        <td>{{$row['description']}}</td>
                                        <td>{{$row['amount']}}</td>
                                        <td>{{$row['expense_date']}}</td>
                                    </tr>
                                @endforeach
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="row">
                    <div class="col-md-2"></div>
                    <div class="col-md-8">
                        <h4>Expense Book</h4>
                        <div id="table-scroll" style="height: 400px;overflow: auto">
                            <table class="table table-bordered">
                                <tr id="show_store_list_tr">
                                    <th>Description</th>
                                    <th>Amount</th>
                                    <th>Date</th>
                                </tr>
                                @foreach($all_expense_detail as $row)
                                    <tr id="show_store_list_data_tr1">
                                        <td>{{$row['description']}}</td>
                                        <td>{{$row['amount']}}</td>
                                        <td>{{$row['expense_date']}}</td>
                                    </tr>
                                @endforeach
                            </table>
                        </div>
                    </div>
                    <div class="col-md-2"></div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="deleteModel" tabindex="-1" role="dialog" aria-labelledby="newsModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"></h5>
                    <form action="/calMonthlyExpense" method="post">
                        <div class="modal-body">
                            {{ csrf_field() }}
                            <h4><b>Are you sure do you want to collect Your monthly Expense?</b></h4>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary" name="monthlyIncomeButton" id="MonthlyIncomeButton">Collect</button>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Exit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
