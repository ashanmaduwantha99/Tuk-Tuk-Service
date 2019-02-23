@extends('Layouts.AdministrativeLayout')
@section('admin_css')
@endsection
@section('admin_js')
    <script>
        setTimeout(function () {
            window.location.href= 'http://127.0.0.1:8000/other_expenses'; // the redirect goes here

        },120000);
    </script>
@endsection
@section('title') Other Expenses @endsection

@section('body')
    <div class="content-wrapper" id="main_div">
        <div class="container-home" id="service1">
            <div class="container">
                <div class="row">
                    <div class="col-md-6">
                        <div class="section-header text-center" id="WR">
                            <br>
                            <h3 class="title"><b>Add Other Expense</b></h3>
                            <hr>
                        </div>
                        @if(session()->has('other_expense_to_expense'))
                            <div class="alert alert-success">
                                {{ session()->get('other_expense_to_expense') }}
                            </div>
                        @endif
                        <form action="/addOtherExpense" method="post" id="RegisterForm">
                            {{ csrf_field() }}
                            <div class="form-group row">
                                <label for="other_expenses" class="col-sm-3 col-form-label" id="label_reg">Expenses</label>
                                <div class="col-sm-9">
                                    <select id="inputreg_details" class="form-control" name="other_expenses" required>
                                        <option selected>Select the Expense</option>
                                        <option value="Pay Electricity Bill">Pay Electricity Bill</option>
                                        <option value="Pay Water Bill">Pay Water Bill</option>
                                        <option value="Pay for Documentary Things">Pay for Documentary Things</option>
                                        <option value="Pay for Food and Tea">Pay for Food and Tea</option>
                                        <option value="Other Payments">Other Payments</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="cost" class="col-sm-3 col-form-label" id="label_reg">Amount</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="inputreg_details" name="pay_amount" placeholder="Amount" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-6">
                                    <button type="submit" class="btn btn-primary" name="RegWorker">Pay</button>
                                    <button type="reset" class="btn btn-success">Clear</button>
                                </div>
                                <div class="col-sm-6">
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="col-md-6">
                        <div class="section-header text-center" id="WR">
                            <br>
                            <h3 class="title"><b>Add Other Income</b></h3>
                            <hr>
                        </div>
                        @if(session()->has('other_income_to_expense'))
                            <div class="alert alert-success">
                                {{ session()->get('other_income_to_expense') }}
                            </div>
                        @endif
                        <form action="/addOtherIncome" method="post" id="RegisterForm">
                            {{ csrf_field() }}
                            <div class="form-group row">
                                <label for="other_expenses" class="col-sm-3 col-form-label" id="label_reg">Expenses</label>
                                <div class="col-sm-9">
                                    <select id="inputreg_details" class="form-control" name="other_income" required>
                                        <option selected>Select the Incomes</option>
                                        <option value="Get Commission Payments">Get Commission Payments</option>
                                        <option value="Other Incomes">Other Incomes</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="cost" class="col-sm-3 col-form-label" id="label_reg">Amount</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="inputreg_details" name="pay_amount" placeholder="Amount" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-6">
                                    <button type="submit" class="btn btn-primary" name="RegWorker">Pay</button>
                                    <button type="reset" class="btn btn-success">Clear</button>
                                </div>
                                <div class="col-sm-6">
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
