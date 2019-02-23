@extends('Layouts.AdministrativeLayout')
@section('admin_css')
    <style>
        #selling{
            background-color: white;
        }
        #selling_store{
            color: black;
        }
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
        #show_invoice_tr2{
            background-color: #4dc0b5;
        }
    </style>
@endsection
@section('admin_js')
    <script>
        setTimeout(function () {
            window.location.href= 'http://127.0.0.1:8000/store_search'; // the redirect goes here

        },120000);
    </script>
    <script type="text/javascript">
        $(document).on("click",".open_store_list_model",function () {
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
@endsection
@section('title') Selling @endsection
@section('body')
    <div class="content-wrapper" id="selling">
        <div class="container-home" id="selling">
            <br>
            <div class="container" id="searchStore">
                <div class="row">
                    <div class="col-md-3">
                        <div class="section-header text-center">
                            <br>
                            <h3 class="title" id="Header"><b>Store Search</b></h3>
                        </div>
                        <div id="table-wrapper" style="position: relative">
                            <form action="/store_search" method="POST" role="search">
                                {{ csrf_field() }}
                                <div class="form-group row">
                                    <label for="item_name" class="col-sm-3 col-form-label" id="label_item_reg" style="color: black">Search Items</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="input_search_details" name="search" placeholder="Search by Name or code" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-6">
                                        <button type="submit" class="btn btn-primary" name="RegWorker">Search</button>
                                    </div>
                                    <div class="col-sm-6">
                                        <button type="reset" class="btn btn-success">Clear</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="col-md-9">
                        <div class="section-header text-center">
                            <br>
                            <h3 class="title" id="Header"><b>Bill</b></h3>
                        </div>
                        <div id="table-wrapper" style="position: relative">
                            <div id="table-scroll" style="height: 200px;overflow: auto">
                                <table class="table table-bordered">
                                    <tr id="show_invoice_tr2">
                                        <th>Item Name</th>
                                        <th>Item Code</th>
                                        <th>Item Count</th>
                                        <th>Selling Price</th>
                                        <th>Description</th>
                                        <th>Cost</th>
                                        <th>Date</th>
                                    </tr>
                                    @foreach($invoice_details as $row)
                                        <tr id="show_invoice_tr">
                                            <td>{{$row['item_name']}}</td>
                                            <td>{{$row['item_code']}}</td>
                                            <td>{{$row['item_count']}}</td>
                                            <td>{{$row['item_sale_price']}}</td>
                                            <td>{{$row['invoice_desc']}}</td>
                                            <td>{{$row['cost']}}</td>
                                            <td>{{$row['created_at']}}</td>
                                        </tr>
                                    @endforeach
                                </table>
                            </div>
                        </div>
                        <form action="/offerBill" method="get">
                            {{ csrf_field() }}
                            {{--<input type="text" class="hidden" value="{{$row['item_code']}}" name="item_code">--}}
                            <button type="submit" class="btn btn-primary" style="width: 100px;">Bill</button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="container" id="selling_store">
                @if(isset($details))
                    <p> The Search results for :<b> {{ $query }} </b></p>
                    <h2>Store View</h2>
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
                    <table class="table table-striped">
                        <thead>
                        <tr style="background-color: midnightblue;color: whitesmoke">
                            <th>Item Name</th>
                            <th>Item Code</th>
                            <th>Item Category</th>
                            <th>Item Count</th>
                            <th>Item Store Price</th>
                            <th>Item Sell Price</th>
                            <th>Buy</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($details as $row)
                            <tr style="background-color: whitesmoke;color: black">
                                <td>{{$row['item_name']}}</td>
                                <td>{{$row['item_code']}}</td>
                                <td>{{$row['item_category']}}</td>
                                <td>{{$row['item_count']}}</td>
                                <td>{{$row['item_store_price']}}</td>
                                <td>{{$row['item_sale_price']}}</td>
                                <td>
                                    <a id="edit_store_list" class="open_store_list_model" data-toggle="modal" data-target="#store_list_Modal"
                                       data-item_id = "{{$row['item_id']}}"
                                       data-item_name = "{{$row['item_name']}}"
                                       data-item_code = "{{$row['item_code']}}"
                                       data-item_category = "{{$row['item_category']}}"
                                       data-item_count = "{{$row['item_count']}}"
                                       data-item_store_price = "{{$row['item_store_price']}}"
                                       data-item_sale_price = "{{$row['item_sale_price']}}"
                                    >Bill
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                @endif
            </div>
            <div class="modal fade" id="store_list_Modal" tabindex="-1" role="dialog" aria-labelledby="newsModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Bill Info</h5>
                        </div>

                        <form action="/add_to_bill" method="post">
                            <div class="modal-body">
                                {{ csrf_field() }}
                                <div class="form-group">
                                    <label for="id">Item ID</label>
                                    <textarea rows="1" cols="1" class="form-control" id="item_id_edit" name="item_id" readonly></textarea>
                                    <label for="name">Item Name</label>
                                    <textarea rows="1" cols="1" class="form-control" id="edit_item_name" name="item_name" readonly></textarea>
                                    <label for="name">Item Code</label>
                                    <textarea rows="1" cols="1" class="form-control" id="edit_item_code" name="item_code" readonly></textarea>
                                    <label for="name">Item Category</label>
                                    <textarea rows="1" cols="1" class="form-control" id="edit_item_category" name="item_category" readonly></textarea>
                                    <label for="name">Item Count</label>
                                    <textarea rows="1" cols="1" class="form-control" id="edit_item_count" name="item_count"></textarea>
                                    <label for="name">Item Store Price</label>
                                    <textarea rows="1" cols="1" class="form-control" id="edit_item_store_price" name="item_store_price" readonly></textarea>
                                    <label for="name">Item Sale Price</label>
                                    <textarea rows="1" cols="1" class="form-control" id="edit_item_sale_price" name="item_sale_price" readonly></textarea>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-primary">Bill</button>
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Exit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
