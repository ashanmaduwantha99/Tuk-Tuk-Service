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
                <li><a href="{{ URL::asset('home') }}"  class="smooth-scroll" id="navbar_link">Home</a></li>
                <li><a href="{{ URL::asset('home#serivece1') }}" id="navbar_link">Services</a></li>
                <li><a href="{{ URL::asset('home#reserve') }}" id="navbar_link">Reserve</a></li>
                <li><a href="{{ URL::asset('home#about_us_link') }}" id="navbar_link">About Us</a></li>
            </ul>

            <ul class="nav navbar-nav navbar-right">
                <li><a href="#" id="navbar_link" data-toggle="modal" data-target="#registerCustomerForm"><span class="glyphicon glyphicon-log-in"> </span> Register</a></li>
                <li><a href="#" id="navbar_link" data-toggle="modal" data-target="#loginCustomerForm"><span class="glyphicon glyphicon-log-in"> </span> Login</a></li>
            </ul>

        </div>
    </div>
</nav>

<div class="modal fade" id="loginCustomerForm" tabindex="-1" role="dialog" aria-labelledby="newsModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document" style="background-color: white">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">TTS L o g i n</h5>
        </div>
        <form action="/signin" method="post">
            <div class="modal-body" >
                {{ csrf_field() }}
                <div class="form-group row">
                    <label for="username" class="col-sm-3 col-form-label">Username</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" name="username" id="reserve_inputs" placeholder="Username" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="password" class="col-sm-3 col-form-label">Password</label>
                    <div class="col-sm-9">
                        <input type="password" class="form-control" id="reserve_inputs" name="password" placeholder="Password" required>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary" name="RegWorker">Login</button>
                <button type="reset" class="btn btn-success">Clear</button>
            </div>
        </form>
    </div>
</div>
<div class="modal fade" id="registerCustomerForm" tabindex="-1" role="dialog" aria-labelledby="newsModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document" style="background-color: white">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">TTS L o g i n</h5>
        </div>
        <form action="/signup" method="post">
            <div class="modal-body" >
                {{ csrf_field() }}
                <div class="form-group row">
                    <label for="username" class="col-sm-3 col-form-label">Name</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" name="name" id="reserve_inputs" placeholder="Your name" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="username" class="col-sm-3 col-form-label">NIC</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" name="nic" id="reserve_inputs" placeholder="NIC" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="username" class="col-sm-3 col-form-label">Email</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" name="email" id="reserve_inputs" placeholder="Email" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="username" class="col-sm-3 col-form-label">Mobile Number</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" name="mobile_number" id="reserve_inputs" placeholder="Mobile Number" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="username" class="col-sm-3 col-form-label">Threewheel Number</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" name="tw_number" id="reserve_inputs" placeholder="Threewheel Number" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="username" class="col-sm-3 col-form-label">Threewheel Chasie Number</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" name="tw_ch_number" id="reserve_inputs" placeholder="Threewheel Number" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="username" class="col-sm-3 col-form-label">Threewheel Engine Number</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" name="tw_eng_number" id="reserve_inputs" placeholder="Threewheel Number" required>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="username" class="col-sm-3 col-form-label">Threewheel Type</label>
                    <div class="col-sm-9">
                        <select class="form-control" name="tw_type">
                            <option value="2-stork">2-Stork</option>
                            <option value="4-stork">4-Stork</option>
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="username" class="col-sm-3 col-form-label">Username</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" name="username" id="reserve_inputs" placeholder="Username" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="password" class="col-sm-3 col-form-label">Password</label>
                    <div class="col-sm-9">
                        <input type="password" class="form-control" id="reserve_inputs" name="password" placeholder="Password" required>
                    </div>
                </div>

            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary" name="RegWorker">Register</button>
                <button type="reset" class="btn btn-success">Clear</button>
            </div>
        </form>
    </div>
</div>
