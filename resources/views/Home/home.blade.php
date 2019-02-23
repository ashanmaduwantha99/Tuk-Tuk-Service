@extends('Layouts.HomeLayout')
@section('homecss')
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('css/courosel.css') }}">
    <style>
        #about{
            background-image: url("../Media/Images/1.jpg");
            background-positon:50% 50%;
            background-attachment:fixed;
            background-repeat:no-repeat;
            background-size:cover;
            opacity: 0.9;
        }
        #logo{
            display: block;
            margin-left: auto;
            margin-right: auto;
            width: 45%;
        }
        #quote{
            display: block;
            margin-left: auto;
            margin-right: auto;
            width: 70%;
        }
        #serivece1{
            background-image: url("../Media/Images/2_2.jpg");
            /*background-color: #3d6983;*/
            background-positon:50% 50%;
            background-attachment:fixed;
            background-repeat:no-repeat;
            background-size:cover;
            opacity: 0.9;
        }
        #sp1{
            width:250px;
            height: 250px;
            border-color: #2a88bd;
        }
        #sp2{
            width:450px;
            height: 250px;
        }
        #reserve{
            background-image: url("../Media/Images/tw1.jpg");
            background-positon:50% 50%;
            background-attachment:fixed;
            background-repeat:no-repeat;
            background-size:cover;
            opacity: 0.9;
        }
        #sicon{
            display: block;
            margin-left: auto;
            margin-right: auto;
            width: 40%;
        }
        sicon2{
            display: block;
            margin-left: auto;
            margin-right: auto;
            width: 20%;
        }
        #ReserveForm{
            width: 350px;
            color: #2ab27b;
        }
        #CommentForm{
            color: black;
            width: 350px;
        }
        #aboutus{
            background-image: url("../Media/Images/7_1.jpg");
            background-positon:50% 50%;
            background-attachment:fixed;
            background-repeat:no-repeat;
            background-size:cover;
            opacity: 0.9;
        }
        .carousel-content {
            color:black;
            display:flex;
            align-items:center;
            height: auto;
        }

        #text-carousel {
            width: 100%;
            height: 150px;
            padding: 20px;
        }
        #text-carousel_News{
            width: 100%;
            height: 100px;
            padding: 20px;
        }
        .carousel-contentNews {
            color:black;
            display:flex;
            align-items:center;
            height: auto;
        }
        #map {
            height: 250px;  /* The height is 400 pixels */
            width: 100%;  /* The width is the width of the web page */
        }
    </style>
@endsection
@section('js')
    <script>
        $(function ($) {

            /*-----------------------------------------------------------------*/
            /* ANIMATE SLIDER CAPTION
            /* Demo Scripts for Bootstrap Carousel and Animate.css article on SitePoint by Maria Antonietta Perna
            /*-----------------------------------------------------------------*/
            "use strict";
            function doAnimations(elems) {
                //Cache the animationend event in a variable
                var animEndEv = 'webkitAnimationEnd animationend';
                elems.each(function () {
                    var $this = $(this),
                        $animationType = $this.data('animation');
                    $this.addClass($animationType).one(animEndEv, function () {
                        $this.removeClass($animationType);
                    });
                });
            }
            //Variables on page load
            var $immortalCarousel = $('.animate_text'),
                $firstAnimatingElems = $immortalCarousel.find('.item:first').find("[data-animation ^= 'animated']");
            //Initialize carousel
            $immortalCarousel.carousel();
            //Animate captions in first slide on page load
            doAnimations($firstAnimatingElems);
            //Other slides to be animated on carousel slide event
            $immortalCarousel.on('slide.bs.carousel', function (e) {
                var $animatingElems = $(e.relatedTarget).find("[data-animation ^= 'animated']");
                doAnimations($animatingElems);
            });



        })(jQuery);
    </script>
    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.9/angular.min.js"></script>
    <script>
        var map;
        function initMap() {
            map = new google.maps.Map(document.getElementById('map-canvas'), {
                center: {lat: 6.729343, lng: 80.029553},
                zoom: 8
            });
        }
    </script>
