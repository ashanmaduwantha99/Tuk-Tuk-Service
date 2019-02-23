@extends('Layouts.AdministrativeLayout')
@section('admin_css')
    <style>
        #Header{
            color: black;
        }
        #input_item_details{
            background-color: transparent;
            color: black;
            border-color: black;
        }
        #label_item_reg{
            color: black;
        }
        #option_reg_item{
            color: black;
        }
        #show_store_tr{
            color: #00aced;
            border: 2px solid black;
        }
        #show_store_data_tr{
            color: black;
            border: 2px solid black;
        }
        #returnItem{
            background-color: white;
        }
    </style>
@endsection
@section('admin_js')
    <script>
        setTimeout(function () {
            window.location.href= 'http://127.0.0.1:8000/store_return'; // the redirect goes here

        },120000);
    </script>

    {{--<script type="text/javascript">--}}
        {{--$(document).on("click",".open_store_list_model",function () {--}}
            {{--var item_id =$(this).data('item_id');--}}
            {{--var item_name = $(this).data('item_name');--}}
            {{--var item_code =$(this).data('item_code');--}}
            {{--var item_category = $(this).data('item_category');--}}
            {{--var item_count =$(this).data('item_count');--}}
            {{--var item_store_price = $(this).data('item_store_price');--}}
            {{--var item_sale_price =$(this).data('item_sale_price');--}}

            {{--$(".modal-body #item_id_edit").html(item_id);--}}
            {{--$(".modal-body #edit_item_name").html(item_name);--}}
            {{--$(".modal-body #edit_item_code").html(item_code);--}}
            {{--$(".modal-body #edit_item_category").html(item_category);--}}
            {{--$(".modal-body #edit_item_count").html(item_count);--}}
            {{--$(".modal-body #edit_item_store_price").html(item_store_price);--}}
            {{--$(".modal-body #edit_item_sale_price").html(item_sale_price);--}}
        {{--});--}}
    {{--</script>--}}
@endsection
@section('title') Stores @endsection
@section('body')
    <div class="content-wrapper" id="main_div">
        <div class="container-home" id="returnItem">
            <div class="container">
                <div class="row">
                    <div class="col-md-6">
                        <div class="section-header text-center">
                            <br>
                            <h3 class="title" id="Header"><b>Item Return</b></h3>
                        </div>
                        @if(session()->has('store_return_message'))
                            <div class="alert alert-success">
                                {{ session()->get('store_return_message') }}
                            </div>
                        @endif
                        @if(session()->has('store_return_messagedgr'))
                            <div class="alert alert-danger">
                                {{ session()->get('store_return_messagedgr') }}
                            </div>
                        @endif
                        <form action="/storeReturn" method="post" id="StoreReturnForm">
                            {{ csrf_field() }}
                            <div class="form-group row">
                                <label for="item_code" class="col-sm-3 col-form-label" id="label_item_reg">Item Code</label>
                                <div class="col-sm-9">
                                    <select id="input_item_details" class="form-control" name="item_code" required>
                                        <option selected id="option_reg_item">Set the Item Code</option>
                                        @foreach($store_item_code as $row)
                                        <option value="{{$row['item_code']}}" id="option_reg_item">{{$row['item_code']}}</option>
                                        @endforeach
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
                                <label for="item_code" class="col-sm-3 col-form-label" id="label_item_reg">Type</label>
                                <div class="col-sm-9">
                                    <select id="input_item_details" class="form-control" name="type" required>
                                        <option selected id="option_reg_item">Set the Type</option>
                                        <option value="returned" id="option_reg_item">Return</option>
                                        <option value="damaged" id="option_reg_item">Damaged</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-6">
                                    <button type="submit" class="btn btn-primary" name="RegWorker">Store Return</button>
                                    <button type="reset" class="btn btn-success">Clear</button>
                                </div>
                                <div class="col-sm-6">
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="col-md-6">
                        <div class="section-header text-center">
                            <br>
                            <h3 class="title" id="Header"><b>Return Stored Book - Damaged Items</b></h3>
                        </div>
                        @if(session()->has('message_return'))
                            <div class="alert alert-success">
                                {{ session()->get('message_return') }}
                            </div>
                        @endif
                        <div id="table-wrapper" style="position: relative">
                            <div id="table-scroll" style="height: 400px;overflow: auto">
                                <table class="table table-bordered">
                                    <tr id="show_store_tr">
                                        <th>Description</th>
                                        <th>Count</th>
                                        <th>Amount</th>
                                        <th>Restore Store</th>
                                        <th>Restore Cash</th>
                                    </tr>
                                    @foreach($return_store_detail as $row)
                                        <tr id="show_store_data_tr">
                                            <td>{{$row['item_code']}}</td>
                                            <td>{{$row['item_count']}}</td>
                                            <td>{{$row['value']}}</td>
                                            <td>
                                                <form action="/Restore_Return" method="post">
                                                    {{ csrf_field() }}
                                                    <div class="form-group row">
                                                        <div class="col-sm-6">
                                                            <input type="text" value="{{$row['item_code']}}" name="item_code" class="hidden">
                                                            <input type="text" value="{{$row['item_count']}}" name="item_count" class="hidden">
                                                            <input type="text" value="{{$row['value']}}" name="restore_value" class="hidden">
                                                            <button type="submit" class="btn btn-primary" name="Restore_Return">Restore Store</button>
                                                        </div>
                                                        <div class="col-sm-6">
                                                        </div>
                                                    </div>
                                                </form>
                                            </td>
                                            <td>
                                                <form action="/Restore_Cash" method="post">
                                                    {{ csrf_field() }}
                                                    <div class="form-group row">
                                                        <div class="col-sm-6">
                                                            <input type="text" value="{{$row['item_code']}}" name="item_code" class="hidden">
                                                            <input type="text" value="{{$row['item_count']}}" name="item_count" class="hidden">
                                                            <input type="text" value="{{$row['value']}}" name="restore_value" class="hidden">
                                                            <button type="submit" class="btn btn-primary" name="Restore_Return">Restore Cash</button>
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
    </div>

@endsection
