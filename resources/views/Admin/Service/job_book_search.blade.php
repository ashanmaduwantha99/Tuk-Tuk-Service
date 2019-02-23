@extends('Layouts.AdministrativeLayout')
@section('admin_css')
    <style>
        #Header{
            color: black;
        }
        #input_search_details{
            border-color: black;
        }
        input[type=text] {
            width: 100%;
            box-sizing: border-box;
            border: 2px solid #ccc;
            border-radius: 4px;
            font-size: 16px;
            background-color: white;
            background-image: url('searchicon.png');
            background-position: 10px 10px;
            background-repeat: no-repeat;
            padding: 12px 20px 12px 40px;
        }
        #iconMan{
            display: block;
            margin-left: auto;
            margin-right: auto;
            width: 50%;
        }
    </style>
@endsection
@section('admin_js')
    <script>
        setTimeout(function () {
            window.location.href= 'http://127.0.0.1:8000/job_book_search'; // the redirect goes here

        },120000);
    </script>
@endsection
@section('title') Job Book @endsection
@section('body')
    <div class="content-wrapper" id="job_book_content">
        <div class="container-home" id="job_book_view">
            <div class="container">
                <div class="col-md-6">
                    <div class="container" id="job_book_view_table">
                            <h2>Job Book Details</h2>

                                @if ($errors->any())
                                    <div class="alert alert-danger">
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif
                                @if(session()->has('message_job_book_add'))
                                    <div class="alert alert-success">
                                        {{ session()->get('message_job_book_add') }}
                                    </div>
                                @endif
                                @if(session()->has('message_job_book_add_dgr'))
                                    <div class="alert alert-success">
                                        {{ session()->get('message_job_book_add_dgr') }}
                                    </div>
                                @endif
                            <hr>
                            <a id="edit_store_list" class="add_job_book_model" data-toggle="modal" data-target="#create_job_book_Modal" style="color: #3c763d">
                                <h4>+Create Job Book</h4>
                            </a>
                            <table class="table table-striped">
                                <thead>
                                <tr style="background-color: midnightblue;color: whitesmoke">
                                    <th>Three-Wheel Number</th>
                                    <th>Three-Wheel Chassis Number</th>
                                    <th>Three-Wheel engine Number</th>
                                    <th>Stroke</th>
                                    <th>Owner Name</th>
                                    <th>Owner NIC</th>
                                    <th>Job Book Created Date</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($job_book_details as $row)
                                    <tr style="background-color: whitesmoke;color: black">
                                        <td>{{$row['tw_number']}}</td>
                                        <td>{{$row['tw_ch_number']}}</td>
                                        <td>{{$row['tw_eng_number']}}</td>
                                        <td>{{$row['stork']}}</td>
                                        <td>{{$row['owner_name']}}</td>
                                        <td>{{$row['owner_nic']}}</td>
                                        <td>{{$row['job_book_created_at']}}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                    </div>
                </div>
                <div class="col-md-6"></div>
            </div>
            <div class="container">
                <div class="row">
                    <div class="col-md-4" id="fillingJobBook">
                        @if(session()->has('temp_jobAdded'))
                            <div class="alert alert-success">
                                {{ session()->get('temp_jobAdded') }}
                            </div>
                        @endif
                        @if(session()->has('temp_jobAdded_dgr'))
                            <div class="alert alert-danger">
                                {{ session()->get('temp_jobAdded_dgr') }}
                            </div>
                        @endif
                        <a id="edit_store_list" class="add_job_book_model" data-toggle="modal" data-target="#add_job_list_Modal" style="color: #3c763d">
                            <h4>+Add Job to JobBook</h4>
                        </a>
                        <hr>
                            <img src="{{URL::asset('/Media/Images/sicon.png')}}" class="img-responsive" id="iconMan">
                    </div>
                    <div class="modal fade" id="add_job_list_Modal" tabindex="-1" role="dialog" aria-labelledby="newsModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h3 class="modal-title" id="exampleModalLabel"><b>+Add-Job</b></h3>
                                    <hr>
                                </div>

                                <form action="/addTempJobList" method="post">
                                    <div class="modal-body">
                                        {{ csrf_field() }}
                                        <div class="form-group">
                                            <label for="job_desc">Stroke</label>
                                            <select name="job_desc" id="job_desc" class="form-control">
                                                @foreach($service_detaill as $row)
                                                    <option value="{{$row['service_name']}}">{{$row['service_name']}}</option>
                                                @endforeach
                                            </select>
                                            <label for="job_desc_count">Count</label>
                                            <input type="text" name="job_desc_count" class="form-control" required>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-primary">Add Job</button>
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Exit</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="section-header text-center">
                            <br>
                            <h3 class="title" id="Header"><b>Tempery Job Description</b></h3>
                        </div>
                        <div id="table-scroll" style="height:auto;overflow: auto">
                        <table class="table table-striped">
                            <thead>
                            <tr style="background-color: midnightblue;color: whitesmoke">
                                <th>Job Description</th>
                                <th>Cost</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($job_book_temp_details as $row)
                                <tr style="background-color: whitesmoke;color: black">
                                    <td>{{$row['job_desc']}}</td>
                                    <td>{{$row['cost']}}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        </div>
                        <h3>Full Cost : Rs.{{$get_amount}}/=</h3>
                        @if(session()->has('transfer_job_detail'))
                            <div class="alert alert-success">
                                {{ session()->get('transfer_job_detail') }}
                            </div>
                        @endif
                        @if(session()->has('transfer_job_detail_dgr'))
                            <div class="alert alert-danger">
                                {{ session()->get('transfer_job_detail_dgr') }}
                            </div>
                        @endif
                        <hr>
                        <h3><b><u>Billing</u></b></h3>
                        <form action="/ToJobDesc" method="post">
                            {{ csrf_field() }}
                            <div class="form-group row">
                                <label for="tw_number" class="col-sm-3 col-form-label" id="label_item_reg">Three-Wheel Number</label>
                                <div class="col-sm-9">
                                    <input type="text" name="tw_number" class="form-control" required style="width: 150px;">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="tw_number" class="col-sm-3 col-form-label" id="label_item_reg">Service Type</label>
                                <div class="col-sm-9">
                                        <input type="radio" name="service" value="not_free">Not-Free
                                        <input type="radio" name="service" value="free">Free
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary" style="background-color: darkgreen">Collect</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="container-home" id="job_book_search">
            <br>
            <div class="container" id="job_book_search">
                <div class="row">
                    <div class="col-md-4"></div>
                    <div class="col-md-4">
                        <div class="section-header text-center">
                            <br>
                            <h3 class="title" id="Header"><b>Search Job Books</b></h3>
                        </div>
                            <form action="/job_book_search" method="POST" role="search">
                                {{ csrf_field() }}
                                <div class="form-group row">
                                    {{--<label for="item_name" class="col-sm-3 col-form-label" id="label_item_reg" style="color: black">Search JobBook</label>--}}
                                    <div class="col-sm-12">
                                        <input type="text" class="form-control" id="input_search_details" name="search" placeholder="Search by Name" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-3">
                                        <button type="submit" class="btn btn-primary" name="RegWorker">Search</button>
                                    </div>
                                    <div class="col=md-3"></div>
                                    <div class="col-sm-3">
                                        <button type="reset" class="btn btn-success">Clear</button>
                                    </div>
                                </div>
                            </form>
                    </div>
                    <div class="col-md-4"></div>
                </div>
            </div>
            <div class="container">
                <div class="col-md-6">
                    <div class="container" id="job_book_list">
                        @if(isset($details))
                            <p> The Search results for : <b> {{ $query }} </b></p>
                            <h2>Jobs Views</h2>
                            <hr>
                            @if(session()->has('message_bill_info'))
                                <div class="alert alert-success">
                                    {{ session()->get('message_bill_info') }}
                                </div>
                            @endif
                            @if(session()->has('message_bill_info_dgr'))
                                <div class="alert alert-danger">
                                    {{ session()->get('message_bill_info_dgr') }}
                                </div>
                            @endif
                            <div id="table-scroll" style="height: 500px;overflow: auto">
                            <table class="table table-striped">
                                <thead>
                                <tr style="background-color: midnightblue;color: whitesmoke">
                                    <th>Three-Wheel Number</th>
                                    <th>Owner NIC</th>
                                    <th>Jobs</th>
                                    <th>Job Date</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($details as $row)
                                    <tr style="background-color: whitesmoke;color: black">
                                        <td>{{$row['tw_number']}}</td>
                                        <td>{{$row['owner_nic']}}</td>
                                        <td>{{$row['job_desc']}}</td>
                                        <td>{{$row['job_desc_created_at']}}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            </div>
                        @endif
                    </div>
                </div>
                <div class="col-md-6"></div>
            </div>

            <div class="modal fade" id="create_job_book_Modal" tabindex="-1" role="dialog" aria-labelledby="newsModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h3 class="modal-title" id="exampleModalLabel"><b>Add-Job Book</b></h3>
                            <hr>
                        </div>

                        <form action="/createJobBook" method="post">
                            <div class="modal-body">
                                {{ csrf_field() }}
                                <div class="form-group">
                                    <label for="id">ThreeWheel Number</label>
                                    <textarea rows="1" cols="1" class="form-control" id="item_id_edit" name="tw_number" required></textarea>
                                    <label for="name">ThreeWheel Chasie Number</label>
                                    <textarea rows="1" cols="1" class="form-control" id="edit_item_name" name="tw_ch_number" required></textarea>
                                    <label for="name">ThreeWheel Engine Number</label>
                                    <textarea rows="1" cols="1" class="form-control" id="edit_item_code" name="tw_eng_number" required></textarea>
                                    <label for="name">Stork</label>
                                    <select name="stork" id="edit_item_store_price" class="form-control">
                                        <option value="4-Stork">4-Stork</option>
                                        <option value="2-Stork">2-Stork</option>
                                    </select>
                                    <label for="name">Name of Owner</label>
                                    <textarea rows="1" cols="1" class="form-control" id="edit_item_category" name="owner_name" required></textarea>
                                    <label for="name">NIC of Owner</label>
                                    <textarea rows="1" cols="1" class="form-control" id="edit_item_count" name="owner_nic"></textarea>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-primary">Add Job Book</button>
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Exit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
