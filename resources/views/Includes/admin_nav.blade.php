<div class="container-home">
    <nav class="navbar navbar-inverse" style="border-radius: 0 !important;width: 100%;
    position: fixed;
    z-index: 1;
    top: 0;
    left: 0;">
        <div class="navbar-header">
            <button class="navbar-toggle" type="button" data-toggle="collapse" data-target=".js-navbar-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#">TTS</a>
        </div>

        <div class="collapse navbar-collapse js-navbar-collapse">
            <ul class="nav navbar-nav">
                <li class="dropdown mega-dropdown">
                    <a href="{{ URL::asset('workers')}}" class="dropdown-toggle" data-toggle="dropdown">Workers<span class="caret"></span></a>
                    <ul class="dropdown-menu mega-dropdown-menu">
                        <li class="col-sm-3">
                            <ul>
                                <li class="dropdown-header">Registration</li>
                                <li><a href="{{ URL::asset('workers/#RegisterForm')}}" target="_self">New Registtration</a></li>
                                <li><a href="{{ URL::asset('workers/#show_workers')}}">View Workers</a></li>
                            </ul>
                        </li>
                        <li class="col-sm-3">
                            <ul>
                                <li class="dropdown-header">Workers Attendence</li>
                                <li><a href="{{ URL::asset('workers/#attForm')}}">Mark Attendence</a></li>
                                <li><a href="{{ URL::asset('workers/#show_attendance')}}">View Attendence</a></li>
                                <li><a href="{{ URL::asset('workers/#att_chart')}}">Attendence Count</a></li>
                                <li><a href="{{ URL::asset('workers/#attendance_present_count')}}">Attendence Present Check</a></li>
                            </ul>
                        </li>
                        <li class="col-sm-3">
                            <ul>
                                <li class="dropdown-header">Salary</li>
                                <li><a href="{{ URL::asset('workers/#')}}">Calculate Salary</a></li>
                                <li><a href="{{ URL::asset('workers/#show_salary')}}">Salary Updates</a></li>
                                <li><a href="{{ URL::asset('workers/#bonus_updates')}}">Bonus Update</a> </li>
                                <li><a href="{{ URL::asset('workers/#bonus_updates')}}">ETF/EPF</a></li>
                                <li><a href="{{ URL::asset('workers/#bonus_updates')}}">Monthly Salary</a></li>
                            </ul>
                        </li>
                        <li class="col-sm-3">
                            <ul>
                                <li class="dropdown-header">Worker's History</li>
                                <li><a href="#">Past Attendance Sheet</a></li>
                                <li><a href="#">Past Attendance Count Sheet</a></li>
                                <li><a href="#">Past Monthly Salary Payment Records</a></li>
                            </ul>
                        </li>
                    </ul>
                </li>
                <li class="dropdown mega-dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">Store <span class="caret"></span></a>
                    <ul class="dropdown-menu mega-dropdown-menu">
                        <li class="col-sm-3">
                            <ul>
                                <li class="dropdown-header">Stores</li>
                                <li><a href="{{ URL::asset('stores')}}">Stores Registration</a></li>
                                <li><a href="#">Stores</a></li>
                                <li><a href="#">Store Book</a></li>
                            </ul>
                        </li>
                        <li class="col-sm-3">
                            <ul>
                                <li class="dropdown-header">Selling Store</li>
                                <li><a href="#">Selling</a></li>
                                <li><a href="#">Search Items</a></li>
                                <li><a href="#">Sell</a></li>
                            </ul>
                        </li>
                        <li class="col-sm-3">
                            <ul>
                                <li class="dropdown-header">Much more</li>
                                <li><a href="#">Return Items</a></li>
                                <li><a href="#">Warenty Sheets</a></li>
                                <li><a href="#">Custom Fonts</a></li>
                                <li><a href="#">Slide down on Hover</a></li>
                            </ul>
                        </li>
                        <li class="col-sm-3">
                            <ul>
                            </ul>
                        </li>
                    </ul>
                </li>
                <li><a href="#">Service</a></li>
                <li><a href='{{URL::asset('sell')}}'>Selling</a> </li>
                <li><a href='{{URL::asset('income_expense')}}'>Income/Expense</a> </li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li class="dropdown">
                    <a href="{{ URL::asset('admin') }}" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Admin<span class="caret"></span></a>
                    <ul class="dropdown-menu" role="menu">
                        <li><a href="{{URL::asset('logout') }}">Logout</a></li>
                        <li><a href="{{ URL::asset('admin') }}" id="navbar_link">Admin</a></li>
                        <li><a href="#">Something else here</a></li>
                        <li class="divider"></li>
                        <li><a href="#">Separated link</a></li>
                    </ul>
                </li>
            </ul>
        </div><!-- /.nav-collapse -->
    </nav>
</div>