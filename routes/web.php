<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WorkTypeController;
use App\Http\Controllers\MainController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\WorkController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\FreemanController;


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

Route::get('/', [MainController::class, 'index'])->name('/');


Auth::routes();
Route::any('/register', function(){
    return view('auth.login');
});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');



Route::get('/change_language/{lan}', [MainController::class, 'change_language']);

//job-provider
Route::get('/job-provider/registration-form', [MainController::class, 'job_provider_registration_form'])->name('job_provider.registration_form');
Route::post('job-provider/registration-store', [MainController::class,'job_provider_registration_store'])->name('job_provider.registration_store');
//Route::get('/job-provider/registration-success', [MainController::class, 'job_provider_registration_success'])->name('job_provider.registration_success');
Route::post('/job-provider/login', [MainController::class, 'job_provider_login'])->name('job_provider.login');

Route::get('/job-provider/panel', [CustomerController::class, 'job_provider_panel'])->name('job_provider_panel');
Route::get('/job-provider/home', [CustomerController::class, 'job_provider_home'])->name('job_provider_home');
Route::get('/job-provider/logout', [CustomerController::class, 'job_provider_logout'])->name('job_provider_logout');
Route::get('/get-worklist/{worktypeid}', [CustomerController::class, 'get_worklist'])->name('get_worklist');

Route::post('/job_provider/create_new_Work_order', [CustomerController::class, 'create_new_Work_order']);
Route::get('/job_provider/getworkorder/{logger_id}', [CustomerController::class, 'getworkorderlist']);
Route::get('/job_provider/get-workorderinfo/{workorderid}', [CustomerController::class, 'get_workorderinfo']);
Route::post('/job_provider/update_Work_order', [CustomerController::class, 'update_Work_order']);
Route::get('/job_provider/delete-workorderinfo/{workorderid}', [CustomerController::class, 'delete_workorderinfo']);
Route::get('/job_provider/offer_workorder/{workorderid}', [CustomerController::class, 'offer_workorder']);
Route::get('/job_provider/offer_cancel/{workorderid}', [CustomerController::class, 'offer_cancel']);
Route::get('/job_provider/show_interested_freemanlist/{logger_id}/{workorderid}', [CustomerController::class, 'show_interested_freemanlist']);
Route::get('/job_provider/book_this_freeman/{logger_id}/{workorderid}', [CustomerController::class, 'book_this_freeman']);
Route::get('/job_provider/cancel_this_booking/{logger_id}/{workorderid}', [CustomerController::class, 'cancel_this_booking']);
Route::get('/job_provider/profile', [CustomerController::class, 'job_provider_profile'])->name('job_provider_profile');
Route::get('/job_provider/set_workstatus/{workstatus}/{workorderid}/{freemanid}', [CustomerController::class, 'set_workstatus']);
Route::get('/job_provider/get-workinfo/{workid}', [CustomerController::class, 'get_workinfo']);
Route::post('/job_provider/cash_money_send', [CustomerController::class, 'cash_money_send']);
Route::get('/job_provider/job_and_payments_info', [CustomerController::class, 'job_and_payments_info'])->name('job_and_payments_info');
Route::get('/job_provider/job_provider_workorder_history', [CustomerController::class, 'job_provider_workorder_history'])->name('job_provider_workorder_history');
Route::get('/job_provider/job_provider_workorder_for_history', [CustomerController::class, 'job_provider_workorder_for_history']);


//job-seeker
Route::get('/job-seeker/registration-form', [MainController::class, 'job_seeker_registration_form'])->name('job_seeker.registration_form');
Route::post('job-seeker/registration-store', [MainController::class,'job_seeker_registration_store'])->name('job_seeker.registration_store');
Route::get('/job-seeker/registration-success', [MainController::class, 'job_seeker_registration_success'])->name('job_seeker.registration_success');
Route::post('/job-seeker/login', [MainController::class, 'job_seeker_login'])->name('job_seeker.login');

Route::get('/job-seeker/panel', [FreemanController::class, 'job_seeker_panel'])->name('job_seeker_panel');
Route::get('/job-seeker/home', [FreemanController::class, 'job_seeker_home'])->name('job_seeker_home');
Route::get('/job-seeker/logout', [FreemanController::class, 'job_seeker_logout'])->name('job_seeker_logout');
Route::get('/job-seeker/getworkorder', [FreemanController::class, 'getworkorderlist']);
Route::post('/job_seeker/set_myinterest', [FreemanController::class, 'set_myinterest']);
Route::get('/job_seeker/profile', [FreemanController::class, 'job_seeker_profile'])->name('job_seeker_profile');
Route::post('/job_seeker/payment_conplete', [FreemanController::class, 'payment_conplete']);
Route::get('/job_seeker/job_and_payments_detais', [FreemanController::class, 'job_and_payments_detais'])->name('job_and_payments_detais');
Route::get('/job_seeker/job_seeker_job_history', [FreemanController::class, 'job_seeker_job_history'])->name('job_seeker_job_history');
Route::get('/job_seeker/job_seeker_job_history_show', [FreemanController::class, 'job_seeker_job_history_show']);
//




Route::group(['middleware'=>['Admin','auth']],function(){

    //user tokenno
    Route::post('admin/tokenno_check', [AdminController::class,'tokenno_check'])->name('admin.tokenno');

    //admin account
    Route::get('admin/addform', [AdminController::class,'add_form'])->name('admin.add_form');
    Route::post('admin/store', [AdminController::class,'store'])->name('admin.store');	
    Route::get('admin/view',[AdminController::class,'view'])->name('admin.view');
    Route::get('admin/edit/{id}', [AdminController::class,'edit']);
    Route::post('admin/update/{id}', [AdminController::class,'update']);
    Route::get('admin/delete/{id}', [AdminController::class,'delete']);
    Route::post('admin/change_pass/{id}', [AdminController::class,'change_pass'])->name('admin.change_pass');
    Route::get('admin/edit_token/{id}', [AdminController::class,'edit_token']);
    Route::post('admin/change_user_token/{id}', [AdminController::class,'change_user_token'])->name('admin.change_user_token');
    //admin dashboard
    Route::get('dashboard',[AdminController::class,'dashboard'])->name('dashboard');
    

    //worktype
    //Route::get('worktype/addform', [CategoryController::class,'add_form'])->name('worktype.add_form');
    //Route::post('worktype/store', [CategoryController::class,'store'])->name('worktype.store');	
    //Route::get('worktype/edit/{id}', [CategoryController::class,'edit']);
    //Route::post('worktype/update/{id}', [CategoryController::class,'update']);
    Route::get('worktype/view',[WorkTypeController::class,'view'])->name('worktype.view');
    //Route::get('worktype/delete/{id}', [CategoryController::class,'delete']);

    //work
    Route::get('work/addform', [WorkController::class,'add_form'])->name('work.add_form');
    Route::post('work/store', [WorkController::class,'store'])->name('work.store');	
    Route::get('work/edit/{id}', [WorkController::class,'edit']);
    Route::post('work/update/{id}', [WorkController::class,'update']);
    Route::get('work/view',[WorkController::class,'view'])->name('work.view');
    Route::get('work/delete/{id}', [WorkController::class,'delete']);
    

});


