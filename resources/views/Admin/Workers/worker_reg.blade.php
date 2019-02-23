@extends('Layouts.AdministrativeLayout')
@section('admin_css')
    <style>
        #main_div{
            background-color: white;
        }
        #workerRegistration{
            background-color: white;
        }
        #Header{
            color: black;
        }
        #label_reg{
            color: black;
        }
        #inputreg_details{
            background-color: transparent;
            color: gray();
            border-color: black;
            width: 300px;
        }
        #table_th{
            color: black;
            background-color: #3d6983;
            border: 2px solid black;
        }
        #worker_data_row{
            border: 2px solid black;
        }
        #sicon{
            display: block;
            margin-left: auto;
            margin-right: auto;
            width: 40%;
        }
    </style>
@endsection
@section('admin_js')
    <script>
        setTimeout(function () {
            window.location.href= 'http://127.0.0.1:8000/worker_registration'; // the redirect goes here

        },120000);
    </script>
    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.9/angular.min.js"></script>
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
        $(document).on("click",".opendeletermodel",function () {
            var id =$(this).data('id');
            $(".modal-body #nametoedit").html(id);
        });
    </script>
@endsection
@section('title') Employees Registration @endsection

@section('body')
    <div class="content-wrapper" id="main_div">
        <div class="container-home" id="workerRegistration">
            <div class="container">
                <div class="row">
                    <div class="col-md-12" id="show_workers">
                        <div class="section-header text-center" id="Header">
                            <br>
                            <h3 class="title"><b>Employees</b></h3>
                        </div>
                        @if(session()->has('messageEdit'))
                            <div class="alert alert-success">
                                {{ session()->get('messageEdit') }}
                            </div>
                        @endif
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        @if(session()->has('messagedelete'))
                            <div class="alert alert-success">
                                {{ session()->get('messagedelete') }}
                            </div>
                        @endif
                        @if(session()->has('messagedelete_dgr'))
                            <div class="alert alert-danger">
                                {{ session()->get('messagedelete_dgr') }}
                            </div>
                        @endif
                        <div id="table-wrapper" style="position: relative;">
                            <div id="table-scroll" style="height: 250px;overflow: auto">
                                <table class="table table-hover" id="attendancetable">
                                    <tr id="table_th">
                                        <th>ID</th>
                                        <th>Name</th>
                                        <th>Username</th>
                                        <th>NIC</th>
                                        <th>Address</th>
                                        <th>Mobile Number</th>
                                        <th>Email</th>
                                        <th>Role</th>
                                        <th>Edit Details</th>
                                        <th>Remove Employee</th>
                                    </tr>
                                    @foreach($detail as $row)
                                        <tr id="worker_data_row">
                                            <td>{{$row['id']}}</td>
                                            <td>{{$row['name']}}</td>
                                            <td>{{$row['username']}}</td>
                                            <td>{{$row['nic']}}</td>
                                            <td>{{$row['address']}}</td>
                                            <td>{{$row['mobile_number']}}</td>
                                            <td>{{$row['email']}}</td>
                                            <td>{{$row['role']}}</td>

                                            <td>
                                                <a id="editworker" class="openworkermodel" data-toggle="modal" data-target="#workerModal"
                                                   data-name = "{{$row['name']}}"
                                                   data-id = "{{$row['id']}}"
                                                   data-nic = "{{$row['nic']}}"
                                                   data-address = "{{$row['address']}}"
                                                   data-role = "{{$row['role']}}"
                                                   data-email = "{{$row['email']}}"
                                                   data-mobile_number = "{{$row['mobile_number']}}"
                                                >Edit
                                                </a>
                                            </td>
                                            <td>
                                                <a id="editworker" class="opendeletermodel" data-toggle="modal" data-target="#deleteModel"
                                                       data-id = "{{$row['id']}}"
                                                    style="color: red">Fire</a>
                                             </td>
                                        </tr>
                                    @endforeach
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal fade" id="workerModal" tabindex="-1" role="dialog" aria-labelledby="newsModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Update Employees Detail</h5>
                        </div>
                        <form action="/editworker" method="post">
                            <div class="modal-body">
                                {{ csrf_field() }}
                                <div class="form-group">
                                    <label for="id">ID</label>
                                    <textarea rows="1" cols="1" class="form-control" id="nametoedit" name="id" readonly></textarea>
                                    <label for="name">Name</label>
                                    <textarea rows="1" cols="1" class="form-control" id="editnametext" name="name"></textarea>
                                    <label for="name">Email</label>
                                    <textarea rows="1" cols="1" class="form-control" id="editemailtext" name="email"></textarea>
                                    <label for="name">Mobile Number</label>
                                    <textarea rows="1" cols="1" class="form-control" id="editmobile_numbertext" name="mobile_number"></textarea>
                                    <label for="name">NIC</label>
                                    <textarea rows="1" cols="1" class="form-control" id="editnictext" name="nic"></textarea>
                                    <label for="name">Address</label>
                                    <textarea rows="1" cols="1" class="form-control" id="editaddresstext" name="address"></textarea>
                                    <label for="name">Role</label>
                                    <textarea rows="1" cols="1" class="form-control" id="editroletext" name="role"></textarea>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Exit</button>
                                <button type="submit" class="btn btn-primary">Update</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <hr style="border: 1px solid black;">
            <div class="container" ng-app="">
                <div class="row">
                    <div class="col-md-6">
                        <div class="section-header text-center" id="Header">
                            <br>
                            <h3 class="title"><b>Employees Registration</b></h3>
                        </div>
                        @if(session()->has('message_register'))
                            <div class="alert alert-success">
                                {{ session()->get('message_register') }}
                            </div>
                        @endif
                        @if ($errors->any())
                                    <div class="alert alert-danger">
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif
                        <form action="register_workers" method="post" id="RegisterForm" name="myForm">
                                    {{ csrf_field() }}
                                    <div class="form-group row">
                                        <label for="name" class="col-sm-3 col-form-label" id="label_reg">Name</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" name="name" id="inputreg_details" placeholder="Name" required>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="username" class="col-sm-3 col-form-label" id="label_reg">Username</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" id="inputreg_details" name="username" placeholder="username" required>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="email" class="col-sm-3 col-form-label" id="label_reg">Email</label>
                                        <div class="col-sm-9">
                                            <input type="email" class="form-control" id="inputreg_details" name="email" placeholder="Email" required>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="mobile_number" class="col-sm-3 col-form-label" id="label_reg">Mobile Number</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" id="inputreg_details" name="mobile_number" placeholder="Mobile Number" required>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="nic" class="col-sm-3 col-form-label" id="label_reg">NIC</label>
                                        <div class="col-sm-9">
                                            {{--<input type="text" class="form-control" id="inputreg_details" name="nic" placeholder="NIC Number" required>--}}
                                            <input type="text" class="form-control" id="inputreg_details" name="nic" placeholder="NIC" ng-model="nic" ng-minlength="10" ng-maxlength="10" required>
                                            <span style="color:red" ng-if="!myForm.nic.$valid">Please Enter Valid NIC number</span>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="address" class="col-sm-3 col-form-label" id="label_reg">Address</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" id="inputreg_details" name="address" placeholder="HomeTown" required>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="role" class="col-sm-3 col-form-label" id="label_reg">Role</label>
                                        <div class="col-sm-9">
                                            <select id="inputreg_details" class="form-control" name="role" required>
                                                {{--<option selected id="option_reg">Set the Role</option>--}}
                                                <option value="service" id="option_reg">Service</option>
                                                <option id="option_reg" value="mechanic">Mechanic</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-sm-6">
                                            <button type="submit" class="btn btn-primary" name="RegWorker">Register</button>
                                            <button type="reset" class="btn btn-success">Clear</button>
                                        </div>
                                        <div class="col-sm-6">
                                        </div>
                                    </div>
                                </form>
                    </div>
                    <div class="col-md-6">
                        <br><br><br>
                        <img src="{{URL::asset('/Media/Images/sicon.png')}}" id="sicon">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="deleteModel" tabindex="-1" role="dialog" aria-labelledby="newsModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"></h5>
                    <form action="/deleteworkers" method="post">
                        <div class="modal-body">
                            {{ csrf_field() }}
                            <h4><b>Are you sure do you want to fire this employee?</b></h4>
                            <div class="form-group">
                                <textarea rows="1" cols="1" class="hidden" id="nametoedit" name="id" readonly></textarea>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-danger">Fire</button>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Exit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


@endsection
