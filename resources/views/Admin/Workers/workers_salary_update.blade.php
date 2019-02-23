@extends('Layouts.AdministrativeLayout')
@section('admin_css')
    <style>
        #Header{
            color: black;
        }
        #att_sheet_tr{
            color: black;
            background-color: #2a88bd;
            border: 2px solid black;
        }
        #att_sheet_tr_1{
            color: black;
            border-color: #0d3625;
            border: 2px solid black;
        }
        #input_att_form{
            background-color: transparent;
            border-color: #0d3625;
            color: black;
        }
        #attbutton{
            width:auto;
            background-color:forestgreen;
        }
        #inputreg_details{
            background-color: transparent;
            color: midnightblue;
        }
        #workerSalary{
            background-color: white;
        }
        #calSalary{
            background-color: white;
        }
        #show_salary_tr{
            color: black;
            background-color: #3d6983;
            border: 2px solid black;
        }
        #show_salary_tr1{
            color: black;
            border: 2px solid black;
        }
        #salary_sheet_update{
            background-color: white;
        }
    </style>
@endsection
@section('admin_js')
    <script>
        setTimeout(function () {
            window.location.href= 'http://127.0.0.1:8000/workers_salary_update'; // the redirect goes here

        },120000);
    </script>

    <script type="text/javascript">
        $(document).on("click",".opensalarymodal",function () {
            var salary_id = $(this).data('id');
            var update_salary = $(this).data('salary');

            $(".modal-body #salarytoedit").html(salary_id);
            $(".modal-body #editsalarytext").html(update_salary);
        });
    </script>
    <script type="text/javascript">
        $(document).on("click",".open_update_bonus_modal",function () {
            var bonus_id = $(this).data('id');
            var update_bonus_salary = $(this).data('bonus');

            $(".modal-body #bonustoedit").html(bonus_id);
            $(".modal-body #editbonustext").html(update_bonus_salary);
        });
    </script>
@endsection
@section('title') Worker @endsection

@section('body')
    <div class="content-wrapper" id="main_div">
        <div class="container-home" id="workerSalary">
            <div class="container">
                <div class="row">
                    <div class="col-md-6" id="show_salary">
                        <div class="section-header text-center">
                            <br>
                            <h3 class="title"><b>Employees' Salary Update</b></h3>
                        </div>
                        <div id="table-wrapper" style="position: relative">
                            <div id="table-scroll" style="height: auto;overflow: auto">
                                <table class="table table-bordered">
                                    <tr id="att_sheet_tr">
                                        <th>Role</th>
                                        <th>Salary</th>
                                        <th>Update Salary</th>
                                    </tr>
                                    @if(session()->has('messagesalaryEdit'))
                                        <div class="alert alert-success">
                                            {{ session()->get('messagesalaryEdit') }}
                                        </div>
                                    @endif
                                    @foreach($data as $row)
                                        <tr id="att_sheet_tr_1">
                                            <td>{{$row['role']}}</td>
                                            <td>{{$row['basic_salary']}}</td>
                                            <td>
                                                <a id="updatesalary" class="opensalarymodal" data-toggle="modal" data-target="#salaryModal"
                                                   data-id="{{$row['salary_id']}}"
                                                   data-salary="{{$row['basic_salary']}}">
                                                    Update
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </table>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <div class="container">
                <div class="row">
                    <div class="col-md-6">
                        <div class="section-header text-center">
                            <br>
                            <h3 class="title"><b>Employees - Bonus Salary Update</b></h3>
                        </div>
                        <div id="table-wrapper" style="position: relative">
                            <div id="table-scroll" style="height: auto;overflow: auto">
                                <table class="table table-bordered" id="bonus_updates">
                                    <tr id="att_sheet_tr">
                                        <th>Role</th>
                                        <th>Bonus</th>
                                        <th>Update Bonus</th>
                                    </tr>
                                    @if(session()->has('message_bonus'))
                                        <div class="alert alert-success">
                                            {{ session()->get('message_bonus') }}
                                        </div>
                                    @endif
                                    @foreach($data_bonus as $row)
                                        <tr id="att_sheet_tr_1">
                                            <td>{{$row['role']}}</td>
                                            <td>{{$row['bonus']}}</td>
                                            <td>
                                                <a id="updatebonus" class="open_update_bonus_modal" data-toggle="modal" data-target="#update_bonusModal"
                                                   data-id="{{$row['bonus_id']}}"
                                                   data-bonus="{{$row['bonus']}}">
                                                    Update
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal fade" id="salaryModal" tabindex="-1" role="dialog" aria-labelledby="newsModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document" style="background-color: #2a88bd">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Edit Salary Detail</h5>
                    </div>
                    <form action="/updatesalary" method="post">
                        <div class="modal-body">
                            {{ csrf_field() }}
                            <div class="form-group">

                                <label for="salary id">Salary ID</label>
                                <textarea rows="1" cols="1" class="form-control" id="salarytoedit" name="salary_id"></textarea>

                                <label for="news">Salary</label>
                                <textarea rows="1" cols="1" class="form-control" id="editsalarytext" name="basic_salary">
                        </textarea>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Reset</button>
                            <button type="submit" class="btn btn-primary">Update Salary</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="modal fade" id="update_bonusModal" tabindex="-1" role="dialog" aria-labelledby="newsModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document" style="background-color: #2a88bd">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Edit Bonus Detail</h5>
                    </div>
                    <form action="/updatebonus" method="post">
                        <div class="modal-body">
                            {{ csrf_field() }}
                            <div class="form-group">

                                <label for="salary id">Bonus ID</label>
                                <textarea rows="1" cols="1" class="form-control" id="bonustoedit" name="bonus_id"></textarea>

                                <label for="news">Bonus</label>
                                <textarea rows="1" cols="1" class="form-control" id="editbonustext" name="bonus">
                        </textarea>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Reset</button>
                            <button type="submit" class="btn btn-primary">Update Bonus</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


@endsection
