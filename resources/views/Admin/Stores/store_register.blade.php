@extends('Layouts.AdministrativeLayout')
@section('admin_css')
    <style>
        #store_registration{
            background-color: white;
        }
        #Header{
            color: black;
        }
        #input_item_details{
            background-color: transparent;
            color: black;
            border-color:black ;
        }
        #label_item_reg{
            color: cornflowerblue;
        }
        #option_reg_item{
            color: black;
        }
        #show_store_list_tr{
            color: cornflowerblue;
            border: 2px solid black;
        }
        #show_store_list_data_tr1{
            color: black;
            border: 2px solid black;
        }
        #show_store_book_tr{
            color: midnightblue;
            border: 2px solid black;
        }
        #show_store_book_data_tr{
            color: black;
            border: 2px solid black;
        }
    </style>
@endsection
@section('admin_js')
    <script>
        setTimeout(function () {
            window.location.href= 'http://127.0.0.1:8000/store_register'; // the redirect goes here

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
@section('title') Stores Management @endsection
@section('body')
    <div class="content-wrapper" id="main_div">
        <div class="container-home" id="store_registration">
            <div class="container">
                <div class="row">
                    <div class="col-md-4">
                        <hr>
                        {{--<form action="{{ route('import') }}" method="POST" enctype="multipart/form-data">--}}
                            {{--@csrf--}}
                            {{--<input type="file" name="file" class="form-control">--}}
                            {{--<br>--}}
                            {{--<button class="btn btn-success">Import User Data</button>--}}
                            {{--<a class="btn btn-warning" href="{{ route('export') }}">Export User Data</a>--}}
                        {{--</form>--}}
                        <form action="/import_store" method="post" enctype="multipart/form-data">
                            <div class="col-md-6">
                                {{csrf_field()}}
                                {{--<input type="file" name="imported-file"/>--}}
                                <input type="file" name="import_file" />
                            </div>
                            <div class="col-md-6">
                                <button class="btn btn-primary" type="submit">Import</button>
                            </div>
                        </form>
                        <hr>
                        <div class="section-header text-center">
                            <br>
                            <h3 class="title" id="Header"><b>Item Storing</b></h3>
                        </div>
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        @if(session()->has('store_message'))
                            <div class="alert alert-success">
                                {{ session()->get('store_message') }}
                            </div>
                        @endif
                        @if(session()->has('store_message_dgr'))
                            <div class="alert alert-danger">
                                {{ session()->get('store_message_dgr') }}
                            </div>
                        @endif
                        <form action="/storeRegister" method="post" id="StoreForm">
                            {{ csrf_field() }}
                            <div class="form-group row">
                                <label for="item_name" class="col-sm-3 col-form-label" id="label_item_reg">Item Name</label>
                                <div class="col-sm-9">
                                    <select id="input_item_details" class="form-control" name="item_name" required>
                                        <option selected id="option_reg_item">Set the Item Name</option>
                                        <option value="Break Washer" id="option_reg_item">Break Washer</option>
                                        <option value="Break Shoe 2T" id="option_reg_item">Break Shoe 2T</option>
                                        <option value="Break Shoe 4T" id="option_reg_item">Break Shoe 4T</option>
                                        <option value="Master Pump Washer" id="option_reg_item">Master Pump Washer</option>
                                        <option value="Pivot Pin 205C" id="option_reg_item">Pivot Pin 205C</option>
                                        <option value="Pivot Pin 175C" id="option_reg_item">Pivot Pin 175C</option>
                                        <option value="Bore FL" id="option_reg_item">Bore FL</option>
                                        <option value="Bore 205C" id="option_reg_item">Bore 205C</option>
                                        <option value="Bore 175C" id="option_reg_item">Bore 175C</option>
                                        <option value="Bore Padding" id="option_reg_item">Bore Padding</option>
                                        <option value="Bore Rubber" id="option_reg_item">Bore Rubber</option>
                                        <option value="Signal Bulb" id="option_reg_item">Signal Bulb</option>
                                        <option value="Parking Bulb" id="option_reg_item">Parking Bulb</option>
                                        <option value="Head Lamp 205C" id="option_reg_item">Head Lamp 205C</option>
                                        <option value="Head Lamp 175C" id="option_reg_item">Head Lamp 175C</option>
                                        <option value="Rear Tail Light" id="option_reg_item">Rear Tail Light</option>
                                        <option value="Filter FL" id="option_reg_item">Filter FL</option>
                                        <option value="Filter 175C" id="option_reg_item">Filter 175C</option>
                                        <option value="Filter 205C" id="option_reg_item">Filter 205C</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="item_code" class="col-sm-3 col-form-label" id="label_item_reg">Item Code</label>
                                <div class="col-sm-9">
                                    <select id="input_item_details" class="form-control" name="item_code" required>
                                        <option selected id="option_reg_item">Set the Item Code</option>
                                        <option value="BWasher" id="option_reg_item">BWasher</option>
                                        <option value="BS2T" id="option_reg_item">BS2T</option>
                                        <option value="BS4T" id="option_reg_item">BS4T</option>
                                        <option value="MPWasher" id="option_reg_item">MPWasher</option>
                                        <option value="PP205C" id="option_reg_item">PP205C</option>
                                        <option value="PP175C" id="option_reg_item">PP175C</option>
                                        <option value="BoreFL" id="option_reg_item">BoreFL</option>
                                        <option value="Bore205C" id="option_reg_item">Bore205C</option>
                                        <option value="Bore175C" id="option_reg_item">Bore175C</option>
                                        <option value="BPadding" id="option_reg_item">BPadding</option>
                                        <option value="BRubber" id="option_reg_item">BRubber</option>
                                        <option value="SBulb" id="option_reg_item">SBulb</option>
                                        <option value="PBulb" id="option_reg_item">PBulb</option>
                                        <option value="HLamp205C" id="option_reg_item">HLamp205C</option>
                                        <option value="HLamp175C" id="option_reg_item">HLamp175C</option>
                                        <option value="RTLight" id="option_reg_item">RTLight</option>
                                        <option value="FilterFL" id="option_reg_item">FilterFL</option>
                                        <option value="Filter175C" id="option_reg_item">Filter175C</option>
                                        <option value="Filter205C" id="option_reg_item">Filter205C</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="item_category" class="col-sm-3 col-form-label" id="label_item_reg">Item Category</label>
                                <div class="col-sm-9">
                                    <select id="input_item_details" class="form-control" name="item_category" required>
                                        <option selected id="option_reg_item">Set the Item Category</option>
                                        <option value="Break Washer" id="option_reg_item">Break Washer</option>
                                        <option value="Break Shoe" id="option_reg_item">Break Shoe</option>
                                        <option value="Master Pump Washer" id="option_reg_item">Master Pump Washer</option>
                                        <option value="Pivot Pin" id="option_reg_item">Pivot Pin</option>
                                        <option value="Bore" id="option_reg_item">Bore</option>
                                        <option value="Lamp" id="option_reg_item">Lamp</option>
                                        <option value="Filter" id="option_reg_item">Filter</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="item_count" class="col-sm-3 col-form-label" id="label_item_reg">Item Count</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="input_item_details" name="item_count" placeholder="Item Count" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="item_store_price" class="col-sm-3 col-form-label" id="label_item_reg">Item Store Price</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="input_item_details" name="item_store_price" placeholder="Item Store Price" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="item_sale_price" class="col-sm-3 col-form-label" id="label_item_reg">Item Sales Price</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="input_item_details" name="item_sale_price" placeholder="Item Sales Price" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-6">
                                    <button type="submit" class="btn btn-primary" name="RegWorker">Store</button>
                                    <button type="reset" class="btn btn-success">Clear</button>
                                </div>
                                <div class="col-sm-6">
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="col-md-8">
                        <div class="section-header text-center">
                            <br>
                            <h3 class="title" id="Header"><b>Store List View</b></h3>
                        </div>
                        <div id="table-wrapper" style="position: relative; border: 2px solid black">
                            @if(session()->has('message_update_store_list'))
                                <div class="alert alert-success">
                                    {{ session()->get('message_update_store_list') }}
                                </div>
                            @endif
                            @if(session()->has('message_update_store_list_dgr'))
                                <div class="alert alert-danger">
                                    {{ session()->get('message_update_store_list_dgr') }}
                                </div>
                            @endif

                            @if(session()->has('message_move_to_store'))
                                <div class="alert alert-success">
                                    {{ session()->get('message_move_to_store') }}
                                </div>
                            @endif
                            @if(session()->has('message_move_to_store_dgr'))
                                <div class="alert alert-danger">
                                    {{ session()->get('message_move_to_store_dgr') }}
                                </div>
                            @endif

                            <div id="table-scroll" style="height: 400px;overflow: auto">
                                <table class="table table-bordered">
                                    <tr id="show_store_list_tr">
                                        <th>Item Name</th>
                                        <th>Item Code</th>
                                        <th>Item Category</th>
                                        <th>Item Count</th>
                                        <th>Item Store Price</th>
                                        <th>Item Store Full Price</th>
                                        <th>Item Sale Price</th>
                                        <th>Update Detail</th>
                                        <th>Move To Store</th>
                                    </tr>
                                    @foreach($store_list_detail as $row)
                                        <tr id="show_store_list_data_tr1">
                                            <td>{{$row['item_name']}}</td>
                                            <td>{{$row['item_code']}}</td>
                                            <td>{{$row['item_category']}}</td>
                                            <td>{{$row['item_count']}}</td>
                                            <td>{{$row['item_store_price']}}</td>
                                            <td>{{$row['item_store_full_price']}}</td>
                                            <td>{{$row['item_sale_price']}}</td>
                                            <td>
                                                <form action="/updateStoreDetail" method="post">
                                                    <a id="edit_store_list" class="open_store_list_model" data-toggle="modal" data-target="#store_list_Modal"
                                                       data-item_id = "{{$row['item_id']}}"
                                                       data-item_name = "{{$row['item_name']}}"
                                                       data-item_code = "{{$row['item_code']}}"
                                                       data-item_category = "{{$row['item_category']}}"
                                                       data-item_count = "{{$row['item_count']}}"
                                                       data-item_store_price = "{{$row['item_store_price']}}"
                                                       data-item_sale_price = "{{$row['item_sale_price']}}"
                                                    >Edit
                                                    </a>
                                                </form>
                                            </td>
                                            <td>
                                                <form action="/moveToStore" method="post">
                                                    {{ csrf_field() }}
                                                    <div class="form-group row">
                                                        <div class="col-sm-6">
                                                            <input type="text" class="hidden" name="item_name" value="{{$row['item_name']}}">
                                                            <input type="text" class="hidden" name="item_code" value="{{$row['item_code']}}">
                                                            <input type="text" class="hidden" name="item_category" value="{{$row['item_category']}}">
                                                            <input type="text" class="hidden" name="item_count" value="{{$row['item_count']}}">
                                                            <input type="text" class="hidden" name="item_store_price" value="{{$row['item_store_price']}}">
                                                            <input type="text" class="hidden" name="item_store_full_price" value="{{$row['item_store_full_price']}}">
                                                            <input type="text" class="hidden" name="item_sale_price" value="{{$row['item_sale_price']}}">
                                                            <button type="submit" class="btn btn-primary" name="RegWorker">Check and Move</button>
                                                        </div>
                                                        <div class="col-sm-6">
                                                        </div>
                                                    </div>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </table>
                            </div>
                        </div>
                        <div class="modal fade" id="store_list_Modal" tabindex="-1" role="dialog" aria-labelledby="newsModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Update Store List</h5>
                                    </div>

                                    <form action="/edit_store_list" method="post">
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
                                                <textarea rows="1" cols="1" class="form-control" id="edit_item_store_price" name="item_store_price"></textarea>
                                                <label for="name">Item Sale Price</label>
                                                <textarea rows="1" cols="1" class="form-control" id="edit_item_sale_price" name="item_sale_price"></textarea>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="submit" class="btn btn-primary">Update</button>
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Exit</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <div class="section-header text-center">
                            <br>
                            <h3 class="title" id="Header"><b>Store Book View-Temporary</b></h3>
                        </div>
                        <div id="table-scroll" style="height: 200px;overflow: auto">
                            @if(session()->has('message_to_expense'))
                                <div class="alert alert-success">
                                    {{ session()->get('message_to_expense') }}
                                </div>
                            @endif
                            @if(session()->has('message_to_expense_dgr'))
                                <div class="alert alert-danger">
                                    {{ session()->get('message_to_expense_dgr') }}
                                </div>
                            @endif
                            <table class="table table-bordered">
                                <tr id="show_store_book_tr">
                                    <th>Description</th>
                                    <th>Full Amount</th>
                                    <th>Date</th>
                                    <th>To Expense</th>
                                </tr>
                                @foreach($store_book_detail as $row)
                                    <tr id="show_store_book_data_tr">
                                        <td>{{$row['description']}}</td>
                                        <td>{{$row['amount']}}</td>
                                        <td>{{$row['created_at']}}</td>
                                        <td>
                                            <form action="/ToExpense" method="post">
                                                {{ csrf_field() }}
                                                <div class="form-group row">
                                                    <div class="col-sm-6">
                                                        <button type="submit" class="btn btn-primary" name="ToExpense">To Expense</button>
                                                    </div>
                                                    <div class="col-sm-6">
                                                    </div>
                                                </div>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
