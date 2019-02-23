@extends('Layouts.UsersLayout')
@section('usercss')
    <style>
        #about{
            background-image: url("../Media/Images/1.jpg");
            background-positon:50% 50%;
            background-repeat:no-repeat;
            background-size:cover;
            opacity: 0.9;
        }
        #logo{
            display: block;
            margin-left: auto;
            margin-right: auto;
            width: 50%;
        }
        #quote{
            display: block;
            margin-left: auto;
            margin-right: auto;
            width: 70%;
        }
        #sicon{
            display: block;
            margin-left: auto;
            margin-right: auto;
            width: 70%;
        }
        table {
            font-family: arial, sans-serif;
            border-collapse: collapse;
            width: 100%;
        }

        td, th {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }

        tr:nth-child(even) {
            background-color: #dddddd;
        }
    </style>
@endsection
@section('user_js')
    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.9/angular.min.js"></script>
@endsection
@section('title') Customer Home @endsection
@section('body')

<div class="container-home" id="firstContainerHome">
    <br><br><br>
    <div class="container">
        <div class="row">
            {{--<img src="{{URL::asset('/Media/Images/logot.png')}}" class="img-responsive" id="logo">--}}
        </div>
    </div>
</div>
<div class="container-home" id="reserve">
    <div class="container">
        <div class="row">
            <div class="col-md-6" >
                @if(session()->has('message'))
                    <div class="alert alert-success">
                        {{ session()->get('message') }}
                    </div>
                @endif
                @if(session()->has('message_dgr'))
                    <div class="alert alert-danger">
                        {{ session()->get('message_dgr') }}
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
                <div class="section-header text-center">
                    <br>
                    <h2 class="title" style="color:midnightblue"><b>Reserve Time</b></h2>
                    <hr>
                </div>
                    <h3><b>Tommarow({{$tomorrow}})</b> Current Numbers: {{$getnumberToString}}</h3>
                <form action="https://sandbox.payhere.lk/pay/checkout" method="post" id="ReserveForm" name="myForm">
                    {{ csrf_field() }}
                    <p><b>Notice</b>:</p><p style="color: red;">You have to pay Rs.500/= before reserve a date from online</p>
                    <input type="hidden" name="merchant_id" value="1212150">    <!-- Replace your Merchant ID -->
                    <input type="hidden" name="return_url" value="http://sample.com/return">
                    <input type="hidden" name="cancel_url" value="http://sample.com/cancel">
                    <input type="hidden" name="notify_url" value="http://sample.com/notify">
                    {{--<br><br>Item Details<br>--}}
                    <input type="hidden" name="order_id" value="ItemNo12345">
                    <input type="hidden" name="items" value="Door bell wireless"><br>
                    <input type="hidden" name="currency" value="LKR">
                    <input type="hidden" name="amount" value="500">
                    {{--<br><br>Customer Details<br>--}}
                    <input type="hidden" name="first_name" value="Saman">
                    <input type="hidden" name="last_name" value="Perera">
                    <input type="hidden" name="email" value="samanp@gmail.com">
                    <input type="hidden" name="phone" value="0771234567">
                    <input type="hidden" name="address" value="No.1, Galle Road">
                    <input type="hidden" name="city" value="Colombo">
                    <input type="hidden" name="country" value="Sri Lanka">
                    <div class="form-group row">
                        <label for="date" class="col-sm-3 col-form-label">Date</label>
                        <div class="col-sm-9">
                            {{--<input type="text" class="form-control" id="reserve_inputs" name="username" placeholder="Date" required>--}}
                            {{--<input type="text" class="form-control" id="reserve_inputs" name="tw_number" placeholder="Date" required>--}}
                            <input type="date" class="form-control" id="reserve_inputs" name="date" placeholder="Date" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-9">
                            <input type="hidden" class="form-control" id="reserve_inputs" name="number">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-6">
                            <button type="submit" class="btn btn-primary" name="RegWorker">Reserve</button>
                            <button type="reset" class="btn btn-success">Clear</button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-md-6">
                <h3><b>Personal Info</b></h3>
                <table>
                    @foreach($userData as $row)
                        <tr>
                            <td>Name</td>
                            <td>{{$row['name']}}</td>
                        </tr>
                        <tr>
                            <td>NIC</td>
                            <td>{{$row['nic']}}</td>
                        </tr>
                        <tr>
                            <td>Mobile Number</td>
                            <td>{{$row['mobile_number']}}</td>
                        </tr>
                        <tr>
                            <td>Email</td>
                            <td>{{$row['email']}}</td>
                        </tr>
                        <tr>
                            <td>Threewheel Number</td>
                            <td>{{$row['tw_number']}}</td>
                        </tr>
                        <tr>
                            <td>Threewheel Type</td>
                            <td>{{$row['tw_type']}}</td>
                        </tr>
                        <tr>
                            <td>Username</td>
                            <td>{{$row['username']}}</td>
                        </tr>
                    @endforeach
                </table>
            </div>
        </div>
    </div>
</div>
<div class="container-home" id="secondContainerHome">
    <div class="container">
        <div class="row">

            @foreach($userData as $data)
                <h2>{{$data['number']}}</h2>
            @endforeach
        </div>
    </div>
</div>
<div class="container-home" id="secondContainerHome">
    <div class="container">
        <div class="row">
            <h2>View Job Book</h2>
        </div>
    </div>
</div>
@endsection
