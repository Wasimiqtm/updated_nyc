<?php

Route::get('/dashboard', function () {
    $users[] = Auth::user();
    $users[] = Auth::guard()->user();
    $users[] = Auth::guard('admin')->user();

    //dd($users);

    return view('admin.dashboard');
})->name('home');

Route::redirect('home', 'dashboard');

Route::group(['namespace' => 'Admin'], function () {

	  Route::resource('drivers', 'DriverController');
  	Route::get('get-drivers','DriverController@getDrivers');
    Route::get('driver-car/{id}','DriverController@getDriverCar');
    Route::post('driver-car/{id}','DriverController@updateDriverCar');

    Route::get('send-message-to-drivers','DriverController@sendMessageToDrivers');
    Route::post('send-message-to-drivers','DriverController@sendMessageToDrivers');

    Route::get('send-message-to-riders','RiderController@sendMessageToRiders');
    Route::post('send-message-to-riders','RiderController@sendMessageToRiders');
    
    Route::get('send-message/{number}/{message}','DriverController@sendMessage');

    Route::resource('riders', 'RiderController');
    Route::get('get-riders','RiderController@getRiders');

    Route::resource('makes', 'MakeController');
    Route::get('get-makes','MakeController@getMakes');

  	Route::resource('models', 'ModelController');
  	Route::get('get-models','ModelController@getModels');

	  Route::resource('categories', 'CategoryController');
  	Route::get('get-categories','CategoryController@getCategories');
  	Route::get('get-make-models/{id}','CategoryController@getModels');

    Route::get('category-models/{category_id}','CategoryModelController@index');
    Route::get('category-models/create/{category_id}','CategoryModelController@create');
    Route::post('category-models/{category_id}','CategoryModelController@store');
    Route::get('delete-category-model/{id}','CategoryModelController@destroy');
    //Route::resource('category-models/{category_id}', 'CategoryModelController');
    Route::get('get-category-models/{category_id}','CategoryModelController@getCategoryModels');

    Route::get('rides', 'RideController@index');
    Route::get('get-rides','RideController@getRides');

    Route::get('ride-requests','RideController@rideRequests');
    Route::get('ride-requests/{id}','RideController@rideRequestDetails');
    Route::post('send-email-to-rider','RideController@rideRequestResponse');

    Route::get('schedule-rides', 'ScheduleRideController@index');
    Route::get('get-schedule-rides','ScheduleRideController@getScheduleRides');

    Route::get('calculator','RideController@getCalculator');
    Route::post('calculator','RideController@calculator');

	  Route::get('profile', 'ProfileController@index');
  	Route::post('profile/update', 'ProfileController@update');
  	Route::get('change-password', 'ProfileController@changePasswordView');
  	Route::post('change-password', 'ProfileController@changePassword');

    Route::resource('cancelation-reasons', 'CancelationReasonController');
    Route::get('get-cancelation-reasons','CancelationReasonController@getCancelationReasons');

    Route::resource('sliders', 'SliderController');
    Route::get('get-sliders','SliderController@getSliders');
    
 	Route::get('settings', 'SettingsController@index');
 	Route::post('settings/update', 'SettingsController@update');
});