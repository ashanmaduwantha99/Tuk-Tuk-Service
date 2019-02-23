<nav class="navbar navbar-inverse">
    <div class="container-home">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>

        </div>
        <div class="collapse navbar-collapse" id="myNavbar">
            <ul class="nav navbar-nav navbar-left" id="navbar_link">
                <li><a href="{{ URL::asset('userhome') }}"  class="smooth-scroll" id="navbar_link">Home</a></li>
                <li><a href="{{ URL::asset('userjob_book') }}" id="navbar_link">Job Books</a></li>
                <li><a href="{{ URL::asset('user_settings') }}" id="navbar_link">Settings</a></li>
            </ul>

            <ul class="nav navbar-nav navbar-right">
                <li><a href="{{ URL::asset('userhome') }}" id="navbar_link" ><span class="glyphicon glyphicon-log-in"> </span> {{Auth::user()->username}}</a></li>
                <li><a href="{{ URL::asset('logout') }}" id="navbar_link" ><span class="glyphicon glyphicon-log-in"> </span> Logout</a></li>
            </ul>

        </div>
    </div>
</nav>
