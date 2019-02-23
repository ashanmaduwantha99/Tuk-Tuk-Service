@extends('Layouts.AdministrativeLayout')
@section('admin_css')
    <style>
        #Header{
            color: black;
        }
        #show_store_tr{
            color: black;
            border: 2px solid black;
            background-color: #3d6983;
        }
        #show_store_data_tr{
            color: black;
            border: 2px solid black;
        }
        #store_view{
            background-color: white;
        }
    </style>
@endsection
@section('admin_js')
    <script>
        setTimeout(function () {
            window.location.href= 'http://127.0.0.1:8000/store_view'; // the redirect goes here

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
@section('title') Stores @endsection
@section('body')
    <div class="content-wrapper" id="main_div">
        <div class="container-home" id="store_view">
            <div class="container">
                <div class="row">
                    <div class="section-header text-center">
                        <br>
                        <h3 class="title" id="Header"><b>Store View</b></h3>
                    </div>
                    <div id="table-wrapper" style="position: relative">
                        <div id="table-scroll" style="height: 660px;overflow: auto">
                            <table class="table table-bordered">
                                <tr id="show_store_tr">
                                    <th>Item Name</th>
                                    <th>Item Code</th>
                                    <th>Item Category</th>
                                    <th>Item Count</th>
                                    <th>Item Store Price</th>
                                    <th>Item Store Full Price</th>
                                    <th>Item Sale Price</th>
                                </tr>
                                @foreach($store_detail as $row)
                                    <tr id="show_store_data_tr">
                                        <td>{{$row['item_name']}}</td>
                                        <td>{{$row['item_code']}}</td>
                                        <td>{{$row['item_category']}}</td>
                                        <td>{{$row['item_count']}}</td>
                                        <td>{{$row['item_store_price']}}</td>
                                        <td>{{$row['item_store_full_price']}}</td>
                                        <td>{{$row['item_sale_price']}}</td>
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
