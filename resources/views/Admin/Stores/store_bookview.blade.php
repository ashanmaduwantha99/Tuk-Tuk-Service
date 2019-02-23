@extends('Layouts.AdministrativeLayout')
@section('admin_css')
    <style>
        #Header{
            color: black;
        }
        #show_store_tr{
            color: black;
            background-color: #2a88bd;
            border: 2px solid black;
        }
        #show_store_data_tr{
            color: black;
            border: 2px solid black;
        }
        #store_book_tts{
            background-color: white;
        }
    </style>
@endsection
@section('admin_js')
    <script>
        setTimeout(function () {
            window.location.href= 'http://127.0.0.1:8000/store_bookview'; // the redirect goes here

        },120000);
    </script>
@endsection
@section('title') Stores @endsection
@section('body')
    <div class="content-wrapper" id="main_div">
        <div class="container-home" id="store_book_tts">
            <div class="container">
                <div class="row">
                    <div class="col-md-6">
                        <div class="section-header text-center">
                            <br>
                            <h3 class="title" id="Header"><b>Store Book of Company</b></h3>
                        </div>
                        <div id="table-wrapper" style="position: relative">
                            <div id="table-scroll" style="height: 400px;overflow: auto">
                                <table class="table table-bordered">
                                    <tr id="show_store_tr">
                                        <th>Description</th>
                                        <th>Amount</th>
                                        <th>Date</th>
                                    </tr>
                                    @foreach($store_book_detail_tts as $row)
                                        <tr id="show_store_data_tr">
                                            <td>{{$row['description']}}</td>
                                            <td>{{$row['amount']}}</td>
                                            <td>{{$row['created_at']}}</td>
                                        </tr>
                                    @endforeach
                                </table>
                            </div>
                        </div>
                        <div class="col-md-6"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
