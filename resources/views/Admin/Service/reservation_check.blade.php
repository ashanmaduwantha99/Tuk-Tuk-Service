@extends('Layouts.AdministrativeLayout')
@section('admin_css')
    <style>
        #store_registration{
            background-color: white;
        }
        #Header{
            color: black;
        }

        #label_item_reg{
            color: cornflowerblue;
        }
        #show_service_list_tr{
            background-color: cadetblue;
        }
        #show_service_list_data_tr1{
            border-color: black;
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
            window.location.href= 'http://127.0.0.1:8000/reservation_check'; // the redirect goes here

        },120000);
    </script>
@endsection
@section('title') Service Settings @endsection
@section('body')
    <div class="content-wrapper" id="main_div">
        <div class="container-home" id="store_registration">
            <div class="container">
                <div class="row">
                    <div class="col-md-1"></div>
                    <div class="col-md-10">
                        <div class="section-header text-center">
                            <br>
                            <h3 class="title" id="Header"><b>Service List</b></h3>
                        </div>
                        <div id="table-wrapper" style="position: relative;">
                            @if(session()->has('reservationDone'))
                                <div class="alert alert-success">
                                    {{ session()->get('reservationDone') }}
                                </div>
                            @endif

                            <div id="table-scroll" style="height: 350px;overflow: auto">
                                <table class="table table-bordered">
                                    <tr id="show_service_list_tr">
                                        <th>Name</th>
                                        <th>Mobile Number</th>
                                        <th>NIC</th>
                                        <th>Threewheel Number</th>
                                        <th>Date</th>
                                        <th>Type</th>
                                        <th>Number</th>
                                    </tr>
                                    @foreach($getReservationDetail as $row)
                                        <tr id="show_service_list_data_tr1">
                                            <td>{{$row['name']}}</td>
                                            <td>{{$row['mobile_number']}}</td>
                                            <td>{{$row['nic']}}</td>
                                            <td>{{$row['tw_number']}}</td>
                                            <td>{{$row['date']}}</td>
                                            <td>{{$row['type']}}</td>
                                            <td>{{$row['number']}}</td>
                                            <td>
                                                <form action="/reservationDone" method="post">
                                                    {{ csrf_field() }}
                                                    <div class="form-group row">
                                                        <div class="col-sm-6">
                                                            <input type="text" class="hidden" name="reserve_id" value="{{$row['id']}}">
                                                            <input type="text" class="hidden" name="name" value="{{$row['name']}}">
                                                            <input type="text" class="hidden" name="mobile_number" value="{{$row['mobile_number']}}">
                                                            <input type="text" class="hidden" name="nic" value="{{$row['nic']}}">
                                                            <input type="text" class="hidden" name="tw_number" value="{{$row['tw_number']}}">
                                                            <input type="text" class="hidden" name="date" value="{{$row['date']}}">
                                                            <input type="text" class="hidden" name="type" value="{{$row['type']}}">
                                                            <input type="text" class="hidden" name="number" value="{{$row['number']}}">
                                                            <button type="submit" class="btn btn-primary" name="RegWorker">Success</button>
                                                        </div>
                                                        <div class="col-sm-6">
                                                        </div>
                                                    </div>
                                                </form>
                                            </td>
                                            <td>
                                                <a id="editworker" class="opendeletermodel" data-toggle="modal" data-target="#deleteModel"
                                                   data-id = "{{$row['id']}}"
                                                   style="color: red">
                                                    <button type="submit" class="btn btn-danger" name="monthlyIncomeButton" id="MonthlyIncomeButton">Remove</button>
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </table>
                            </div>
                        </div>

                    </div>
                    <div class="col-md-1"></div>
                </div>
            </div>
            <div class="container">
                <div class="row">
                    <div class="col-md-1"></div>
                    <div class="col-md-10">
                        <div class="section-header text-center">
                            <br>
                            <h3 class="title" id="Header"><b>Service List - History</b></h3>
                        </div>
                        <div id="table-wrapper" style="position: relative;">

                            <div id="table-scroll" style="height: 250px;overflow: auto">
                                <table class="table table-bordered">
                                    <tr id="show_service_list_tr">
                                        <th>Name</th>
                                        <th>Mobile Number</th>
                                        <th>NIC</th>
                                        <th>Threewheel Number</th>
                                        <th>Date</th>
                                        <th>Type</th>
                                        <th>Number</th>
                                    </tr>
                                    @foreach($pastReservation as $row)
                                        <tr id="show_service_list_data_tr1">
                                            <td>{{$row['name']}}</td>
                                            <td>{{$row['mobile_number']}}</td>
                                            <td>{{$row['nic']}}</td>
                                            <td>{{$row['tw_number']}}</td>
                                            <td>{{$row['date']}}</td>
                                            <td>{{$row['type']}}</td>
                                            <td>{{$row['number']}}</td>
                                        </tr>
                                    @endforeach
                                </table>
                            </div>
                        </div>

                    </div>
                    <div class="col-md-1"></div>
                </div>
            </div>
            <div class="modal fade" id="deleteModel" tabindex="-1" role="dialog" aria-labelledby="newsModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel"></h5>
                            <form action="/reservationRemove" method="post">
                                <div class="modal-body">
                                    <h4><b>Are you sure do you want to remove this reservation?</b></h4>
                                    {{ csrf_field() }}
                                    <div class="form-group">
                                        <textarea rows="1" cols="1" class="hidden" id="nametoedit" name="reserve_id" readonly></textarea>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-danger" name="RegWorker">Remove</button>
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Exit</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