@endsection
@section('title') Home @endsection
@section('body')
    <!-- ----------boostrap courosel------------------->
    <div class="container-home" id="carouselDiv">
        <div class="container-home">
            <!-- ++++++++++++++++++++++++++ BOOTSTRAP CAROUSEL +++++++++++++++++++++++++++++ -->

            <div id="kb" class="carousel kb_elastic animate_text kb_wrapper" data-ride="carousel" data-interval="6000" data-pause="hover">

                <!--======= Wrapper for Slides =======-->
                <div class="carousel-inner" role="listbox">

                    <!--========= First Slide =========-->
                    <div class="item active">

                        <img src="{{URL::asset('/Media/Images/6.jpg')}}">
                        <div class="carousel-caption kb_caption">
                            <h1 data-animation="animated flipInX" id="slideCaption">Welcome</h1>
                            <h2 data-animation="animated flipInX" id="slideCaption2">Tuk-Tuk Service</h2>
                        </div>
                    </div>

                    <!--========= Second Slide =========-->
                    <div class="item">
                        <img src="{{URL::asset('/Media/Images/2.jpg')}}">
                        <div class="carousel-caption kb_caption kb_caption_right">
                            <h1 data-animation="animated flipInX" id="slideCaption">Tuk-Tuk Service</h1>
                            <h2 data-animation="animated flipInX">Best Threewheel Service providers</h2>
                        </div>
                    </div>

                    <!--========= Third Slide =========-->
                    <div class="item">
                        <img src="{{URL::asset('/Media/Images/3.jpg')}}">
                        <div class="carousel-caption kb_caption kb_caption_center">
                            <h1 data-animation="animated flipInX" id="slideCaption">Tuk-Tuk Service</h1>
                            <h2 data-animation="animated flipInX">Authorized By David Pieris Company</h2>
                        </div>
                    </div>

                </div>

                <!--======= Navigation Buttons =========-->

                <!--======= Left Button =========-->
                <a class="left carousel-control kb_control_left" href="#kb" role="button" data-slide="prev">
                    <span class="fa fa-angle-left kb_icons" aria-hidden="true" style="color: white"></span>
                    <span class="sr-only">Previous</span>
                </a>

                <!--======= Right Button =========-->
                <a class="right carousel-control kb_control_right" href="#kb" role="button" data-slide="next">
                    <span class="fa fa-angle-right kb_icons" aria-hidden="true" style="color: white"></span>
                    <span class="sr-only">Next</span>
                </a>

            </div> <!-- ++++++++++++++++++++++ END BOOTSTRAP CAROUSEL +++++++++++++++++++++++ -->

        </div>
    </div>
    <!-----------end boostrap courosel------------------->

    <div class="container-home" id="about">
        <br>
        @if(session()->has('account_created_msg'))
            <div class="alert alert-success">
                {{ session()->get('account_created_msg') }}
            </div>
        @endif
        @if(session()->has('account_created_msg_dgr'))
            <div class="alert alert-danger">
                {{ session()->get('account_created_msg_dgr') }}
            </div>
        @endif
        <img src="{{URL::asset('/Media/Images/logot.png')}}" class="img-responsive" id="logo">
        <hr style="solid-color: black">
        <div class="container">
            <img src="{{URL::asset('/Media/Images/quote.png')}}" class="img-responsive" id="quote">
        </div>
    </div>
    <div class="container-home" id="serivece1">
        <div class="container-fluid">
            <marquee>
                <p style="color: ghostwhite;font-size: 18px;">
                <?php foreach($news as $data) { ?>
                <?php echo $data->news;?>...
                 <?php } ?>
                </p>
            </marquee>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <br><br><br><br>
                    {{--<img src="{{URL::asset('/Media/Images/serviceme.png')}}" class="img-responsive" id="sp1">--}}
                </div>
                <div class="col-md-8">
                    <h2 style="color: lightskyblue"><b>Servicing and washing Threewheelers</b></h2>
                    <hr>
                    <p style="font-size: 16px;color: aliceblue">
                        Our activity is to wash and service both of Bajaj Two-stroke and Four-stroke
                        Three-wheelers and also you can cover your free-services of your brand new
                        Three-wheeler. Tuk-Tuk service is officially authorized by David Peiris and
                        do not need to think twice to bring your Three-wheelers to us.<br>
                        We can manage to service 8 both Two-stroke and Four-stroke Three-wheelers per day.
                        If you have a Free-Service option you must bring your free service card that offered by company.
                        Our service center will open at 6.00 a.m. We offer to you pre-reserve time & date through our
                        website. You can save your time by booking the time & date. Only you have to do is to bring your
                        vehicle between 7.00 a.m.-8.00 a.m. on the day
                        Reserve Time & Date click here.<b><a href="">click here</a>.</b>
                    </p>
                </div>
            </div>
            <div class="row">
                <div class="col-md-8">
                    <h2 style="color: cadetblue"><b>Original Spare Parts</b></h2>
                    <hr>
                    <p style="font-size: 16px;color: aliceblue">
                        You can buy Original Bajaj genuine parts and fixed them from our experienced technicians.<br>
                        If you fixed your spare parts from our service center we will give some discount to you
                        and<br> provide the best service to you.
                        <br>
                    </p>
                </div>
                <div class="col-md-4">
                    {{--<img src="{{URL::asset('/Media/Images/spareparts.png')}}" class="img-responsive" id="sp2">--}}
                </div>
            </div>
        </div>
    </div>
    <div class="container-home" id="reserve">
        <div class="container">
            <div class="row">
                <div class="section-header text-center">
                    <br>
                    <h2 class="title" style="color:lightblue"><b>Reserve Time</b></h2>
                    <hr>
                </div>
                <div class="col-md-6">
                    <h3 style="color: ghostwhite"><b>
                            You can reserve your time early from our web site.
                            For that at first you need to register in our web site,
                            then you can login and make a reservation to service
                            your threewheeler.
                            <br>
                        </b></h3>
                    <button type="submit" class="btn btn-primary" style="background-color: #00aced;"><a style="color: ghostwhite" href="{{ URL::asset('register') }}">SignUp</a></button>
                    <button type="submit" class="btn btn-primary" style="background-color: seagreen;"><a style="color: ghostwhite" href="{{ URL::asset('login') }}">Login</a></button>
                </div>
                <div class="col-md-6">
                    <img src="{{URL::asset('/Media/Images/sicon.png')}}" class="img-responsive" id="sicon">
                </div>
            </div>

        </div>
        {{--<div class="container" ng-app="">--}}
            {{--<div class="row">--}}
                {{--<div class="col-md-6" >--}}
                    {{--@if(session()->has('message'))--}}
                        {{--<div class="alert alert-success">--}}
                            {{--{{ session()->get('message') }}--}}
                        {{--</div>--}}
                    {{--@endif--}}
                    {{--@if(session()->has('message_dgr'))--}}
                        {{--<div class="alert alert-danger">--}}
                            {{--{{ session()->get('message_dgr') }}--}}
                        {{--</div>--}}
                    {{--@endif--}}
                     {{--@if ($errors->any())--}}
                            {{--<div class="alert alert-danger">--}}
                                {{--<ul>--}}
                                    {{--@foreach ($errors->all() as $error)--}}
                                        {{--<li>{{ $error }}</li>--}}
                                    {{--@endforeach--}}
                                {{--</ul>--}}
                            {{--</div>--}}
                      {{--@endif--}}
                    {{--<div class="section-header text-center">--}}
                        {{--<br>--}}
                        {{--<h2 class="title" style="color:lightblue"><b>Reserve Time</b></h2>--}}
                        {{--<hr>--}}
                    {{--</div>--}}

                    {{--<form action="/reservation" method="post" id="ReserveForm" name="myForm">--}}
                        {{--{{ csrf_field() }}--}}
                        {{--<div class="form-group row">--}}
                            {{--<label for="name" class="col-sm-3 col-form-label">Name</label>--}}
                            {{--<div class="col-sm-9">--}}
                                {{--<input type="text" class="form-control" name="name" id="reserve_inputs" placeholder="Name" required>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                        {{--<div class="form-group row">--}}
                            {{--<label for="mobile_number" class="col-sm-3 col-form-label">Mobile Number</label>--}}
                            {{--<div class="col-sm-9">--}}
                                {{--<input type="text" class="form-control" id="reserve_inputs" name="mobile_number" placeholder="Mobile Number" required>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                        {{--<div class="form-group row">--}}
                            {{--<label for="nic" class="col-sm-3 col-form-label">NIC</label>--}}
                            {{--<div class="col-sm-9">--}}
                                {{--<input type="text" class="form-control" id="reserve_inputs" name="nic" placeholder="NIC" ng-model="nic" ng-minlength="10" ng-maxlength="11" required>--}}
                                {{--<span style="color:white" ng-if="!myForm.nic.$valid">Please Enter Valid NIC number</span>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                        {{--<div class="form-group row">--}}
                            {{--<label for="threewheelnumber" class="col-sm-3 col-form-label">ThreeWheel Number</label>--}}
                            {{--<div class="col-sm-9">--}}
                                {{--<input type="text" class="form-control" id="reserve_inputs" name="tw_number" placeholder="Threewheeler Number" >--}}
                            {{--</div>--}}
                        {{--</div>--}}
                        {{--<div class="form-group row">--}}
                            {{--<label for="date" class="col-sm-3 col-form-label">Date</label>--}}
                            {{--<div class="col-sm-9">--}}
                                {{--<input type="date" class="form-control" id="reserve_inputs" name="date" placeholder="Date" required>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                        {{--<div class="form-group row">--}}
                            {{--<label for="role" class="col-sm-3 col-form-label">Type</label>--}}
                            {{--<div class="col-sm-9">--}}
                                {{--<select id="reserve_inputs" class="form-control" name="type" required>--}}
                                    {{--<option value="two_stork">2-Stork</option>--}}
                                    {{--<option value="four_stork">4-Stork</option>--}}
                                {{--</select>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                        {{--<div class="form-group row">--}}
                            {{--<div class="col-sm-9">--}}
                                {{--<input type="hidden" class="form-control" id="reserve_inputs" name="number">--}}
                            {{--</div>--}}
                        {{--</div>--}}
                        {{--<div class="form-group row">--}}
                            {{--<div class="col-sm-6">--}}
                                {{--<button type="submit" class="btn btn-primary" name="RegWorker">Reserve</button>--}}
                            {{--</div>--}}
                            {{--<div class="col-sm-6">--}}
                                {{--<button type="reset" class="btn btn-success">Clear</button>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                    {{--</form>--}}
                {{--</div>--}}
                {{--<div class="col-md-6">--}}
                    {{--<img src="{{URL::asset('/Media/Images/sicon.png')}}" class="img-responsive" id="sicon">--}}
                {{--</div>--}}
            {{--</div>--}}
        {{--</div>--}}
    </div>
    <div class="container-home" id="aboutus">
        <div class="container">
            <br>
            <div class="row">
                <div class="section-header text-center">
                    <br>
                    <h2 class="title" style="color:lightblue"><b>Comments</b></h2>
                    <hr>
                    <p style="font-size: 16px; text-align: justify;color: lightskyblue">
                        We are glad to have your comment about us whether it is good or bad and<br>
                        we would like to improve more features if you need. So please<br>
                        add your comment here and let us know your ideas.<br>
                    </p>
                </div>
                <div class="col-md-4">
                    <img src="{{URL::asset('/Media/Images/comments.png')}}" class="img-responsive" id="sicon2" width="250px">
                </div>
                <div class="col-md-4">

                </div>
                <div class="col-md-4">
                    @if(session()->has('message_comment'))
                        <div class="alert alert-success">
                            {{ session()->get('message_comment') }}
                        </div>
                    @endif
                    @if(session()->has('message_comment_dgr'))
                        <div class="alert alert-danger">
                            {{ session()->get('message_comment_dgr') }}
                        </div>
                    @endif
                    <h4 style="color: white"><b>Add your Comment Here</b></h4>
                    <form action="/comment" method="post" id="CommentForm">
                        {{ csrf_field() }}
                        <div class="form-group row">
                            <label for="name" class="col-sm-3 col-form-label">Name</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="name" id="input_comments" placeholder="Name" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="mobile_number" class="col-sm-3 col-form-label">Comment</label>
                            <div class="col-sm-9">
                                <textarea class="form-control" name="comment" id="input_comments" placeholder="Comments">
                                </textarea>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-6">
                                <button type="submit" class="btn btn-primary" name="CommentBtn">Comment</button>
                            </div>
                            <div class="col-sm-6">
                                <button type="reset" class="btn btn-success">Clear</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <hr>
            <div class="row" id="commentCourosel">
                <h2 style="font-size: x-large;color: floralwhite;text-align: center"><b><u>Comments from Customers</u></b></h2>

                <div id="text-carousel" class="carousel slide" data-ride="carousel">
                    <!-- Wrapper for slides -->
                    <div class="row">
                        <div class="col-xs-offset-3 col-xs-6">
                            <div class="carousel-inner">
                                <div class="item active">
                                    <div class="carousel-content">
                                        <div>
                                            <p style="font-size: x-large; color: whitesmoke">I've got a best service from Tuk-Tuk Service<br>- Ashan</p>
                                        </div>
                                    </div>
                                </div>

                                <?php foreach($comments as $data) { ?>
                                <div class="item">
                                    <div class="carousel-content">
                                        <div>
                                            <p style="font-size: x-large; color: whitesmoke">
                                                <?php echo $data->comment;?>
                                                <br> - <?php echo $data->name;?>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <?php } ?>
                            </div>
                        </div>
                    </div>

                    <!-- Controls -->
                    <a class="left carousel-control" href="#text-carousel" data-slide="prev">
                        <span class="glyphicon glyphicon-chevron-left"></span>
                    </a>
                    <a class="right carousel-control" href="#text-carousel" data-slide="next">
                        <span class="glyphicon glyphicon-chevron-right"></span>
                    </a>

                </div>
            </div>
            {{--<img src="{{URL::asset('/Media/Images/lineimg.png')}}" class="img-responsive" id="lineimg">--}}
            <div class="row">
                <div class="col-md-4">
                    <br><br>
                    <div id="map"></div>
                    <script>
                        // Initialize and add the map
                        function initMap() {
                            // The location of Uluru
                            var uluru = {lat: 6.729343, lng: 80.029553};
                            // The map, centered at Uluru
                            var map = new google.maps.Map(
                                document.getElementById('map'), {zoom: 15, center: uluru});
                            // The marker, positioned at Uluru
                            var marker = new google.maps.Marker({position: uluru, map: map});
                        }
                    </script>
                    <!--Load the API from the specified URL
                    * The async attribute allows the browser to render the page while the API loads
                    * The key parameter will contain your own API key (which is not needed for this tutorial)
                    * The callback parameter executes the initMap() function
                    -->
                    <script async defer
                            src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAYtsgpgVc4YdOlcTmjDP_z6pteXbf7Zd0&callback=initMap">
                    </script>
                </div>
                <div class="col-md-8">
                    <div class="section-header text-center">
                        <br>
                        <h2 class="title" style="color:black" id="about_us_link"><b>About Us</b></h2>
                        <hr>
                        <p style="font-size: 16px; color: floralwhite;text-align: justify">
                            We are "Tuk-Tuk Serivice" which is authorizable company from David Peiris Company
                            to Service and Sell original genuin spare parts of Bajaj Two-Stork and Bajaj Four-Stork
                            Threewheelers. In our service center you can service your threewheeler or you can buy original
                            spare parts from us.
                            <br>
                            We provide our service to customers since 2000. From now we would be happy to say
                            we are the leading, and trending number one service center from all the other
                            Bjaj threewheel service center.
                            <br>
                        <h4 style="color: dodgerblue"><b>Thank you !</b> for watching our website.</h4>
                        </p>
                    </div>
                </div>


            </div>
        </div>
    </div>
@endsection
