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
            window.location.href= 'http://127.0.0.1:8000/service_add'; // the redirect goes here

        },120000);
    </script>

    <script type="text/javascript">
        $(document).on("click",".opensalarymodal",function () {
            var service_id = $(this).data('id');
            var service_name = $(this).data('service_name');
            var service_price = $(this).data('service_price');

            $(".modal-body #service_idtoedit").html(service_id);
            $(".modal-body #editservice_name").html(service_name);
            $(".modal-body #editservice_price").html(service_price);
        });
    </script>
@endsection
@section('title') Service Settings @endsection
@section('body')
    <div class="content-wrapper" id="main_div">
        <div class="container-home" id="store_registration">
            <div class="container">
                <div class="row">
                    <div class="col-md-3"></div>
                    <div class="col-md-6">
                        <div class="section-header text-center">
                            <br>
                            <h3 class="title" id="Header"><b>Add Services</b></h3>
                        </div>
                        @if(session()->has('addservice_message'))
                            <div class="alert alert-success">
                                {{ session()->get('addservice_message') }}
                            </div>
                        @endif
                        @if(session()->has('addservice_dgr'))
                            <div class="alert alert-danger">
                                {{ session()->get('addservice_dgr') }}
                            </div>
                        @endif
                        <form action="/addService" method="post" id="StoreForm">
                            {{ csrf_field() }}
                            <div class="form-group row">
                                <label for="service_name" class="col-sm-3 col-form-label" id="label_item_reg">Service Name</label>
                                <div class="col-sm-9">
                                    <input type="text" name="service_name" class="form-control" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="service_price" class="col-sm-3 col-form-label" id="label_item_reg">Service Price</label>
                                <div class="col-sm-9">
                                    <input type="text" name="service_price" class="form-control" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-6">
                                    <button type="submit" class="btn btn-primary" name="RegWorker">Add New Service</button>
                                </div>
                                <div class="col-sm-6">
                                    <button type="reset" class="btn btn-success">Clear</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="col-md-3"></div>
                </div>
            </div>
            <div class="container">
                <div class="row">
                    <div class="col-md-1"></div>
                    <div class="col-md-10">
                        <div class="section-header text-center">
                            <br>
                            <h3 class="title" id="Header"><b>Service List</b></h3>
                        </div>
                        <div id="table-wrapper" style="position: relative;">
                            @if(session()->has('messagedelete_service'))
                                <div class="alert alert-success">
                                    {{ session()->get('messagedelete_service') }}
                                </div>
                            @endif
                            @if(session()->has('message_update_service_list'))
                                <div class="alert alert-success">
                                    {{ session()->get('message_update_service_list') }}
                                </div>
                            @endif
                            @if(session()->has('message_update_service_list_dgr'))
                                <div class="alert alert-danger">
                                    {{ session()->get('message_update_service_list_dgr') }}
                                </div>
                            @endif

                            <div id="table-scroll" style="height: 500px;overflow: auto">
                                <table class="table table-bordered">
                                    <tr id="show_service_list_tr">
                                        <th>Service Name</th>
                                        <th>Service Price</th>
                                        <th>Edit Prices</th>
                                        <th>Delete Service</th>
                                    </tr>
                                    @foreach($service_list_detail as $row)
                                        <tr id="show_service_list_data_tr1">
                                            <td>{{$row['service_name']}}</td>
                                            <td>{{$row['service_price']}}</td>
                                            <td>
                                                <a id="updatesalary" class="opensalarymodal" data-toggle="modal" data-target="#salaryModal"
                                                   data-id="{{$row['service_id']}}"
                                                   data-service_name="{{$row['service_name']}}"
                                                   data-service_price="{{$row['service_price']}}">
                                                    Update
                                                </a>
                                            </td>
                                            <td>
                                                <a id="editworker" class="opendeletermodel" data-toggle="modal" data-target="#deleteModel"
                                                   data-id = "{{$row['service_id']}}"
                                                   style="color: red">
                                                    <button type="submit" class="btn btn-danger" name="monthlyIncomeButton" id="MonthlyIncomeButton">Remove</button>
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </table>
                                <div class="modal fade" id="deleteModel" tabindex="-1" role="dialog" aria-labelledby="newsModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel"></h5>
                                                <form action="/deleteService" method="post">
                                                    <div class="modal-body">
                                                        <h4><b>Are you sure do you want to remove this reservation?</b></h4>
                                                        {{ csrf_field() }}
                                                        <div class="form-group">
                                                            <textarea rows="1" cols="1" class="hidden" id="nametoedit" name="service_id" readonly></textarea>
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

                    </div>
                    <div class="col-md-1"></div>
                </div>
            </div>
            <div class="modal fade" id="salaryModal" tabindex="-1" role="dialog" aria-labelledby="newsModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document" style="background-color: #2a88bd">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Update Service Detail</h5>
                    </div>
                    <form action="/updateservicedetail" method="post">
                        <div class="modal-body">
                            {{ csrf_field() }}
                            <div class="form-group">

                                <textarea rows="1" cols="1" class="hidden" id="service_idtoedit" name="service_id"></textarea>

                                <label for="news">Service Name</label>
                                <textarea rows="1" cols="1" class="form-control" id="editservice_name" name="service_name">
                                </textarea>
                                <label for="news">Service Prie</label>
                                <textarea rows="1" cols="1" class="form-control" id="editservice_price" name="service_price">
                                </textarea>

                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Reset</button>
                            <button type="submit" class="btn btn-primary">Update Salary</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
