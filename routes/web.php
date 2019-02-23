<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
/*
Route::get('/', function () {
    return view('welcome');
});*/
Route::get('/',['uses'=>'UserController@home_index']);
Route::get('home',['uses'=>'UserController@home_index']);
Route::post('reservation',['uses'=>'UserController@Reservation']);
Route::post('comment',['uses'=>'UserController@PostComments']);

//Route::get('login',['uses'=>'AdminController@login_index']);
//Route::post('login',['uses'=>'AdminController@Login']);

//Route::get('login',['uses'=>'AdminController@Login']);
Route::get('register',['uses'=>'AdminController@Register']);
Route::get('login',['uses'=>'AdminController@Login']);
Route::post('signin',['uses'=>'AdminController@signin']);
Route::get('logout',['uses'=>'AdminController@logout']);


Route::get('admin_home',['uses'=>'AdminController@Admin_Home']);

Route::get('workers',['uses'=>'AdminController@Admin_Worker']);
//------------------------------------------------------------------------
Route::get('worker_registration',['uses'=>'AdminController@WorkerRegister'])->middleware('AuthenticateMiddleware');
Route::get('worker_attendance',['uses'=>'AdminController@WorkerAttendance'])->middleware('AuthenticateMiddleware');
Route::get('worker_attendance_history',['uses'=>'AdminController@WorkerAttendanceHistory'])->middleware('AuthenticateMiddleware');
Route::get('workers_salary',['uses'=>'AdminController@WorkerSalary'])->middleware('AuthenticateMiddleware');
Route::get('workers_payement_history',['uses'=>'AdminController@PaymentHistory'])->middleware('AuthenticateMiddleware');
Route::get('workers_epfetf',['uses'=>'AdminController@WorkersEpfEtf'])->middleware('AuthenticateMiddleware');
Route::get('workers_salary_update',['uses'=>'AdminController@WorkerSalaryUpdate'])->middleware('AuthenticateMiddleware');




Route::get('stores',['uses'=>'AdminController@Admin_Store']);
//--------------------------------------------------------------
Route::get('store_register',['uses'=>'AdminController@StoreReg'])->middleware('AuthenticateMiddleware');
Route::get('store_view',['uses'=>'AdminController@StoreView'])->middleware('AuthenticateMiddleware');
Route::get('store_bookview',['uses'=>'AdminController@StoreBookView'])->middleware('AuthenticateMiddleware');
Route::get('store_return',['uses'=>'AdminController@StoreReturn'])->middleware('AuthenticateMiddleware');
Route::any('store_search',['uses'=>'AdminController@SearchStore'])->middleware('AuthenticateMiddleware');

//---------------------------------------------------------------
Route::get('income',['uses'=>'AdminController@Income'])->middleware('AuthenticateMiddleware');
Route::get('expense',['uses'=>'AdminController@Expense'])->middleware('AuthenticateMiddleware');

Route::get('service_add',['uses'=>'AdminController@ServiceAddition'])->middleware('AuthenticateMiddleware');
Route::any('job_book_search',['uses'=>'AdminController@JobBookSearch'])->middleware('AuthenticateMiddleware');
Route::get('services_income',['uses'=>'AdminController@ServiceIncome'])->middleware('AuthenticateMiddleware');
Route::get('reservation_check',['uses'=>'AdminController@ReservationCheck'])->middleware('AuthenticateMiddleware');

//-------------- Other Expenses-------------------------------------
Route::get('other_expenses',['uses'=>'AdminController@OtherExpenses'])->middleware('AuthenticateMiddleware');
Route::get('view_comments',['uses'=>'AdminController@ViewComments'])->middleware('AuthenticateMiddleware');

//----------------------Dashboards---------------------------------
Route::get('dashboard',['uses'=>'AdminController@DashBoard'])->middleware('AuthenticateMiddleware');
Route::get('update_settings',['uses'=>'AdminController@UpdateSettings'])->middleware('AuthenticateMiddleware');

//-------------- route group---------------------------------
Route::group(['prefix'=>'dashboard'],function(){
    Route::get('/store_chart','AdminController@Chart');
    Route::get('/attendance_chart','AdminController@Chart2');
});
//Route::get('dashboard/att_chart','AdminController@Attchart');

Route::post('register_workers',['uses'=>'AdminController@RegisterWorker']);
Route::post('deleteworkers',['uses'=>'AdminController@delete_worker']);
Route::post('editworker',['uses'=>'AdminController@editworker']);

