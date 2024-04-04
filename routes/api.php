<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('payment/{ride_id}', 'Api\RideController@chargeCreditCard1');

Route::post('register', 'Api\ApiController@register');
Route::post('verify-user', 'Api\ApiController@verifyUser');
Route::post('login', 'Api\ApiController@login');
Route::post('login-by-email', 'Api\ApiController@loginByEmail');
Route::post('social-login', 'Api\ApiController@socialLogin');
Route::post('login-with-passcode', 'Api\ApiController@loginWithPassCode');
Route::post('forgot-password', 'Api\ApiController@forgotPassword');
Route::post('test-notification', 'Api\RideController@testNotification');
Route::get('send-schedule-ride-notification', 'Api\RideController@sendScheduleRideNotification');
Route::post('send-ride-request', 'Api\RideController@rideRequest');

Route::group(['middleware' => 'auth:api'], function(){

    Route::get('get-categories', 'Api\RideController@getCategories');
    Route::post('update-driver-location', 'Api\RideController@updateDriverLocation');
    Route::get('get-driver-location/{driver_id}', 'Api\RideController@getDriverLocation');
    Route::post('calculate-fare-distance', 'Api\RideController@calculateFareDistance');
    Route::get('get-cars', 'Api\RideController@getDriverCars');
    Route::post('confirm-ride', 'Api\RideController@confirmRide');
    Route::post('accept-ride-request', 'Api\RideController@acceptRideRequest');
    Route::post('driver-arrived', 'Api\RideController@driverArrived');
    Route::post('ride-started', 'Api\RideController@rideStarted');
    Route::post('ride-completed', 'Api\RideController@rideCompleted');
    Route::post('ride-rating', 'Api\RideController@rideRating');
    Route::get('get-rides', 'Api\RideController@getAllRides');
    Route::get('get-in-progress-ride', 'Api\RideController@getInProgressRide');
    Route::post('add-user-address', 'Api\RideController@addUserAddress');
    Route::post('update-user-address', 'Api\RideController@updateUserAddress');
    Route::post('update-user-card-info', 'Api\RideController@updateUserCardInfo');
    Route::post('update-user-device-token', 'Api\ApiController@updateUserDeviceToken');
    Route::get('get-user-address', 'Api\RideController@getUserAddress');
    Route::get('get-ride-cancelation-status', 'Api\RideController@getRideCancelationStatus');
    Route::get('ride-canceled', 'Api\RideController@rideCanceled');
    Route::get('get-cancelation-reasons', 'Api\RideController@getCancelationReasons');
    Route::get('get-ride-details/{ride_id}', 'Api\RideController@getRideDetails');
    Route::post('payment-fallback', 'Api\RideController@paymentFallback');
    Route::post('paid-tip', 'Api\RideController@paidTipByRider');
    Route::post('schedule-ride', 'Api\RideController@scheduleRide');
    Route::get('get-schedule-rides', 'Api\RideController@getScheduleRides');
    Route::post('get-schedule-ride-cancelation-status', 'Api\RideController@getScheduleRideCancelationStatus');
    Route::post('cancel-schedule-ride', 'Api\RideController@cancelScheduleRide');
    Route::get('pay-pending-ride-payment/{ride_id}', 'Api\RideController@payPendingRidePayment');

    Route::get('details', 'Api\ApiController@details');
    Route::get('profile', 'Api\ApiController@profileDetails');
    Route::post('update-profile', 'Api\ApiController@updateProfile');
    Route::post('update-profile-image', 'Api\ApiController@updateProfileImage');
    Route::post('update-online-status', 'Api\ApiController@updateOnlineStatus');
    Route::post('update-phone-number', 'Api\ApiController@updatePhoneNumber');
    Route::get('phone-verificaiton', 'Api\ApiController@phoneVerificaiton');
    Route::post('change-password', 'Api\ApiController@changePassword');
    Route::get('logout',"Api\ApiController@logout");
});

