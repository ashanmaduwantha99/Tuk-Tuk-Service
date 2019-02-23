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
    </style>
@endsection
@section('admin_js')
    <script>
        setTimeout(function () {
            window.location.href= 'http://127.0.0.1:8000/services_income'; // the redirect goes here

        },120000);
    </script>

    <script type="text/javascript">
        $(document).on("click",".add_job_book_model",function () {
            var item_id =$(this).data('item_id');
            var item_name = $(this).data('item_name');
            var item_code =$(this).data('item_code');
            var item_category = $(this).data('item_category');
            var item_count =$(this).data('item_count');
            var item_store_price = $(this).data('item_store_price');
            var item_sale_price =$(this).data('item_sale_price');

            $(".modal-body #item_id_edit").html(item_id);
            $(".modal-body #edit_item_name").html(item_name);
            $(".modal-body #edit_item_code").html(item_code);
            $(".modal-body #edit_item_category").html(item_category);
            $(".modal-body #edit_item_count").html(item_count);
            $(".modal-body #edit_item_store_price").html(item_store_price);
            $(".modal-body #edit_item_sale_price").html(item_sale_price);
        });
    </script>
    <script type="text/javascript">
        $(document).on("click",".open_store_list_model",function () {
            var owner_nic =$(this).data('owner_nic');
            var tw_number = $(this).data('tw_number');
            var job_desc =$(this).data('item_code');

            $(".modal-body #owner_nic").html(owner_nic);
            $(".modal-body #tw_number").html(tw_number);
            $(".modal-body #job_desc").html(job_desc);
        });
    </script>
@endsection
@section('title') Job Book @endsection
@section('body')
    <div class="content-wrapper" id="job_book_content">
        <div class="container-home" id="job_book_view">
            <div class="container">
                <div class="col-md-6">
                    <div class="container" id="job_book_view_table">
                        <h2>Income From Service</h2>
                        <hr>
                        <table class="table table-striped">
                            <thead>
                            <tr style="background-color: midnightblue;color: whitesmoke">
                                <th>Description</th>
                                <th>Cost</th>
                                <th>Date</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($service_list_detail as $row)
                                <tr style="background-color: whitesmoke;color: black">
                                    <td>{{$row['description']}}</td>
                                    <td>{{$row['amount']}}</td>
                                    <td>{{$row['income_date']}}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="col-md-6">

                </div>
            </div>
            <div class="container">
                <div class="col-md-12">
                    <h2>Upcoming Income From Service</h2>

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
                    <table class="table table-striped">
                        <thead>
                        <tr style="background-color: midnightblue;color: whitesmoke">
                            <th>Three-Wheel Number</th>
                            <th>Three-Wheel Chassis Number</th>
                            <th>Three-Wheel Engine Number</th>
                            <th>Stork</th>
                            <th>Owner NIC</th>
                            <th>Owner Name</th>
                            <th>Job Description</th>
                            <th>Cost</th>
                            <th>Service Date</th>
                            <th>Payment</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($upcome_income_service_list_detail as $row)
                            <tr style="background-color: whitesmoke;color: black">
                                <td>{{$row['tw_number']}}</td>
                                <td>{{$row['tw_ch_number']}}</td>
                                <td>{{$row['tw_eng_number']}}</td>
                                <td>{{$row['stork']}}</td>
                                <td>{{$row['owner_nic']}}</td>
                                <td>{{$row['owner_name']}}</td>
                                <td>{{$row['job_desc']}}</td>
                                <td>{{$row['cost']}}</td>
                                <td>{{$row['upcome_income_created_at']}}</td>
                                <td>
                                    <form action="/gotCheck" method="post">
                                        {{ csrf_field() }}
                                        <input type="hidden" value="{{$row['tw_number']}}" name="tw_number">
                                        <input type="hidden" value="{{$row['job_desc']}}" name="job_desc">
                                        <input type="hidden" value="{{$row['cost']}}" name="cost">
                                        <button type="submit" class="btn btn-primary" style="background-color: dodgerblue">Recieved</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
@endsection