Route::post('import_attendance', 'AdminController@importAttendanceByExcel');
Route::post('mark_attendance',['uses'=>'AdminController@mark_attendance']);

Route::post('updatesalary',['uses'=>'AdminController@updateSalary']);
Route::post('updatebonus',['uses'=>'AdminController@BonusUpdate']);

Route::post('calculateSalary',['uses'=>'AdminController@CalculateSalary']);
Route::post('calSalary',['uses'=>'AdminController@CalSalary']);
Route::post('PaySalary',['uses'=>'AdminController@PaySalary']);
Route::get('income_expense',['uses'=>'AdminController@Income_Expense']);

Route::post('storeRegister',['uses'=>'AdminController@RegisterStore']);
Route::post('import_store', 'AdminController@importStoreByExcel');

Route::post('edit_store_list',['uses'=>'AdminController@EditStoreList']);
Route::post('moveToStore',['uses'=>'AdminController@TransferData']);
Route::post('ToExpense',['uses'=>'AdminController@ToExpense']);
Route::post('storeReturn',['uses'=>'AdminController@ReturnItems']);
Route::post('Restore_Return',['uses'=>'AdminController@RestoreReturn']);
Route::post('Restore_Cash',['uses'=>'AdminController@RestoreCash']);

Route::post('add_to_bill',['uses'=>'AdminController@AddToBill']);
//Route::post('/billInfo',['uses'=>'AdminController@BillInfo']);
Route::get('offerBill',['uses'=>'AdminController@offerBill']);

//------------------ check for charts------------------
Route::get('sample_view','StockController@testChart');
Route::get('stock','StockController@index');
Route::get('stock/chart','StockController@chart');


//------------------service post route handling------------------//
Route::post('addService',['uses'=>'AdminController@AddNewService']);
Route::post('updateservicedetail',['uses'=>'AdminController@EditSerrviceList']);
Route::post('deleteService',['uses'=>'AdminController@DeleteService']);
Route::post('createJobBook',['uses'=>'AdminController@AddJobBook']);
Route::post('addNewJob',['uses'=>'AdminController@AddJobToOwner']);
Route::post('addTempJobList',['uses'=>'AdminController@AddTempJobList']);
Route::post('ToJobDesc',['uses'=>'AdminController@TransferJobDesc']);
Route::post('gotCheck',['uses'=>'AdminController@GotCheck']);
Route::post('reservationDone',['uses'=>'AdminController@reservationDone']);
Route::post('reservationRemove',['uses'=>'AdminController@reservationRemove']);
//----------------Other--------------------------//
Route::post('addOtherExpense',['uses'=>'AdminController@OtherExpenseToExpense']);
Route::post('addOtherIncome',['uses'=>'AdminController@OtherIncomeToIncome']);

Route::post('calMonthlyIncome',['uses'=>'AdminController@calMonthlyIncome']);
Route::post('calMonthlyExpense',['uses'=>'AdminController@calMonthlyExpense']);
Route::post('deleteComment',['uses'=>'AdminController@deleteComment']);
Route::post('addToDoList',['uses'=>'AdminController@addToDoList']);
Route::post('deleteNotice',['uses'=>'AdminController@deleteNotice']);
Route::post('publishNews',['uses'=>'AdminController@publishNews']);
Route::post('updateNews',['uses'=>'AdminController@updateNews']);
Route::post('deleteNews',['uses'=>'AdminController@deleteNews']);

Route::post('send_email',['uses'=>'AdminController@SendMail']);
Route::get('mail','AdminController@Dashboard');

Route::get('generate-pdf','AdminController@generatePDF');

Route::get('userhome',['uses'=>'CustomerController@CustomerHome']);
Route::post('signup',['uses'=>'UserController@CustomerRegister']);
Route::post('reserveDate',['uses'=>'CustomerController@reserveDate']);

Route::post('EditAdminUsername',['uses'=>'AdminController@EditAdminUsername']);
Route::post('updateAdminpassword',['uses'=>'AdminController@updateAdminpassword']);

Route::get('userjob_book',['uses'=>'CustomerController@CustomerJobBook']);
Route::get('user_settings',['uses'=>'CustomerController@CustomerSettings']);

Route::post('EditCustomerUsername',['uses'=>'CustomerController@EditCustomerUsername']);
Route::post('updateCustomerpassword',['uses'=>'CustomerController@updateCustomerpassword']);
//Route::get('export', 'MyController@export')->name('export');
//Route::get('importExportView', 'MyController@importExportView');
//Route::post('import', 'MyController@import')->name('import');

