<!doctype html>
<html lang="{{app()->getLocale()}}">
<head>
    <!-- include boostrap links-->
    @include('Includes.boostrap')
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('css/adminnav.css') }}">
    <script src="{{ URL::asset('js/navbar.js') }}"></script>

    <link rel='stylesheet' href='https://use.fontawesome.com/releases/v5.5.0/css/all.css' integrity='sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU' crossorigin='anonymous'>
    <!-- common css file to home-->
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('bower_components/bootstrap/dist/css/bootstrap.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('bower_components/font-awesome/css/font-awesome.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('bower_components/Ionicons/css/ionicons.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('dist/css/AdminLTE.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('dist/css/skins/_all-skins.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('bower_components/morris.js/morris.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('bower_components/jvectormap/jquery-jvectormap.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('bower_components/bootstrap-daterangepicker/daterangepicker.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css') }}">

    @yield('admin_css')
    @yield('admin_js')
    <title>@yield('title')</title>
</head>

<body class="hold-transition skin-blue sidebar-mini">

<header class="main-header">
    <!-- Logo -->
    <a href="#" class="logo" style="background-color: black">
        <!-- mini logo for sidebar mini 50x50 pixels -->
        <span class="logo-mini"><b>T</b>TS</span>
        <!-- logo for regular state and mobile devices -->
        <span class="logo-lg"><b>Admin</b>TTS</span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top" style="background-color: black">
        <!-- Sidebar toggle button-->
        <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
            <span class="sr-only">Toggle navigation</span>
        </a>

        <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
                <!-- Messages: style can be found in dropdown.less-->

                <!-- User Account: style can be found in dropdown.less -->
                <li class="dropdown user user-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <img src="{{URL::asset('/Media/Images/small_logo_160px.png')}}" class="user-image" alt="User Image">
                        <span class="hidden-xs">
                            {{Auth::user()->username}}
                            {{--@if (Auth::check())--}}
                            {{--{{Auth::user()->username}}--}}
                            {{--@else--}}
                            {{--<a href="{{ URL::asset('login') }}" id="navbar_link">Login</a>--}}
                            {{--{!! print_r("User is not login.") !!}--}}
                            {{--@endif--}}
                        </span>
                    </a>
                    <ul class="dropdown-menu">
                        <!-- User image -->
                        <li class="user-header">
                            <img src="{{URL::asset('/Media/Images/small_logo_160px.png')}}" class="img-circle" alt="User Image">

                            <p>
                                Admin -Tuk-Tuk Service(PVT).LTD
                            </p>
                        </li>
                        <!-- Menu Body -->
                    {{--<li class="user-body">--}}
                    {{--<div class="row">--}}
                    {{--<div class="col-xs-4 text-center">--}}
                    {{--<a href="#">Followers</a>--}}
                    {{--</div>--}}
                    {{--<div class="col-xs-4 text-center">--}}
                    {{--<a href="#">Sales</a>--}}
                    {{--</div>--}}
                    {{--<div class="col-xs-4 text-center">--}}
                    {{--<a href="#">Friends</a>--}}
                    {{--</div>--}}
                    {{--</div>--}}
                    {{--<!-- /.row -->--}}
                    {{--</li>--}}
                    <!-- Menu Footer-->
                        <li class="user-footer">
                            <div class="pull-left">
                                <a href="#" class="btn btn-default btn-flat"><i class="fa fa-gears"></i> Settings</a>
                            </div>
                            <div class="pull-right">
                                <a href="{{ URL::asset('logout') }}" class="btn btn-default btn-flat">Log out</a>
                            </div>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>
</header>
<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar" style="background-color: black">
        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="{{URL::asset('/Media/Images/small_logo_160px.png')}}" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
                <p>Tuk-Tuk Service</p>
                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>

        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu" data-widget="tree" id="sidebar_height">
            <li class="header">Menu</li>
            <li class="active treeview">
                <a href="{{ URL::asset('dashboard')}}">
                    <i class="fa fa-dashboard"></i> <span>Dashboard</span>
                    <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
                </a>
                <ul class="treeview-menu">
                    <li class="active"><a href="{{ URL::asset('dashboard')}}"><i class="fa fa-circle-o"></i> Dashboard</a></li>
                </ul>
            </li>

            <li class="treeview">
                <a href="{{ URL::asset('worker_attendance')}}">
                    <i class="far fa-id-card"></i>
                    <span>Employee Attendance</span>
                    <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{{ URL::asset('worker_attendance#attForm')}}"><i class="fa fa-circle-o"></i> Mark Attendance</a></li>
                    <li><a href="{{ URL::asset('worker_attendance#attedanceView')}}"><i class="fa fa-circle-o"></i>View Attendance</a></li>
                    <li><a href="{{ URL::asset('worker_attendance#attendance_present_count')}}"><i class="fa fa-circle-o"></i>  Attendance Percentage</a></li>
                    <li><a href="{{ URL::asset('worker_attendance_history')}}"><i class="fa fa-circle-o"></i> Attendance History</a></li>
                </ul>
            </li>
            <li class="treeview">
                <a href="{{ URL::asset('workers')}}">
                    <i class="fas fa-user-cog"></i>
                    <span>Employees</span>
                    <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{{ URL::asset('worker_registration#RegisterForm')}}"><i class="fas fa-users"></i> Employees' Registration</a></li>
                    <li><a href="{{ URL::asset('worker_registration#show_workers')}}"><i class="fas fa-user-plus"></i> View Employees</a></li>
                </ul>
            </li>
            <li class="treeview">
                <a href="{{ URL::asset('workers_salary')}}">
                    <i class="fab fa-amazon-pay"></i>
                    <span>Employees' Salary</span>
                    <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{{ URL::asset('workers_salary')}}"><i class="fa fa-circle-o"></i>Calculate Salary</a></li>
                    <li><a href="{{ URL::asset('workers_salary#salary_sheet_update')}}"><i class="fab fa-cc-amazon-pay"></i> Pay Salary</a></li>
                    <li><a href="{{ URL::asset('workers_epfetf')}}"><i class="fa fa-circle-o"></i>View EPF/ETF</a></li>
                    <li><a href="{{ URL::asset('workers_payement_history')}}"><i class="fa fa-circle-o"></i> Payment History</a></li>
                    <li><a href="{{ URL::asset('workers_salary_update')}}"><i class="fa fa-circle-o"></i> Employees' Salary Update</a></li>
                    <li><a href="{{ URL::asset('workers_salary_update')}}"><i class="fas fa-handshake"></i> Employees' Bonus Update</a></li>
                </ul>

            </li>

            <li class="treeview">
                <a href="#">
                    <i class="fa fa-pie-chart"></i>
                    <span>Stores</span>
                    <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{{ URL::asset('store_register')}}"><i class="fa fa-circle-o"></i> Store Registration</a></li>
                    <li><a href="{{ URL::asset('store_view')}}"><i class="fa fa-circle-o"></i> View Store</a></li>
                    <li><a href="{{ URL::asset('store_bookview')}}"><i class="fa fa-circle-o"></i> View Store Book</a></li>
                </ul>
            </li>
            <li class="treeview">
                <a href="#">
                    <i class="fas fa-search-dollar" style="color: white"></i>
                    <span>Selling Store</span>
                    <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{{ URL::asset('store_search#searchStore')}}"><i class="fas fa-search-dollar"></i> Search Items</a></li>
                    <li><a href="{{ URL::asset('store_search#selling_store')}}"><i class="fas fa-comment-dollar"></i> Sell Items </a></li>
                </ul>
            </li>
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-pie-chart"></i>
                    <span>Store Records</span>
                    <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{{ URL::asset('store_return')}}"><i class="fa fa-circle-o"></i> Return Items</a></li>
                    <li><a href="{{ URL::asset('store_return')}}"><i class="fa fa-circle-o"></i> Warrenty Sheet</a></li>
                </ul>
            </li>

            <li class="treeview">
                <a href="#">
                    <i class="fa fa-pie-chart"></i>
                    <span>Services</span>
                    <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
                </a>

                <ul class="treeview-menu">
                    <li><a href="{{ URL::asset('reservation_check')}}"><i class="fa fa-circle-o"></i>Check Reservation</a></li>
                    <li><a href="{{ URL::asset('job_book_search#job_book_search')}}"><i class="fa fa-circle-o"></i> Search Job Book</a></li>
                    <li><a href="{{ URL::asset('job_book_search#job_book_view_table')}}"><i class="fa fa-circle-o"></i> Create Job Book</a></li>
                    <li><a href="{{ URL::asset('job_book_search#fillingJobBook')}}"><i class="fa fa-circle-o"></i> Bill and Fill Job Book</a></li>
                    <li><a href="{{ URL::asset('services_income')}}"><i class="fa fa-circle-o"></i> Service Incomes</a></li>
                    <li><a href="{{ URL::asset('service_add')}}"><i class="fa fa-circle-o"></i> Service Settings</a></li>
                </ul>

            </li>

            <li class="treeview">
                <a href="#">
                    <i class="fa fa-pie-chart"></i>
                    <span>Income/Expense</span>
                    <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{{ URL::asset('income')}}"><i class="fa fa-circle-o"></i> Income</a></li>
                    <li><a href="{{ URL::asset('expense')}}"><i class="fa fa-circle-o"></i> Expense</a></li>
                </ul>
            </li>

            <li class="treeview">
                <a href="#">
                    <i class="fa fa-pie-chart"></i>
                    <span>Other</span>
                    <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{{ URL::asset('other_expenses')}}"><i class="fa fa-circle-o"></i> Record other Expenses</a></li>
                    <li><a href="{{ URL::asset('other_expenses')}}"><i class="fa fa-circle-o"></i> Record other Incomes</a></li>
                    <li><a href="{{ URL::asset('view_comments')}}"><i class="fa fa-circle-o"></i> Notices</a></li>
                    <li><a href="{{ URL::asset('view_comments#newsPublish')}}"><i class="fa fa-circle-o"></i> News Feeds</a></li>
                </ul>
            </li>
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-pie-chart"></i>
                    <span>Settings</span>
                    <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{{ URL::asset('update_settings')}}"><i class="fa fa-circle-o"></i> Update Username</a></li>
                    <li><a href="{{ URL::asset('update_settings')}}"><i class="fa fa-circle-o"></i> Update Password</a></li>
                </ul>
            </li>
        </ul>
    </section>
    <!-- /.sidebar -->
</aside>

<!-- Content Wrapper. Contains page content-->


@yield('body')
<!-- /.content-wrapper -->



</body>
<script src="{{ URL::asset('bower_components/jquery/dist/jquery.min.js') }}"></script>
<script src="{{ URL::asset('bower_components/jquery-ui/jquery-ui.min.js') }}"></script>
<script>
    $.widget.bridge('uibutton', $.ui.button);
</script>
<script src="{{ URL::asset('bower_components/bootstrap/dist/js/bootstrap.min.js') }}"></script>
<script src="{{ URL::asset('bower_components/raphael/raphael.min.js') }}"></script>
<script src="{{ URL::asset('bower_components/morris.js/morris.min.js') }}"></script>
<script src="{{ URL::asset('bower_components/jquery-sparkline/dist/jquery.sparkline.min.js') }}"></script>

<script src="{{ URL::asset('plugins/jvectormap/jquery-jvectormap-1.2.2.min.js') }}"></script>
<script src="{{ URL::asset('plugins/jvectormap/jquery-jvectormap-world-mill-en.js') }}"></script>
<script src="{{ URL::asset('bower_components/jquery-knob/dist/jquery.knob.min.js') }}"></script>
<script src="{{ URL::asset('bower_components/moment/min/moment.min.js') }}"></script>

<script src="{{ URL::asset('bower_components/bootstrap-daterangepicker/daterangepicker.js') }}"></script>
<script src="{{ URL::asset('bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') }}"></script>
<script src="{{ URL::asset('plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js') }}"></script>
<script src="{{ URL::asset('bower_components/jquery-slimscroll/jquery.slimscroll.min.js') }}"></script>

<script src="{{ URL::asset('bower_components/fastclick/lib/fastclick.js') }}"></script>
<script src="{{ URL::asset('dist/js/adminlte.min.js') }}"></script>
<script src="{{ URL::asset('dist/js/pages/dashboard.js') }}"></script>
<script src="{{ URL::asset('dist/js/demo.js') }}"></script>
</html>
