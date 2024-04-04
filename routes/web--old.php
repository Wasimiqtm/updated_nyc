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

Route::redirect('home','/');
Route::get('pay-ride-charges','Api\RideController@payRideChargesForAirportCarLimo');

//Route::redirect('/', 'admin/login');

// Auth::routes();

Route::post('register', 'AuthController@register');
Route::post('login', 'AuthController@login');
Route::get('logout', 'AuthController@logout');
Route::post('calculate-fare', 'HomeController@calculateFare');
Route::get('real-map', 'HomeController@showCarsOnMap');
Route::get('get-drivers', 'HomeController@getDrivers');

//Route::get('/dashboard', 'HomeController@index')->name('home');
Route::get('/', 'HomeController@index');
Route::get('/driver-signup', 'HomeController@driverSignup');
Route::get('/login', 'HomeController@login');
Route::get('/privacy-policy', 'HomeController@privacyPolicy');
Route::get('/ride', 'HomeController@ride');
Route::get('/rider-signup', 'HomeController@riderSignup');
Route::get('/terms-conditions', 'HomeController@termsConditions');
Route::get('/about-us', 'HomeController@aboutUs');
Route::get('/services', 'HomeController@services');
Route::get('/contact-us', 'HomeController@contactUs');
Route::get('/newsroom', 'HomeController@newsroom');
Route::get('/our-products', 'HomeController@products');
Route::get('logs', '\Rap2hpoutre\LaravelLogViewer\LogViewerController@index');

Route::resource('rides', 'RideController');

Route::post('/ride-request/create-step1', 'RideController@postCreateStep1');
Route::get('/ride-request/create-step2', 'RideController@createStep2');
Route::post('/ride-request/create-step2', 'RideController@postCreateStep2');
Route::get('/ride-request/create-step3', 'RideController@createStep3');
Route::post('/ride-request/create-step3', 'RideController@postCreateStep3');
Route::get('/ride-request/booking-successfull/{id}', 'RideController@bookingSuccessfull');
Route::get('test-mail', 'RideController@testMail');

Route::group(['middleware' => 'auth'], function () {
  
  Route::get('profile', 'ProfileController@index');
  Route::post('profile/update', 'ProfileController@update');
  Route::get('change-password', 'ProfileController@changePasswordView');
  Route::post('change-password', 'ProfileController@changePassword');

  Route::resource('company-assets', 'AssetsController');
  Route::get('get-assets','AssetsController@getAssets');
  
  Route::resource('stocks', 'StocksController');
  Route::get('get-stocks','StocksController@getStocks');

   
  
  Route::get('jobs', 'JobController@index');
  Route::get('get-jobs', 'JobController@getJobs');
  Route::get('job-book-in', 'JobController@create');
  Route::post('job-book-in', 'JobController@store');
  Route::get('jobs/{job_id}/edit', 'JobController@edit');
  Route::patch('job-book-in/{job_id}', 'JobController@update');
  Route::delete('delete-job/{job_id}', 'JobController@destroy');
  Route::delete('delete-job-item/{job_item_id}', 'JobController@destroyItem');
  Route::get('change-job-status/{job_id}/{status}', 'JobController@changeStatus');
  
  Route::get('service-sheet/{job_id}', 'JobController@serviceSheet');
  Route::get('print-invoice/{job_id}', 'JobController@printInvoice');
  Route::get('print-sticker/{job_id}', 'JobController@printSticker');

  Route::get('settings', 'SettingsController@index');
  Route::post('settings/update', 'SettingsController@update');

  Route::resource('students', 'StudentController');
  Route::get('get-students','StudentController@getStudents');
  Route::get('students/registration-form/{student_id}','StudentController@show');  

  Route::get('student-fees/{student_id}', 'StudentFeeController@index');
  Route::get('get-student-fees/{student_id}','StudentFeeController@getStudentFees');
  Route::get('student-fees/create/{student_id}', 'StudentFeeController@create');
  Route::post('student-fees', 'StudentFeeController@store');
  Route::get('student-fees/{student_id}/edit', 'StudentFeeController@edit');
  Route::patch('student-fees/{id}', 'StudentFeeController@update');
  Route::get('student-fees/challan-form/{student_id}','StudentFeeController@challanForm');
  Route::get('student-fees/print-challan-form/{student_id}','StudentFeeController@printChallanForm');
  Route::get('student-fees/print-students-list/all','StudentFeeController@printStudentsList');
  


});

Route::group(['prefix' => 'admin'], function () {
  Route::get('/login', 'AdminAuth\LoginController@showLoginForm')->name('login');
  Route::post('/login', 'AdminAuth\LoginController@login');
  Route::post('/logout', 'AdminAuth\LoginController@logout')->name('logout');

  Route::get('/register', 'AdminAuth\RegisterController@showRegistrationForm')->name('register');
  Route::post('/register', 'AdminAuth\RegisterController@register');

  Route::post('/password/email', 'AdminAuth\ForgotPasswordController@sendResetLinkEmail')->name('password.request');
  Route::post('/password/reset', 'AdminAuth\ResetPasswordController@reset')->name('password.email');
  Route::get('/password/reset', 'AdminAuth\ForgotPasswordController@showLinkRequestForm')->name('password.reset');
  Route::get('/password/reset/{token}', 'AdminAuth\ResetPasswordController@showResetForm');
});
Route::get('clear-cache', function() {
    \Illuminate\Support\Facades\Artisan::call('config:clear');
    \Illuminate\Support\Facades\Artisan::call('cache:clear');
    \Illuminate\Support\Facades\Artisan::call('config:cache');
    return "Cache is cleared";
});

Route::get('send-sms', 'HomeController@sendSms');
Route::get('email', 'RideController@testingEmail');