@extends('Layouts.AdministrativeLayout')
@section('admin_css')
    <style>
        #trhead{
            background-color: skyblue;
        }
        #trdata{

        }
    </style>
@endsection
@section('admin_js')
    <script>
        setTimeout(function () {
            window.location.href= 'http://127.0.0.1:8000/view_comments'; // the redirect goes here

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
@endsection
@section('title') Other Features @endsection

@section('body')
    <div class="content-wrapper" id="main_div">
        <section class="content">
            <div class="container-home" id="service1">
                <div class="container">
                    <div class="row">
                        <div class="col-md-10" id="newsPublish">
                            <div class="section-header text-center" id="WR">
                                <br>
                                <h3 class="title"><b>Publish News - Feeds</b></h3>
                            </div>
                            <hr>
                            <form action="/publishNews" method="post">
                                {{ csrf_field() }}
                                <div class="form-group row">
                                    <label for="news" class="col-sm-4 col-form-label" id="label_item_reg">News</label>
                                    <div class="col-sm-8">
                                        <textarea name="news" id="news" class="form-control" placeholder="Type Your News" cols="10" rows="3">
                                        </textarea>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-12">
                                        <button type="submit" class="btn btn-primary" name="RegWorker">Publish</button>
                                        <button type="reset" class="btn btn-success">Clear</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-10">
                            <div class="section-header text-center" id="WR">
                                <br>
                                <h3 class="title"><b>View Notices</b></h3>
                            </div>
                            @if(session()->has('updateNews_message'))
                                <div class="alert alert-success">
                                    {{ session()->get('updateNews_message') }}
                                </div>
                            @endif
                            <div id="table-scroll" style="height: 400px;overflow: auto">
                                <table class="table table-bordered">
                                    <tr id="trhead">
                                        <th>News</th>
                                        <th>Published date</th>
                                        <th>Edit</th>
                                        <th>Delete</th>
                                    </tr>
                                    @foreach($news as $row)
                                        <tr id="trdata">
                                            <td>{{$row['news']}}</td>
                                            <td>{{$row['created_at']}}</td>
                                            <td>
                                                <a id="updatesalary" class="opensalarymodal" data-toggle="modal" data-target="#salaryModal"
                                                   data-id="{{$row['news_id']}}"
                                                   data-salary="{{$row['news']}}">
                                                    Edit
                                                </a>
                                            </td>
                                            <td>
                                                <form action="/deleteNews" method="post">
                                                    {{ csrf_field() }}
                                                    <div class="form-group row">
                                                        <div class="col-sm-6">
                                                            <input type="text" class="hidden" name="news_id" value="{{$row['news_id']}}">
                                                            <button type="submit" class="btn btn-danger">Delete News</button>
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
                            <div class="modal fade" id="salaryModal" tabindex="-1" role="dialog" aria-labelledby="newsModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document" style="background-color: #2a88bd">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Edit Salary Detail</h5>
                                    </div>
                                    <form action="/updateNews" method="post">
                                        <div class="modal-body">
                                            {{ csrf_field() }}
                                            <div class="form-group">
                                                <label for="salary id">News ID</label>
                                                <textarea rows="1" cols="1" class="form-control" id="salarytoedit" name="news_id"></textarea>

                                                <label for="news">News</label>
                                                <textarea rows="1" cols="1" class="form-control" id="editsalarytext" name="news">
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
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-10">
                            <div class="section-header text-center" id="WR">
                                <br>
                                <h3 class="title"><b>View Comments</b></h3>
                                <hr>
                            </div>
                            <div id="table-scroll" style="height: 400px;overflow: auto">
                                <table class="table table-bordered">
                                    <tr id="trhead">
                                        <th>Name</th>
                                        <th>Comments</th>
                                        <th>Comment Date</th>
                                        <th>Delete Comment</th>
                                    </tr>
                                    @foreach($get_coments as $row)
                                        <tr id="trdata">
                                            <td>{{$row['name']}}</td>
                                            <td>{{$row['comment']}}</td>
                                            <td>{{$row['created_at']}}</td>
                                            <td>
                                                <form action="/deleteComment" method="post">
                                                    {{ csrf_field() }}
                                                    <div class="form-group row">
                                                        <div class="col-sm-6">
                                                            <input type="text" class="hidden" name="comment_id" value="{{$row['id']}}">
                                                            <button type="submit" class="btn btn-danger" name="RegWorker">Delete Comment</button>
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
                    <div class="row">
                        <div class="col-md-10">
                            <div class="section-header text-center" id="WR">
                                <br>
                                <h3 class="title"><b>View To-Do List</b></h3>
                                <hr>
                            </div>
                            <div id="table-scroll" style="height: 400px;overflow: auto">
                                <table class="table table-bordered">
                                    <tr id="trhead">
                                        <th>Note</th>
                                        <th>Due Date</th>
                                        <th>Due Time</th>
                                    </tr>
                                    @foreach($get_list as $row)
                                        <tr id="show_store_list_data_tr1">
                                            <td>{{$row['note']}}</td>
                                            <td>{{$row['date']}} - {{$row['time']}}</td>
                                            <td>
                                                <form action="/deleteNotice" method="post">
                                                    {{ csrf_field() }}
                                                    <div class="form-group row">
                                                        <div class="col-sm-6">
                                                            <input type="text" class="hidden" name="notice_id" value="{{$row['notice_id']}}">
                                                            <button type="submit" class="btn btn-danger" name="RegWorker">Delete Notice</button>
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
        </section>

    </div>

@endsection
