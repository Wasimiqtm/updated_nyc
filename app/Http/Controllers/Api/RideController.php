<?php

namespace App\Http\Controllers\api;

use Faker\Provider\Uuid;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Helpers\LogActivity;
use App\User;
use App\Country;
use Illuminate\Support\Str;
use Response;
use Carbon\Carbon;
use App\Models\Categories;
use App\Models\DriverLocations;
use App\Models\DriverCar;
use LaravelFCM\Message\OptionsBuilder;
use LaravelFCM\Message\PayloadDataBuilder;
use LaravelFCM\Message\PayloadNotificationBuilder;
use Illuminate\Database\Eloquent\Builder;
use Edujugon\PushNotification\Facades\PushNotification;
use App\Models\UserDevice;
use App\Models\Ride;
use App\Models\RideStatus;
use App\Models\Rating;
use App\Models\UserAddress;
use App\Models\CancelationReason;
use App\Models\RideBill;
use App\Models\ScheduleRide;
use App\Models\UserCardInfo;
use App\Models\RideRequest;
use net\authorize\api\contract\v1 as AnetAPI;
use net\authorize\api\controller as AnetController;
use App\Notifications\ScheduleRideNotification;
use App\Notifications\ScheduleRideAdminNotification;
use DB, Image, File, FCM, Log, Notification;
use Square\Environment;
use Square\SquareClient;
class RideController extends Controller
{

    public $successStatus = 200;
    public $badRequestStatus = 400;
    public $errorStatus = 401;
    public $notFoundStatus = 404;
    
 

    public function __construct()
    {
        //Log::useFiles(public_path().'/logs/'.date('d-m-Y').'/info.log', 'info');
        //Log::useFiles(storage_path('logs/laravel-'.date('d-m-Y').'.log'), 'info');
    }

    public function getCategories()
    {
        $response['status'] = false;
        

        $categories = Categories::get();
        if($categories){
           
            $categories->map(function($category){
                if($category->image!="")
                    $category->image = checkImage('categories/'. $category->image);
                
                return $category;
            });

            $response['status'] =  true;
            $response['message'] =  'Categories successfully fetched.';
            $response['categories'] =  $categories;
                    
        }else{
            $response['error'] = "Categories not found";
        }


        return response()->json($response, 200);    
    }

    public function updateDriverLocation(Request $request)
    {
        $response['status'] = false;
        
        $validator = Validator::make($request->all(), [
            'lat' => 'required', 
            'lon' => 'required'            
        ]);


        if ($validator->fails()){
            $response['error'] = $validator->errors()->first();
            return response()->json($response, 200); 
        }

        $user = Auth::user();

        if($user->online_status == "1" && $user->user_type == "driver"){
            $location = DriverLocations::updateOrCreate(['user_id' => $user->id]);
            $location->lat = $request->lat;
            $location->lon = $request->lon;
            $location->heading = @$request->heading;
            $location->route = @$request->route;
            $location->save();
               
            $response['status'] =  true;
            $response['message'] =  'Driver location successfully updated.';
        }else{
            $response['status'] =  false;
            $response['message'] =  'Driver is offline.';   
        }
        
        Log::info('Update Driver Location Request: ',$request->all());        
        Log::info('Update Driver Location Response: ', $response);             
        
        return response()->json($response, 200);    
    }
    
    public function getDriverLocation($driver_id)
    {
        $response['status'] = false;
        
        $location = DriverLocations::with('driver')->where('user_id', $driver_id)->first();
        if($location){

            if($location->driver->profile_image){
                $location->driver->profile_thumbnail = checkImage('users/thumbs/'. $location->driver->profile_image);
                $location->driver->profile_image = checkImage('users/'. $location->driver->profile_image);            
            }

            $response['status'] =  true;
            $response['driver_location'] =  $location;        
        }else{
            $response['message'] =  'Driver location not found';
            $response['driver_location'] =  [];        
        }
        

        return response()->json($response, 200);    
    }

    public function calculateFareDistance(Request $request)
    {
        $response['status'] = false;
        
        $validator = Validator::make($request->all(), [
            'pickup_lat' => 'required', 
            'pickup_lon' => 'required',
            'dropoff_lat' => 'required', 
            'dropoff_lon' => 'required',            
            'category_id' => 'required'           
        ]);



        if ($validator->fails()){
            $response['error'] = $validator->errors()->first();
            return response()->json($response, 200); 
        }

        $user_id = Auth::id();
        //$user_id = 153;
        // $rides = Ride::with('ride_bill')->where('rider_id',$user_id);
        // $rides->whereHas('ride_bill',function($query) {
        //     $query->where('payment_status','pending');
        // });
        // $failed_ride = $rides->latest('id')->first();        
        // if($failed_ride){
        //     if($failed_ride->ride_bill->payment_response!=null){
        //         $payment_response = json_decode($failed_ride->ride_bill->payment_response);
                
        //         if(@$payment_response->errors){
        //             $response['message'] = "Your payment is not successfully deducted please go to your trip history and pay";
        //             $payment_errors = $payment_response->errors;                            
        //             if(@$payment_errors->error[0]->errorCode>0){
        //                 $response['message'] =  @$payment_errors->error[0]->errorText;     
        //             }
                    
        //             $response['status'] =  false;
        //             return response()->json($response, 200);     
        //         }
                
        //     }
        // }

        $pickup_lat = $request->pickup_lat;
        $pickup_lon = $request->pickup_lon;
        $dropoff_lat = $request->dropoff_lat;
        $dropoff_lon = $request->dropoff_lon;

        $category = Categories::find($request->category_id);
        
        if($category){
            $url = "https://maps.googleapis.com/maps/api/distancematrix/json?units=imperial&origins=".$pickup_lat.",".$pickup_lon."&destinations=".$dropoff_lat.",".$dropoff_lon."&departure_time=now&key=AIzaSyBfe1Nw8nQENKRT9WcLlz7Uu0wTlrrFLQU"; 
            $ch = curl_init();  
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
            curl_setopt($ch, CURLOPT_URL, $url); 

            $result = curl_exec($ch); 
            
            $address = json_decode($result);
                                
            if($address->status=="OK"){
                
                

                
                $distance = @$address->rows[0]->elements[0]->distance->text;
                if($distance!=""){

                    $url = "https://maps.googleapis.com/maps/api/geocode/json?latlng=".$pickup_lat.",".$pickup_lon."&key=AIzaSyBfe1Nw8nQENKRT9WcLlz7Uu0wTlrrFLQU"; 
                    $ch = curl_init();  
                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
                    curl_setopt($ch, CURLOPT_URL, $url); 

                    $pickup_state = $dropoff_state = "";
                    $result1 = curl_exec($ch); 
                    $address1 = json_decode($result1);
                    if($address1->status=="OK") {
                        for ($j=0;$j<count($address1->results[0]->address_components);$j++) {
                            $cn=array($address1->results[0]->address_components[$j]->types[0]);
                            if($address1->results[0]->address_components[$j]->long_name=="New York") {
                                $pickup_state = $address1->results[0]->address_components[$j]->long_name;
                            }
                        }
                     }

                     $url = "https://maps.googleapis.com/maps/api/geocode/json?latlng=".$dropoff_lat.",".$dropoff_lon."&key=AIzaSyBfe1Nw8nQENKRT9WcLlz7Uu0wTlrrFLQU"; 
                    $ch = curl_init();  
                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
                    curl_setopt($ch, CURLOPT_URL, $url); 

                    $result2 = curl_exec($ch); 
                    $address2 = json_decode($result2);
                    if($address1->status=="OK") {
                        for ($j=0;$j<count($address2->results[0]->address_components);$j++) {
                            $cn=array($address2->results[0]->address_components[$j]->types[0]);
                            if($address2->results[0]->address_components[$j]->long_name=="New York") {
                                $dropoff_state = $address2->results[0]->address_components[$j]->long_name;
                            }
                        }
                     }

                    $distance = explode(' ', $distance);
                    $distance = (double) $distance[0];

                    $duration_in_traffic = ceil($address->rows[0]->elements[0]->duration_in_traffic->value/60);

                    $total_charges = $category->base_fare;
                    $total_charges = $total_charges + ($distance*$category->cost_per_mile);
                    $total_charges = $total_charges + ($duration_in_traffic*$category->cost_per_minute);
                    
                    $category->black_car_charges = 0; 
                    $category->new_york_city_charges = 0; 
                    if($pickup_state=="New York" && $dropoff_state=="New York"){
                        $black_car_finder_fee = $category->black_car_finder_fee;
                        $new_york_city_fee = $category->new_york_city_fee;
                        if($black_car_finder_fee>0){
                            $black_car_fund = ($total_charges*$black_car_finder_fee/100);
                            $total_charges = $total_charges + $black_car_fund;
                            $category->black_car_charges = number_format($black_car_fund,2);                        
                        } 
                        if($new_york_city_fee>0){
                            $new_york_city_fund = ($total_charges*$new_york_city_fee/100);
                            $total_charges = $total_charges + $new_york_city_fund;
                            $category->new_york_city_charges = number_format($new_york_city_fund,2); 
                        }
                    }

                    $total_charges_with_meet_greet = $total_charges + (int) $category->meet_greet_fee;
                    $category->total_charges = number_format($total_charges,2); 
                    $category->total_charges_with_meet_greet = number_format($total_charges_with_meet_greet,2); 
                    $category->distance = number_format($distance,2); 
                    $category->duration_in_traffic = $duration_in_traffic; 
                    // $category->map_info = $address; 

                    $response['status'] =  true;
                    $response['result'] =  $category;
                }else{
                    $response['message'] =  'Distance not calculated';
                }
                

                return response()->json($response, 200); 
            }
        }else{
            $response['message'] =  'Category not found against id';
        }
        
  
        $response['status'] =  false;
        
        return response()->json($response, 200);    
    }

    public function getDriverCars(Request $request)
    {

        
        $response['status'] = false;
        
        // $validator = Validator::make($request->all(), [
        //     'latitude' => 'required', 
        //     'longitude' => 'required'           
        // ]);



        // if ($validator->fails()){
        //     $response['error'] = $validator->errors()->first();
        //     return response()->json($response, 200); 
        // }

       
        $cars = DriverCar::with(['driver.driver_location','category_model.category','category_model.model.make'])
                ->online()->where('user_id','!=',Auth::id())->get();

        // $cars->whereHas('driver',function(Builder  $query){
        //     $query->whereHas('driver_location',function(Builder $q){
        //         $q->where('id','>',0);
        //     });
        // });        

        if($cars){
            $response['status'] =  true;

            $cars->map(function($car){

                $car->driver->profile_thumbnail = checkImage('users/thumbs/'. @$car->driver->profile_image);
                $car->driver->profile_image = checkImage('users/thumbs/'. @$car->driver->profile_image);
                
                return $car;
            });

            $response['cars'] =  $cars;
        }else{            
            $response['message'] =  'Driver Cars not found';
        }
        
  
        
        
        return response()->json($response, 200);    
    }
    
    public function confirmRide(Request $request)
    {


        $response['status'] = false;
        
        $validator = Validator::make($request->all(), [
            'pickup_lat' => 'required', 
            'pickup_lon' => 'required',
            'dropoff_lat' => 'required', 
            'dropoff_lon' => 'required',            
            'category_id' => 'required'           
        ]);



        if ($validator->fails()){
            $response['error'] = $validator->errors()->first();
            return response()->json($response, 200); 
        }

        $user_id = Auth::id();
        $driver_limit = 5;
        $pickup_lat = $request->pickup_lat;
        $pickup_lon = $request->pickup_lon;
        $dropoff_lat = $request->dropoff_lat;
        $dropoff_lon = $request->dropoff_lon;
        $category_id = $request->category_id;
        $is_meet_greet = (isset($request->is_meet_greet)&&($request->is_meet_greet==1))?'1':'0';

        $category = Categories::find($category_id);

        if($category){
            $url = "https://maps.googleapis.com/maps/api/distancematrix/json?units=imperial&origins=".$pickup_lat.",".$pickup_lon."&destinations=".$dropoff_lat.",".$dropoff_lon."&departure_time=now&key=AIzaSyBfe1Nw8nQENKRT9WcLlz7Uu0wTlrrFLQU"; 
            $ch = curl_init();  
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
            curl_setopt($ch, CURLOPT_URL, $url); 

            $result = curl_exec($ch); 
            
            $address = json_decode($result);
            
            if($address->status=="OK"){                

                $distance = $address->rows[0]->elements[0]->distance->text;
                $distance = explode(' ', $distance);
                $distance = (double) $distance[0];

                $duration_in_traffic = $address->rows[0]->elements[0]->duration_in_traffic->text;
                $duration_in_traffic = explode(' ', $duration_in_traffic);
                $duration_in_traffic = (double) $duration_in_traffic[0];

                $total_charges = $category->base_fare;
                $total_charges = $total_charges + ($distance*$category->cost_per_mile);
                $total_charges = $total_charges + ($duration_in_traffic*$category->cost_per_minute);

                $cars = DriverCar::with(['driver.device','driver.driver_location','driver_rides','category_model.category','category_model.model.make'])->online()->where('user_id','!=',$user_id);

                $cars->whereHas('category_model',function($query) use ($category_id){
                    $query->where('category_id',$category_id);
                });

                $cars->whereHas('driver',function(Builder  $query) use ($pickup_lat,$pickup_lon){
                    $query->whereHas('driver_location',function(Builder $q) use ($pickup_lat,$pickup_lon){
                        $q->isWithinMaxDistance($pickup_lat,$pickup_lon,settingValue('radius'));
                       // $q->where('id','>',0);
                    });
                });  

                $cars = $cars->take($driver_limit)->orderBy('id','desc')->get();
                //return response()->json($cars, 200); 
                
                $driver_list = $cars->pluck('driver.name','driver.phone_number')->toArray();
                Log::info('Ride Request Drivers List: ', $driver_list);             

                if($cars->count()>0){

                    $ride['rider_id'] = $user_id;
                    $ride['driver_id'] = 0;
                    $ride['category_id'] = $category->id;
                    $ride['pickup_lat'] = $pickup_lat;
                    $ride['pickup_lon'] = $pickup_lon;
                    $ride['dropoff_lat'] = $dropoff_lat;
                    $ride['dropoff_lon'] = $dropoff_lon;
                    $ride['is_meet_greet'] = $is_meet_greet;
                    $ride['status'] = 'pending';
                    $ride_id = Ride::create($ride);

                    if($ride_id){
                        $this->updateRideStatus($ride_id->id,'pending');
                        $ride = Ride::with('rider')->find($ride_id->id);
                        if($ride->rider->profile_image){
                            $ride->rider->profile_thumbnail = checkImage('users/thumbs/'. $ride->rider->profile_image);
                            $ride->rider->profile_image = checkImage('users/'. $ride->rider->profile_image);            
                        }


                        $title = 'Ride request';
                        $message = $ride->rider->name.' send request for ride';
                        $content = ['message' => $message,'ride' => $ride->toArray(),'type' => 'ride_request'];
                        
                        $i=0;
                        foreach ($cars as $car) {
                            
                            if(@$car->driver->device->user_device!=""){
                               // dd($car->driver->device->user_device);

                                $notification = 1;

                                if($car->driver_rides->count()>0){

                                    $count = $car->driver_rides->whereIn('status',['pending','on_the_way','arrived','started','reached'])->count();

                                    if($count>0){
                                        $notification = 0;
                                    }                                   
                                }

                                if($notification == 1){
                                    $notification_response = $this->sendNotification($title,$message, $content, $car->driver->device->token,$car->driver->device->user_device);                        
                                
                                    sleep(10);
                                    
                                    $ride = Ride::where('status','!=','pending')->find($ride_id->id);
                                    if($ride){                                  
                                        break;
                                    }else{                                    
                                        $i++;
                                        if($i==$cars->count()){   
                                            Ride::find($ride_id->id)->delete();                                                 
                                            $this->sendNotificationByUserId($user_id,'Drivers Not Found','Drivers not found',['type' => 'driver_not_found']);
                                        }
                                    }
                                }else{
                                    $i++;
                                }
                               
                                
                                    
                            }else{
                                $i++;
                            }
                                                                        
                        }

                        
                        $response['status'] =  true;
                        $response['driver_list'] =  $driver_list;
                        $response['message'] =  'Notification successfully sent';
                        return response()->json($response, 200); 
                    }else{
                        $response['message'] =  'Ride not successfully created';                        
                    }
                    
                }
                
                $response['message'] =  'Drivers not found';
            }
        }else{
            $response['message'] =  'Category not found against id';
        }
        
  
        $response['status'] =  false;
        $this->sendNotificationByUserId($user_id,'Drivers Not Found','Drivers not found',['type' => 'driver_not_found']);
        return response()->json($response, 200);    
    }

    public function acceptRideRequest(Request $request)
    {


        $response['status'] = false;
        
        $validator = Validator::make($request->all(), [
            'ride_id' => 'required'            
        ]);



        if ($validator->fails()){
            $response['error'] = $validator->errors()->first();
            return response()->json($response, 200); 
        }

        $user_id = Auth::id();
        $ride_id = $request->ride_id;
        
        $ride = Ride::where('status','pending')->find($ride_id);
        if($ride){      
            $ride->driver_id = $user_id;
            $ride->status = 'on_the_way';
            $ride->save();

            $this->updateRideStatus($ride->id,'on_the_way');        

            $user_token = UserDevice::where('user_id',$ride->rider_id)->first();
            if($user_token){  
                $title = 'Accept Ride Request';              
                $message = 'Your ride is on the way';
                $content = ['message' => $message,'ride_id' => $ride->id,'driver_id' => $ride->driver_id,'type' => 'ride_accepted'];
                
                $this->sendNotification($title,$message,$content,$user_token->token,$user_token->user_device);
            }

            $response['status'] =  true;
            $response['message'] = 'Ride successfully accepted';
            return response()->json($response, 200);
        }else{
            $response['message'] = 'Ride not exist against this id';
        }
        
  
        $response['status'] =  false;
        
        return response()->json($response, 200);    
    }

    public function driverArrived(Request $request)
    {


        $response['status'] = false;
        
        $validator = Validator::make($request->all(), [
            'ride_id' => 'required'            
        ]);


        if ($validator->fails()){
            $response['error'] = $validator->errors()->first();
            return response()->json($response, 200); 
        }

        $user_id = Auth::id();
        $ride_id = $request->ride_id;
        
        $ride = Ride::find($ride_id);
        if($ride){      
            $this->updateRideStatus($ride->id,'arrived');

            $user_token = UserDevice::where('user_id',$ride->rider_id)->first();
            if($user_token){ 
                $title = 'Driver Arrived';                 
                $message = 'Driver is arrived';
                $content = ['message' => $message,'ride_id' => $ride->id,'type' => 'driver_arrived'];
                
                $this->sendNotification($title,$message,$content,$user_token->token,$user_token->user_device);
            }

            $response['status'] =  true;
            $response['message'] = 'Ride status successfully updated';
            return response()->json($response, 200);
        }else{
            $response['message'] = 'Ride not exist against this id';
        }
  
        $response['status'] =  false;
        return response()->json($response, 200);    
    }

    public function rideStarted(Request $request)
    {


        $response['status'] = false;
        
        $validator = Validator::make($request->all(), [
            'ride_id' => 'required'            
        ]);

        if ($validator->fails()){
            $response['error'] = $validator->errors()->first();
            return response()->json($response, 200); 
        }

        $user_id = Auth::id();
        $ride_id = $request->ride_id;
        
        $ride = Ride::find($ride_id);
        if($ride){      
            $this->updateRideStatus($ride->id,'started');

            $user_token = UserDevice::where('user_id',$ride->rider_id)->first();
            if($user_token){ 
                $title = 'Ride Started';               
                $message = 'Your ride has started';
                $content = ['message' => $message,'ride_id' => $ride->id,'type' => 'ride_started'];
                
                $this->sendNotification($title,$message,$content,$user_token->token,$user_token->user_device);
            }

            $response['status'] =  true;
            $response['message'] = 'Ride status successfully updated';
            return response()->json($response, 200);
        }else{
            $response['message'] = 'Ride not exist against this id';
        }
  
        $response['status'] =  false;
        return response()->json($response, 200);    
    }

    public function rideCompleted(Request $request)
    {


        $response['status'] = false;
        
        $validator = Validator::make($request->all(), [
            'ride_id' => 'required'          
        ]);



        if ($validator->fails()){
            $response['error'] = $validator->errors()->first();
            return response()->json($response, 200); 
        }

        $driver_id = Auth::id();
        $ride = Ride::with('category','ride_bill')->find($request->ride_id);

        if($ride){

            
            if($request->has('dropoff_lat') && $request->has('dropoff_lon')){
                $ride->dropoff_lat = $request->dropoff_lat;
                $ride->dropoff_lon = $request->dropoff_lon;
                $ride->save();
                $ride->refresh();
            }            

            $url = "https://maps.googleapis.com/maps/api/distancematrix/json?units=imperial&origins=".$ride->pickup_lat.",".$ride->pickup_lon."&destinations=".$ride->dropoff_lat.",".$ride->dropoff_lon."&departure_time=now&key=AIzaSyBfe1Nw8nQENKRT9WcLlz7Uu0wTlrrFLQU"; 
            $ch = curl_init();  
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
            curl_setopt($ch, CURLOPT_URL, $url); 

            $result = curl_exec($ch); 
            
            $address = json_decode($result);
            
            if($address->status=="OK"){
  

                $url = "https://maps.googleapis.com/maps/api/geocode/json?latlng=".$ride->pickup_lat.",".$ride->pickup_lon."&key=AIzaSyBfe1Nw8nQENKRT9WcLlz7Uu0wTlrrFLQU"; 
                $ch = curl_init();  
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
                curl_setopt($ch, CURLOPT_URL, $url); 

                $pickup_state = $dropoff_state = "";
                $result1 = curl_exec($ch); 
                $address1 = json_decode($result1);
                if($address1->status=="OK") {
                    for ($j=0;$j<count($address1->results[0]->address_components);$j++) {
                        $cn=array($address1->results[0]->address_components[$j]->types[0]);
                        if($address1->results[0]->address_components[$j]->long_name=="New York") {
                            $pickup_state = $address1->results[0]->address_components[$j]->long_name;
                        }
                    }
                 }

                $url = "https://maps.googleapis.com/maps/api/geocode/json?latlng=".$ride->dropoff_lat.",".$ride->dropoff_lon."&key=AIzaSyBfe1Nw8nQENKRT9WcLlz7Uu0wTlrrFLQU"; 
                $ch = curl_init();  
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
                curl_setopt($ch, CURLOPT_URL, $url); 

                $result2 = curl_exec($ch); 
                $address2 = json_decode($result2);
                if($address1->status=="OK") {
                    for ($j=0;$j<count($address2->results[0]->address_components);$j++) {
                        $cn=array($address2->results[0]->address_components[$j]->types[0]);
                        if($address2->results[0]->address_components[$j]->long_name=="New York") {
                            $dropoff_state = $address2->results[0]->address_components[$j]->long_name;
                        }
                    }
                 }


                $this->updateRideStatus($ride->id,'completed');                
                $tip_charges = settingValue('default_tip');
                $category = $ride->category;

                $distance = $address->rows[0]->elements[0]->distance->text;
                $distance = explode(' ', $distance);
                $distance = (double) $distance[0];
                
                $duration_in_traffic = ceil($address->rows[0]->elements[0]->duration_in_traffic->value/60);

                $total_charges = $category->base_fare;
                $total_charges = $total_charges + ($distance*$category->cost_per_mile);
                $total_charges = $total_charges + ($duration_in_traffic*$category->cost_per_minute);


                $black_car_finder_fee = 0; 
                $new_york_city_fee = 0; 
                $black_car_finder_charges = 0; 
                $new_york_city_charges = 0; 
                if($pickup_state=="New York" && $dropoff_state=="New York"){
                    $black_car_finder_fee = $category->black_car_finder_fee;
                    $new_york_city_fee = $category->new_york_city_fee;
                    if($black_car_finder_fee>0){
                        $black_car_finder_charges = ($total_charges*$black_car_finder_fee/100);
                        $total_charges = $total_charges + $black_car_finder_charges;                        
                    } 
                    if($new_york_city_fee>0){
                        $new_york_city_charges = ($total_charges*$new_york_city_fee/100);
                        $total_charges = $total_charges + $new_york_city_charges;                        
                    }
                }


                $total_charges = $total_charges + $tip_charges;
                


                $ride_bill['base_fare'] = $category->base_fare;
                $ride_bill['cost_per_mile'] = $category->cost_per_mile;
                $ride_bill['cost_per_minute'] = $category->cost_per_minute;
                $ride_bill['distance'] = $distance;
                $ride_bill['duration'] = $duration_in_traffic;
                $ride_bill['tip'] = $tip_charges;
                $ride_bill['black_car_finder_fee'] = $black_car_finder_fee;
                $ride_bill['new_york_city_fee'] = $new_york_city_fee;

                $ride_bill['meet_greet_fee'] = 0;
                if($ride->is_meet_greet=="1"){
                    $ride_bill['meet_greet_fee'] = $category->meet_greet_fee;
                    $total_charges = $total_charges + (int) $category->meet_greet_fee;
                }
                $ride_bill['total_charges'] = number_format($total_charges,2);
                $ride_bill['other_charges'] = 0;
              
                RideBill::updateOrCreate(['ride_id'=>$ride->id],$ride_bill);

                $response['status'] =  true;
                $response['message'] =  'Ride successfully completed';
                $ride->refresh();

                if(@$ride->ride_bill){
                    $payment_details['total_charges'] = $ride->ride_bill->total_charges;
                    $payment_details['charges'][] = array('name'=>'Base Fare','value'=> $ride->ride_bill->base_fare);
                    $payment_details['charges'][] = array('name'=>'Distance Charges','value'=> number_format($ride->ride_bill->distance*$ride->ride_bill->cost_per_mile,2));
                    $payment_details['charges'][] = array('name'=>'Duration Charges','value'=> number_format($ride->ride_bill->duration*$ride->ride_bill->cost_per_minute),2);
                    $payment_details['charges'][] = array('name'=>'Tip Charges','value'=> $ride->ride_bill->tip);

                    if($ride->ride_bill->black_car_finder_fee>0)
                        $payment_details['charges'][] = array('name'=>'Black Car Fund','value'=> number_format($black_car_finder_charges,2)); 
                    if($ride->ride_bill->new_york_city_fee>0)
                        $payment_details['charges'][] = array('name'=>'New York City Fund','value'=> number_format($new_york_city_charges,2)); 
                    if($ride->ride_bill->other_charges>0)
                        $payment_details['charges'][] = array('name'=>'Other Charges','value'=> $ride->ride_bill->other_charges);            
                    if($ride->ride_bill->meet_greet_fee>0)
                        $payment_details['charges'][] = array('name'=>'Meet & Greet Charges','value'=> $ride->ride_bill->meet_greet_fee);
                    
                    
                }else{
                    $payment_details = null;
                }
                $ride->payment_details = $payment_details;

                $response['ride'] =  $ride;


                Log::info('Ride Completed: ', $ride->toArray()); 
                $this->sendNotificationByUserId($ride->rider_id,'Ride Completed','Ride completed',['ride_id'=>$ride->id,'type' => 'ride_completed']);
                return response()->json($response, 200);
                }
                
                $response['message'] =  'Address not found';
            
        }else{
            $response['message'] =  'Ride not found against id';
        }
        
  
        $response['status'] =  false;        
        return response()->json($response, 200);    
    }

    public function testNotification(Request $request)
    {       
        $validator = Validator::make($request->all(), [
            'message' => 'required',            
            'token' => 'required',           
            'device_type' => 'required'            
        ]);

        if ($validator->fails()){
            $response['error'] = $validator->errors()->first();
            return response()->json($response, 200); 
        }

        $title = $request->title;
        $message = $request->message;
        $content = ['message' => $message,'ride_id' => 1,'type' => 'ride_started'];
        $response = $this->sendNotification($title,$message,$content,$request->token,$request->device_type);

        return response()->json($response, 200);
    }

    private function sendNotificationByUserId($user_id,$title,$message,$content)
    {
        $user = User::with('device')->find($user_id);
        if($user){
            if(isset($user->device->token))
            $this->sendNotification($title,$message,$content,$user->device->token,$user->device->user_device);
        }
    }

    private function sendNotification($title,$message,$content,$token,$device='android')
    {

         if($device=='android'){

            $push = new \Edujugon\PushNotification\PushNotification('fcm');        
            $response = $push->setMessage([
                'notification' => [
                    'title' => $title,
                    'sound' => 'default'
                ],
                'data' => [
                    'message' => $message,
                    'content' => $content,
                    'action' => @$content['type']
                ]
            ])->setDevicesToken([$token])  
            ->send()
            ->getFeedback();

        }else{   


            $fcmUrl = 'https://fcm.googleapis.com/fcm/send';
            $token=$token;

            $notification = [
                'title' => $title,
                'sound' => true,
                'body' => $message
            ];
            
            $fcmNotification = [                
                'to'        => $token, //single token
                'notification' => $notification,
                'data' => $content
            ];

            $headers = [
                'Authorization: key=AIzaSyAXg4EL0fKk2RHM304SCBRkApTMKwLeSt8',
                'Content-Type: application/json'
            ];


            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL,$fcmUrl);
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fcmNotification));
            $response = json_decode(curl_exec($ch));
            curl_close($ch);


            // $push = new \Edujugon\PushNotification\PushNotification('fcm');        
            // $data = $push->setMessage([
            //     'aps' => [
            //         'alert' => [
            //             'title' => $message,
            //             'body' => $message
            //         ],
            //         'sound' => 'default',
            //         'badge' => 1                    
            //     ],
            //     'extraPayLoad' => $content
            // ])->setDevicesToken([$token])  
            // ->send()
            // ->getFeedback();
            // ->setApiKey('AIzaSyAXg4EL0fKk2RHM304SCBRkApTMKwLeSt8') 
            // ->setConfig([
            //       'certificate' => config_path('iosCertificates/AlpharidesCertificates.pem'),
            //       'passPhrase' => '1234', //Optional
            //       'passFile' => __DIR__ . '/iosCertificates/yourKey.pem', //Optional
            //       'dry_run' => false
            //   ])                     
            
        }    

        $content['device_token'] = $token;
        $content['device_type'] = $device;        
        Log::info('FCM Notification Request: ',$content);        
        Log::info('FCM Notification Response: ', collect($response)->toArray());        
        

        return $response;
    }

    private function updateRideStatus($ride_id,$status='pending')
    {
        $ride = Ride::find($ride_id);
        if($ride){
            $ride->status = $status;
            $ride->save();

            $ride_status = RideStatus::where(['ride_id'=>$ride_id,'status'=>$status])->first();
            if(!$ride_status)
                RideStatus::create(['ride_id'=>$ride_id,'status'=>$status]);
        }
    }
    
    public function rideRating(Request $request)
    {
        $response['status'] = false;
        
        $validator = Validator::make($request->all(), [
            'ride_id' => 'required',
            'rating' => 'required|in:0,1,2,3,4,5'          
        ]);


        if ($validator->fails()){
            $response['error'] = $validator->errors()->first();
            return response()->json($response, 200); 
        }
        
        $ride = Ride::find($request->ride_id);

        if($ride){
            $user_id = Auth::id();
            if($ride->rider_id==$user_id){
                $ride_rating['user_id'] = $ride->driver_id;

                $message = 'Rider gives you '.$request->rating.' star';
                $this->sendNotificationByUserId($ride->driver_id,$message,$message,['ride_id'=>$ride->id,'type' => 'rider_review_to_driver']);

            }
            else
                $ride_rating['user_id'] = $ride->rider_id; 
            

            $ride_rating['ride_id'] = $ride->id;                                       
            $rating = Rating::firstOrNew($ride_rating);
            $rating->rating = $request->rating;
            $rating->review = @$request->review;
            $rating->save();

            $response['status'] =  true;   
        }


        return response()->json($response, 200); 
        
    }

    public function getInProgressRide()
    {

        $response['status'] = false;

        $user_id = Auth::id();
        $user = User::with('user_card')->find($user_id);

        if($user){

            if($user->user_card){
                $user_card = $user->user_card;
                if(strtotime($user_card->expiry_year."-".$user_card->expiry_month) < strtotime(date("Y-m")))
                {
                    $response['card_status'] = false;
                }else{
                    $response['card_status'] = true;
                }
            }else{
                $response['card_status'] = false;
            } 

            if($user->user_type=="rider"){
                $ride = Ride::with(
                    'driver.driver_location',
                    'rider',
                    'ride_bill',
                    'ratings')->where('rider_id',$user_id)->whereNotIn('status',['canceled'])->orderBy('id','desc')->first();                

                if(@$ride->ride_bill){
                    $ride_bill = $ride->ride_bill;
                    if($ride_bill->payment_status=="done"){
                        $ride = [];
                    }else if($ride_bill->payment_response!=null){
                        $payment_response = json_decode($ride_bill->payment_response);
                        
                        if(@$payment_response->errors){
                            $ride->payment_error_message = "Your payment is not successfully deducted please go to your trip history and pay";
                            $payment_errors = $payment_response->errors;                            
                            if(@$payment_errors->error[0]->errorCode>0){
                                $ride->payment_error_message =  @$payment_errors->error[0]->errorText;     
                            }
                                
                        }
                        
                    }
                }
            }
            else{
                $ride = Ride::with('driver.driver_location','rider','ride_bill','ratings')->where('driver_id',$user_id)->whereNotIn('status',['completed','canceled'])->orderBy('id','desc')->first();
            }


            if($ride){
                $ride->driver->rating = number_format($ride->driver->ratings->avg('rating'),1)?:0;
                $ride->rider->rating = number_format($ride->rider->ratings->avg('rating'),1)?:0;
               
                unset($ride->driver->ratings);
                unset($ride->rider->ratings);

                $driver_rating = $ride->ratings->where('user_id',$ride->driver_id)->first();
                
                $ride->driver_rating = 0;
                if($driver_rating){
                    $ride->driver_rating = $driver_rating->rating;    
                }

                $rider_rating = $ride->ratings->where('user_id',$ride->rider_id)->first();
                
                $ride->rider_rating = 0;
                if($rider_rating){
                    $ride->rider_rating = $rider_rating->rating;    
                }

                if(isset($ride->driver->profile_image) && ($ride->driver->profile_image!="")){
                    $ride->driver->profile_thumbnail = checkImage('users/thumbs/'. $ride->driver->profile_image);
                    $ride->driver->profile_image = checkImage('users/'. $ride->driver->profile_image); 
                }
                if(isset($ride->rider->profile_image) && ($ride->rider->profile_image!="")){
                    $ride->rider->profile_thumbnail = checkImage('users/thumbs/'. $ride->rider->profile_image);
                    $ride->rider->profile_image = checkImage('users/'. $ride->rider->profile_image); 
                }

                $response['status'] = true;
                $response['ride'] = $ride;

                
            }else
                $response['message'] =  'Ride not found'; 
        }else{
           $response['message'] =  'User not found against this id'; 
        }
        

       

     return response()->json($response, 200);    
    }

    public function getAllRides()
    {

        $response['status'] = false;

        $user_id = Auth::id();
        $user = User::find($user_id);
        if($user){
            if($user->user_type=="rider")
                $rides = Ride::with('driver','rider','category','ride_bill','ride_status')->where('rider_id',$user_id)->where('status','!=','pending')->orderBy('id','desc')->paginate(10);
            else
                $rides = Ride::with('driver','rider','category','ride_bill','ride_status')->where('driver_id',$user_id)->where('status','!=','pending')->orderBy('id','desc')->paginate(10);

            if($rides){
                $rides->map(function($ride){

                    
                    $ride->map_url = $this->getStaticGmapURLForDirection($ride->pickup_lat.','.$ride->pickup_lon, $ride->dropoff_lat.','.$ride->dropoff_lon);


                    if($ride->driver){
                        $ride->driver->rating = number_format($ride->driver->ratings->avg('rating'),1)?:0;
                        unset($ride->driver->ratings);
                    }
                    if($ride->rider){
                        $ride->rider->rating = number_format($ride->rider->ratings->avg('rating'),1)?:0;
                        unset($ride->rider->ratings);
                    }
                        
                    $driver_rating = $ride->ratings->where('user_id',$ride->driver_id)->first();
                    
                    $ride->driver_rating = 0;
                    if($driver_rating){
                        $ride->driver_rating = $driver_rating->rating;    
                    }

                    $rider_rating = $ride->ratings->where('user_id',$ride->rider_id)->first();
                    
                    $ride->rider_rating = 0;
                    if($rider_rating){
                        $ride->rider_rating = $rider_rating->rating;    
                    }
                    
                    if(isset($ride->driver->profile_image) && ($ride->driver->profile_image!="")){
                        $ride->driver->profile_thumbnail = checkImage('users/thumbs/'. $ride->driver->profile_image);
                        $ride->driver->profile_image = checkImage('users/'. $ride->driver->profile_image); 
                    }
                    if(isset($ride->rider->profile_image) && ($ride->rider->profile_image!="")){
                        $ride->rider->profile_thumbnail = checkImage('users/thumbs/'. $ride->rider->profile_image);
                        $ride->rider->profile_image = checkImage('users/'. $ride->rider->profile_image); 
                    }

                    return $ride;
                });
                

                $response['status'] = true;
                $response['rides'] = $rides;
            }else
                $response['message'] =  'Ride not found'; 
        }else{
           $response['message'] =  'User not found against this id'; 
        }
        
     return response()->json($response, 200);    
    }


    public function addUserAddress(Request $request)
    {
        $response['status'] = false;
        $response['message'] =  'Address not created';

        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'type' => 'required|in:home,work,place',          
            'latitude' => 'required',          
            'longitude' => 'required'          
        ]);


        if ($validator->fails()){
            $response['error'] = $validator->errors()->first();
            return response()->json($response, 200); 
        }

        $input = $request->all();
        $input['user_id'] = Auth::id();

        $user_address = UserAddress::create($input);
        if($user_address)
        {
            $response['status'] = true;
            $response['message'] =  'Address successfully created'; 
        }

        return response()->json($response, 200);
    }

    public function updateUserAddress(Request $request)
    {
        $response['status'] = false;
        $response['message'] =  'Address not updated';

        $validator = Validator::make($request->all(), [
            'user_address_id' => 'required',
            'name' => 'required',
            'type' => 'required|in:home,work,place',          
            'latitude' => 'required',          
            'longitude' => 'required'          
        ]);


        if ($validator->fails()){
            $response['error'] = $validator->errors()->first();
            return response()->json($response, 200); 
        }

        $input = $request->all();
        
        $user_address = UserAddress::where('user_id',Auth::id())->find($request->user_address_id);
        if($user_address)
        {

            $user_address->update($input);

            $response['status'] = true;
            $response['message'] =  'Address successfully updated'; 
        }

        return response()->json($response, 200);
    }

    public function getUserAddress()
    {
        $response['status'] = false;
        $response['message'] =  'Address not found';

        $user_id = Auth::id();

        $user_address = UserAddress::with('rider')->whereUserId($user_id)->get();
        if($user_address)
        {

            $response['user_address'] = $user_address;
            $response['status'] = true;            
        }

        return response()->json($response, 200);
    }

    public function getRideCancelationStatus()
    {
        $response['status'] =  false;

        $cancelation_period = settingValue('cancelation_period'); 
        
        $user_id = Auth::id();
        $user = User::find($user_id);
        if($user){
            if($user->user_type=="rider")
                $ride = Ride::with('category')->where('rider_id',$user_id)->orderBy('id','desc')->first();
            else
                $ride = Ride::with('category')->where('driver_id',$user_id)->orderBy('id','desc')->first();
    

            if($ride)
            {
                $response['status'] =  true;
                $response['cancelation_fee'] =  0;
                
                if(strtotime('now') >= strtotime('+3 minutes', strtotime($ride->created_at)))
                    $response['cancelation_fee'] =  $ride->category->cancelation_fee;
                
                
                // $response['ride'] = $ride;
            }else{
                $response['message'] =  'Ride not found'; 
            }
        }else{
            $response['message'] =  'User not found'; 
        }

        return response()->json($response, 200); 
    }

    public function rideCanceled()
    {

        $user_id = Auth::id();
        $user = User::find($user_id);
        if($user){
            if($user->user_type=="rider")
                $ride = Ride::with('category','ride_bill')->where('rider_id',$user_id)->orderBy('id','desc')->first();
            else
                $ride = Ride::with('category','ride_bill')->where('driver_id',$user_id)->orderBy('id','desc')->first();

            if($ride){


                $cancelation_fee =  0;

                $category = $ride->category;
                if($category){                    

                    $cancelation_period = settingValue('cancelation_period');
                    if($cancelation_period>0){
                        
                        $currentTime = Carbon::now();
                        $minute_diff = $currentTime->diffInMinutes($ride->created_at);
                        
                    
                        if($minute_diff > $cancelation_period){
                            $cancelation_fee =  $category->cancelation_fee;
                        }
                    }
                    
                }

                if($ride->driver_id==0)
                    $cancelation_fee=0;
                

                if($cancelation_fee>0){
                    $ride_bill['cancelation_charges'] = number_format($cancelation_fee,2);
                    $ride_bill['total_charges'] = number_format($cancelation_fee,2);
                    RideBill::updateOrCreate(['ride_id'=>$ride->id],$ride_bill);
                }


                $this->updateRideStatus($ride->id,'canceled');
                $ride->status = 'canceled';
                $ride->save();
                $response['status'] =  true;
                $response['message'] =  'Ride successfully canceled';
                $ride->refresh();
                $response['ride'] =  $ride;

                if($user->user_type=="rider") {
                    $payment_status = $this->chargeCreditCard($ride->id,'main');
                    if($payment_status['status']==1){                    
                        $message = 'Payment successfully deducted';
                    }elseif ($payment_status['status']==2) {
                        $message = 'Payment deduction failed';
                    }else{
                        $message = 'Charges not applied';                        
                    }
                    if($payment_status['status']==1 || $payment_status['status']==2){ 
                        $this->sendNotificationByUserId($ride->rider_id,$message,$message,['ride_id'=>$ride->id,'type' => 'payment_deducted']); 
                    }
                   
                }
                

                if($user->user_type=="rider") 
                    $this->sendNotificationByUserId($ride->driver_id,'Ride Canceled','Ride canceled',['ride_id'=>$ride->id,'type' => 'ride_canceled']);
                else
                    $this->sendNotificationByUserId($ride->rider_id,'Ride Canceled','Ride canceled',['ride_id'=>$ride->id,'type' => 'ride_canceled']);

                Log::info('Ride Canceled: ', $ride->toArray());
                return response()->json($response, 200);
                    
            }
        }
        
        $response['status'] =  false;
        $response['message'] =  'Ride not found';        
        return response()->json($response, 200);    
    }

    public function getCancelationReasons()
    {
        $reasons = CancelationReason::all();

        $response['status'] =  true;        
        $response['cancelation_reasons'] =  $reasons;        
        return response()->json($response, 200);
    }

    public function getRideDetails($ride_id)
    {
        $response['status'] =  false;        
        
        $ride = Ride::with('category','driver.driver_location','rider','ride_bill')->find($ride_id);
        if($ride){

            $ride->driver->rating = number_format($ride->driver->ratings->avg('rating'),1)?:0;
            $ride->rider->rating = number_format($ride->rider->ratings->avg('rating'),1)?:0;
           
            unset($ride->driver->ratings);
            unset($ride->rider->ratings);

            $driver_rating = $ride->ratings->where('user_id',$ride->driver_id)->first();
            
            $ride->driver_rating = 0;
            if($driver_rating){
                $ride->driver_rating = $driver_rating->rating;    
            }

            $rider_rating = $ride->ratings->where('user_id',$ride->rider_id)->first();
            
            $ride->rider_rating = 0;
            if($rider_rating){
                $ride->rider_rating = $rider_rating->rating;    
            }

            if(isset($ride->driver->profile_image) && ($ride->driver->profile_image!="")){
                $ride->driver->profile_thumbnail = checkImage('users/thumbs/'. $ride->driver->profile_image);
                $ride->driver->profile_image = checkImage('users/'. $ride->driver->profile_image); 
            }
            if(isset($ride->rider->profile_image) && ($ride->rider->profile_image!="")){
                $ride->rider->profile_thumbnail = checkImage('users/thumbs/'. $ride->rider->profile_image);
                $ride->rider->profile_image = checkImage('users/'. $ride->rider->profile_image); 
            }

            
            
            if($ride->ride_bill){
                $payment_details['total_charges'] = $ride->ride_bill->total_charges;
                $payment_details['charges'][] = array('name'=>'Base Fare','value'=> $ride->ride_bill->base_fare);
                $payment_details['charges'][] = array('name'=>'Distance Charges','value'=> number_format($ride->ride_bill->distance*$ride->ride_bill->cost_per_mile,2));
                $payment_details['charges'][] = array('name'=>'Duration Charges','value'=> number_format($ride->ride_bill->duration*$ride->ride_bill->cost_per_minute,2));
                $payment_details['charges'][] = array('name'=>'Tip Charges','value'=> $ride->ride_bill->tip);

                if($ride->ride_bill->other_charges>0)
                    $payment_details['charges'][] = array('name'=>'Other Charges','value'=> $ride->ride_bill->other_charges);            
                if($ride->ride_bill->meet_greet_fee>0)
                    $payment_details['charges'][] = array('name'=>'Meet & Greet Charges','value'=> $ride->ride_bill->meet_greet_fee);
                
                
            }else{
                $payment_details = null; 
            }
            $ride->payment_details = $payment_details;

            $response['status'] =  true;        
            $response['ride'] =  $ride;

            
        }
                
        return response()->json($response, 200);
    }

    private function getStaticGmapURLForDirection($origin, $destination, $waypoints = [], $size = "500x500") {
        $markers = array();
        $waypoints_labels = array("A", "B", "C", "D", "E", "F", "G", "H", "I", "J", "K");
        $waypoints_label_iter = 0;
        $markers[] = "markers=color:green" . urlencode("|") . "label:" . urlencode($waypoints_labels[$waypoints_label_iter++] . '|' . $origin);
        foreach ($waypoints as $waypoint) {
            $markers[] = "markers=color:blue" . urlencode("|") . "label:" . urlencode($waypoints_labels[$waypoints_label_iter++] . '|' . $waypoint);
        }
        $markers[] = "markers=color:red" . urlencode("|") . "label:" . urlencode($waypoints_labels[$waypoints_label_iter] . '|' . $destination);
        $url = "https://maps.googleapis.com/maps/api/directions/json?mode=driving&origin=$origin&destination=$destination&key=AIzaSyBfe1Nw8nQENKRT9WcLlz7Uu0wTlrrFLQU";
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, false);
        $result = curl_exec($ch);
        curl_close($ch);
        $googleDirection = json_decode($result, true);
        
        if($googleDirection['status']=="OK"){
            $polyline = urlencode($googleDirection['routes'][0]['overview_polyline']['points']);
            $markers = implode($markers, '&');
            
            return "https://maps.googleapis.com/maps/api/staticmap?size=$size&maptype=roadmap&path=enc:$polyline&$markers";
        }else{
            return null;
        }
            
    
    }

    public function paymentFallback(Request $request)
    {
        ini_set('max_execution_time', 300);

        $response['status'] = false;
        
        $validator = Validator::make($request->all(), [
            'ride_id' => 'required'          
        ]);



        if ($validator->fails()){
            $response['error'] = $validator->errors()->first();
            return response()->json($response, 200); 
        }

        $driver_id = Auth::id();
        $ride = Ride::with('category','ride_bill')->find($request->ride_id);

        if($ride){
            $response['status'] =  true;

            sleep(120);
               
            $ride_bill = RideBill::where('ride_id',$ride->id)->first();
            
            if($ride_bill){                                  
                if($ride_bill->payment_status=="pending"){
                    
                    $payment_status = $this->chargeCreditCard($ride->id,'main');
                    if($payment_status['status']==1){
                        Log::info('Payment completed: ', $ride->toArray());
                        $message = 'Payment successfully deducted';
                    }elseif ($payment_status['status']==2) {
                        $message = 'Payment deduction failed';
                    }


                    if($payment_status['status']==1 || $payment_status['status']==3){ 
                        $this->sendNotificationByUserId($ride->driver_id,$message,$message,['ride_id'=>$ride->id,'type' => 'payment_deducted']);
                        $this->sendNotificationByUserId($ride->rider_id,$message,$message,['ride_id'=>$ride->id,'type' => 'payment_deducted']);
                    }
                }
                
            }

        }else{
            $response['message'] =  'Ride not found against id';
        }
        
  
                
        return response()->json($response, 200);    
    }

    public function paidTipByRider(Request $request)
    {
        $response['status'] = false;
        
        $validator = Validator::make($request->all(), [
            'ride_id' => 'required',          
            'tip_amount' => 'required|numeric'          
        ]);


        if ($validator->fails()){
            $response['error'] = $validator->errors()->first();
            return response()->json($response, 200); 
        }

        $ride = Ride::with('category','ride_bill')->find($request->ride_id);

        if($ride){
            $response['status'] =  true;

            $ride_bill = RideBill::where('ride_id',$ride->id)->first();
            
            if($ride_bill){
                $currentTime = Carbon::now();

                if($currentTime->diffInSeconds($ride_bill->created_at)<=120){


                    $new_tip = $request->tip_amount-$ride_bill->tip;
                    
                    //$ride_bill->payment_status = "done";
                    $ride_bill->tip = $request->tip_amount;
                    $ride_bill->total_charges = $ride_bill->total_charges + $new_tip;
                    $ride_bill->save();
                    $ride->refresh();

                    $payment_status = $this->chargeCreditCard($ride->id,'main');
                    if($payment_status['status']==1){
                        Log::info('Tip paid: ', $ride->toArray()); 
                        $this->sendNotificationByUserId($ride->driver_id,'Tip Paid','Tip Paid',['ride_id'=>$ride->id,'type' => 'tip_paid']);
                    }elseif ($payment_status['status']==3) {

                    }else{
                        Log::info('Tip not paid: ', $ride->toArray()); 
                        $this->sendNotificationByUserId($ride->rider_id,'Tip not Paid','Tip not Paid',['ride_id'=>$ride->id,'type' => 'tip_paid']);
                    }

                    

                }else{
                    $response['status'] = false;
                    $response['message'] =  'Sorry payment is already deducted';
                }
                
            }

            if($ride->ride_bill){
                $payment_details['total_charges'] = $ride->ride_bill->total_charges;
                $payment_details['charges'][] = array('name'=>'Base Fare','value'=> $ride->ride_bill->base_fare);
                $payment_details['charges'][] = array('name'=>'Distance Charges','value'=> number_format($ride->ride_bill->distance*$ride->ride_bill->cost_per_mile,2));
                $payment_details['charges'][] = array('name'=>'Duration Charges','value'=> number_format($ride->ride_bill->duration*$ride->ride_bill->cost_per_minute,2));
                $payment_details['charges'][] = array('name'=>'Tip Charges','value'=> $ride->ride_bill->tip);

                if($ride->ride_bill->other_charges>0)
                    $payment_details['charges'][] = array('name'=>'Other Charges','value'=> $ride->ride_bill->other_charges);            
                if($ride->ride_bill->meet_greet_fee>0)
                    $payment_details['charges'][] = array('name'=>'Meet & Greet Charges','value'=> $ride->ride_bill->meet_greet_fee);
                
                
            }else{
                $payment_details = null;
            }
            $response['payment_details'] =  $payment_details;

        }else{
            $response['message'] =  'Ride not found against id';
        }
        
  
                
        return response()->json($response, 200);    
    }

    public function scheduleRide(Request $request)
    {


        $response['status'] = false;
        
        $validator = Validator::make($request->all(), [
            'pickup_lat' => 'required', 
            'pickup_lon' => 'required',
            'dropoff_lat' => 'required', 
            'dropoff_lon' => 'required',            
            'category_id' => 'required',           
            'ride_date' => 'required|date_format:Y-m-d H:i:s|after:' . date('Y-m-d H:i:s',strtotime('+60 minutes', strtotime('now')))          
        ]);



        if ($validator->fails()){
            $response['error'] = $validator->errors()->first();
            return response()->json($response, 200); 
        }

        $user_id = Auth::id();        
        $category_id = $request->category_id;

        $category = Categories::find($category_id);

        if($category){
            
            $ride['rider_id'] = $user_id;            
            $ride['category_id'] = $category->id;
            $ride['pickup_lat'] = $request->pickup_lat;
            $ride['pickup_lon'] = $request->pickup_lon;
            $ride['dropoff_lat'] = $request->dropoff_lat;
            $ride['dropoff_lon'] = $request->dropoff_lon;
            $ride['ride_date'] = $request->ride_date;            
            $ride_id = ScheduleRide::create($ride);

            if($ride_id){

                $user = @$ride_id->rider;
                if($user){
                    Notification::send($user, new ScheduleRideNotification($ride_id)); 
                    Notification::send($user, new ScheduleRideAdminNotification($ride_id,settingValue('email'))); 
                }
                
                $response['status'] =  true;
                $response['message'] =  'Ride successfully created';
            }else{
                $response['message'] =  'Ride not successfully created';                        
            }
        }else{
            $response['message'] =  'Category not found against id';
        }
        
        return response()->json($response, 200);    
    }

    public function getScheduleRides()
    {

        $response['status'] = false;

        $user_id = Auth::id();
        
        $rides = ScheduleRide::with('rider','category')->where(['rider_id'=>$user_id,'status'=>'pending'])->orderBy('id','desc')->get();
        if($rides){
            $rides->map(function($ride){

                
                $ride->map_url = $this->getStaticGmapURLForDirection($ride->pickup_lat.','.$ride->pickup_lon, $ride->dropoff_lat.','.$ride->dropoff_lon);


                $ride->rider->rating = number_format($ride->rider->ratings->avg('rating'),1)?:0;
               
                unset($ride->rider->ratings);
                
                if(isset($ride->rider->profile_image) && ($ride->rider->profile_image!="")){
                    $ride->rider->profile_thumbnail = checkImage('users/thumbs/'. $ride->rider->profile_image);
                    $ride->rider->profile_image = checkImage('users/'. $ride->rider->profile_image); 
                }

                $ride->estimate_fare = 0;

                $pickup_lat = $ride->pickup_lat;
                $pickup_lon = $ride->pickup_lon;
                $dropoff_lat = $ride->dropoff_lat;
                $dropoff_lon = $ride->dropoff_lon;

                $category = $ride->category;
                if($category){
                    $url = "https://maps.googleapis.com/maps/api/distancematrix/json?units=imperial&origins=".$pickup_lat.",".$pickup_lon."&destinations=".$dropoff_lat.",".$dropoff_lon."&departure_time=now&key=AIzaSyBfe1Nw8nQENKRT9WcLlz7Uu0wTlrrFLQU"; 
                    $ch = curl_init();  
                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
                    curl_setopt($ch, CURLOPT_URL, $url); 

                    $result = curl_exec($ch); 
                    
                    $address = json_decode($result);
                    
                    if($address->status=="OK"){
                        

                        $distance = $address->rows[0]->elements[0]->distance->text;
                        $distance = explode(' ', $distance);
                        $distance = (double) $distance[0];

                        $duration_in_traffic = ceil($address->rows[0]->elements[0]->duration_in_traffic->value/60);

                        $total_charges = $category->base_fare;
                        $total_charges = $total_charges + ($distance*$category->cost_per_mile);
                        $total_charges = $total_charges + ($duration_in_traffic*$category->cost_per_minute);
                        $total_charges = $total_charges + $category->advance_booking_fee;
                        

                        $ride->estimate_fare = number_format($total_charges,2);  
                    }
                }

                return $ride;
            });
            

            $response['status'] = true;
            $response['rides'] = $rides;
        }else
            $response['message'] =  'Ride not found'; 
       
        
     return response()->json($response, 200);    
    }

    public function getScheduleRideCancelationStatus(Request $request)
    {
        
        $response['status'] = false;
        
        $validator = Validator::make($request->all(), [
            'ride_id' => 'required'            
        ]);

        if ($validator->fails()){
            $response['error'] = $validator->errors()->first();
            return response()->json($response, 200); 
        }
        
        $user_id = Auth::id();
        $user = User::find($user_id);
        if($user){
            $ride = ScheduleRide::with('category')->where('rider_id',$user_id)->find($request->ride_id);           

            if($ride)
            {
                $response['status'] =  true;
                $response['advance_booking_fee'] =  0;
                $response['cancelation_fee'] =  0;
                $response['total_charges'] =  0;
                
                $category = $ride->category;
                if($category){
                    $cancelation_fee = 0;

                    if($category->cancel_schedule_ride_min_period>0 && $category->cancel_schedule_ride_max_period>0){
                        
                        $currentTime = Carbon::now();
                        $minute_diff = $currentTime->diffInMinutes($ride->ride_date);

                        if($minute_diff < ($category->cancel_schedule_ride_max_period*60) && $minute_diff >= ($category->cancel_schedule_ride_min_period*60)){

                            $cancelation_fee = $cancelation_fee +  $category->advance_booking_fee;

                            $response['advance_booking_fee'] =  $category->advance_booking_fee;
                            $response['total_charges'] =  $cancelation_fee;
                        }else if($minute_diff < ($category->cancel_schedule_ride_min_period*60)){

                            $cancelation_fee = $cancelation_fee +  $category->advance_booking_fee;
                            $cancelation_fee = $cancelation_fee +  $category->sr_cancelation_fee;

                            $response['advance_booking_fee'] =  $category->advance_booking_fee;
                            $response['cancelation_fee'] =  $category->sr_cancelation_fee;
                            $response['total_charges'] =  $cancelation_fee;
                        }
                    }
                    
                }
                
            }else{
                $response['message'] =  'Ride not found'; 
            }
        }else{
            $response['message'] =  'User not found'; 
        }

        return response()->json($response, 200); 
    }

    public function cancelScheduleRide(Request $request)
    {
        
        $response['status'] = false;
        
        $validator = Validator::make($request->all(), [
            'ride_id' => 'required'            
        ]);

        if ($validator->fails()){
            $response['error'] = $validator->errors()->first();
            return response()->json($response, 200); 
        }

        $user_id = Auth::id();
        $user = User::find($user_id);
        if($user){
            $ride = ScheduleRide::with('category')->where('rider_id',$user_id)->find($request->ride_id);
            
            if($ride){

                $advance_booking_fee =  0;
                $cancelation_fee =  0;

                $category = $ride->category;
                if($category){
                    $cancelation_fee = 0;

                    if($category->cancel_schedule_ride_min_period>0 && $category->cancel_schedule_ride_max_period>0){
                        
                        $currentTime = Carbon::now();
                        $minute_diff = $currentTime->diffInMinutes($ride->ride_date);
                        

                        if($minute_diff < ($category->cancel_schedule_ride_max_period*60) && $minute_diff >= ($category->cancel_schedule_ride_min_period*60)){
                                $advance_booking_fee =  $category->advance_booking_fee;
                        }else if($minute_diff < ($category->cancel_schedule_ride_min_period*60)){

                            $advance_booking_fee =  $category->advance_booking_fee;
                            $cancelation_fee =  $category->sr_cancelation_fee;
                            
                        }
                    }
                    
                }
                $total_charges = $advance_booking_fee+$cancelation_fee;
                $ride->advance_booking_fee = $advance_booking_fee;
                $ride->cancelation_fee = $cancelation_fee;
                $ride->status = 'canceled';
                $ride->save();
                $response['status'] =  true;
                $response['message'] =  'Ride successfully canceled';
                $ride->refresh();
                $response['ride'] =  $ride;
                $response['ride']['total_charges'] =  $total_charges;

                $payment_status = $this->chargeCreditCard($ride->id,'schedule');
                if($payment_status['status']==1){                    
                    $message = 'Payment successfully deducted';
                }elseif ($payment_status['status']==3) {
                    
                }else{
                    $message = 'Payment deduction failed';
                }
                if($payment_status['status']==1 || $payment_status['status']==2){ 
                    $this->sendNotificationByUserId($ride->rider_id,$message,$message,['ride_id'=>$ride->id,'type' => 'payment_deducted']); 
                }

                if($total_charges>0){
                    $payment_details['total_charges'] = $total_charges;
                    if($advance_booking_fee>0)
                        $payment_details['charges'][] = array('name'=>'Advance Booking Fee','value'=> $advance_booking_fee);
                    if($cancelation_fee>0)
                        $payment_details['charges'][] = array('name'=>'Cancelation Fee','value'=> $cancelation_fee);
                    
                }else{
                    $payment_details = null;
                }
                $response['ride']['payment_details'] =  $payment_details;


                Log::info('Scheduled Ride Canceled: ', $ride->toArray());
                return response()->json($response, 200);
                    
            }
        }
        
        $response['status'] =  false;
        $response['message'] =  'Ride not found';        
        return response()->json($response, 200);    
    }

    public function updateUserCardInfo(Request $request)
    {
        $response['status'] = false;
        
        $validator = Validator::make($request->all(), [
            'card_number' => 'required', 
            'expiry_month' => 'required',            
            'expiry_year' => 'required',            
            'cv_code' => 'required'            
        ]);


        if ($validator->fails()){
            $response['error'] = $validator->errors()->first();
            return response()->json($response, 200); 
        }

        $user_id = Auth::id();

        $user_card = UserCardInfo::updateOrCreate(['user_id' => $user_id]);
        $user_card->card_number = $request->card_number;
        $user_card->expiry_month = $request->expiry_month;
        $user_card->expiry_year = $request->expiry_year;
        $user_card->cv_code = $request->cv_code;
        $user_card->save();
               
        $response['status'] =  true;
        $response['message'] =  'User card information successfully updated.';
        
        $rides = Ride::with('ride_bill')->where('rider_id',$user_id);
        $rides->whereHas('ride_bill',function($query) {
            $query->where('payment_status','pending');
        });
        $failed_ride = $rides->first();
        if($failed_ride){
            if($failed_ride->ride_bill->payment_response!=null){
                $payment_response = json_decode($failed_ride->ride_bill->payment_response);
                
                if(@$payment_response->errors){
                    $this->chargeCreditCard($failed_ride->id,'main');   
                }
                
            }
        }

        Log::info('Update User Card Info Request: ',$request->all());        
        Log::info('Update User Card Info Response: ', $response);             
        
        return response()->json($response, 200);    
    }

    public function payPendingRidePayment($ride_id)
    {
        $response['status'] = false;
        $ride = Ride::with('ride_bill')->find($ride_id);
        if($ride){            
            if($ride->ride_bill->payment_status=='pending'){
                $payment_status = $this->chargeCreditCard($ride->id,'main'); 
                if($payment_status['status']==1){                    
                    $message = 'Payment successfully deducted';
                    $response['status'] = true;
                }elseif ($payment_status['status']==2) {
                    $message = 'Payment deduction failed';
                }else{
                    $message = 'Charges not applied';
                    $response['status'] = true;   
                }
                if($payment_status['status']==1 || $payment_status['status']==2){ 
                    $this->sendNotificationByUserId($ride->rider_id,$message,$message,['ride_id'=>$ride->id,'type' => 'payment_deducted']);
                    $response['message'] = $message; 
                }    
                
                
            }else{
                $response['message'] = 'Payment already deducted';
            }
        }else{
            $response['message'] = 'Ride not found';
        }
        
       return response()->json($response, 200); 
    }

    public function chargeCreditCard1($ride_id){
        $payment_status = $this->chargeCreditCard($ride_id,'main');
        print_r($payment_status);
        exit;
        dd($payment_status['status']);
    }

    private function chargeCreditCard($ride_id,$ride_type='main')
    {
        $response['status'] = false;
        $ride_amount = 0;
        if($ride_type=='main'){
            $ride = Ride::with('driver','rider.user_card','category','ride_bill','ride_status')->find($ride_id);
            if($ride){
                if($ride->ride_bill){
                    $ride_bill = $ride->ride_bill;

                    if($ride_bill->payment_status=="pending"){
                        $ride_amount = $ride_bill->total_charges;                        
                    }                
                }
            }
        }elseif($ride_type=='schedule'){
            $ride = ScheduleRide::with('rider.user_card','category')->find($ride_id);
            if($ride){        
                if($ride->payment_status=="pending"){
                    if($ride->advance_booking_fee>0){
                        $ride_amount = $ride->advance_booking_fee + $ride->cancelation_fee;      
                    }                       
                }
                                        
            }
        }
        //dd($ride->toArray());
        if($ride_amount>0){

            
            $merchantAuthentication = new AnetAPI\MerchantAuthenticationType();
            $merchantAuthentication->setName("2DZxTH75p6");
            $merchantAuthentication->setTransactionKey("77VrWpjh53733B5b");
            
            // Set the transaction's refId
            $refId = 'ref' . time();
            // Create the payment data for a credit card
            
            if(@$ride->rider->user_card){
                $rider = $ride->rider;
                $user_card = $rider->user_card;

                //dd($ride->toArray());
                //dd($user_card->toArray());

                $creditCard = new AnetAPI\CreditCardType();
                $creditCard->setCardNumber($user_card->card_number);
                $creditCard->setExpirationDate($user_card->expiry_year.'-'.$user_card->expiry_month);
                $creditCard->setCardCode($user_card->cv_code);
                // Add the payment data to a paymentType object
                $paymentOne = new AnetAPI\PaymentType();
                $paymentOne->setCreditCard($creditCard);
                // Create order information
                $order = new AnetAPI\OrderType();
                $order->setInvoiceNumber($ride->id);
                $order->setDescription(@$ride->category->name);
                // Set the customer's Bill To address
                $customerAddress = new AnetAPI\CustomerAddressType();
                $customerAddress->setFirstName($rider->name);
                $customerAddress->setLastName("");
                $customerAddress->setCompany("Alpha Rides");
                $customerAddress->setAddress("New York");
                $customerAddress->setCity("New York");
                $customerAddress->setState("NY");
                $customerAddress->setZip("10006");
                $customerAddress->setCountry("USA");
                // Set the customer's identifying information
                $customerData = new AnetAPI\CustomerDataType();
                $customerData->setType("individual");
                $customerData->setId($rider->id);
                $customerData->setEmail($rider->email);
                // Add values for transaction settings
                $duplicateWindowSetting = new AnetAPI\SettingType();
                $duplicateWindowSetting->setSettingName("duplicateWindow");
                $duplicateWindowSetting->setSettingValue("60");
                // Add some merchant defined fields. These fields won't be stored with the transaction,
                // but will be echoed back in the response.
                //$merchantDefinedField1 = new AnetAPI\UserFieldType();
                //$merchantDefinedField1->setName("customerLoyaltyNum");
                //$merchantDefinedField1->setValue("1128836273");
                //$merchantDefinedField2 = new AnetAPI\UserFieldType();
                //$merchantDefinedField2->setName("favoriteColor");
                //$merchantDefinedField2->setValue("blue");
                // Create a TransactionRequestType object and add the previous objects to it
                $transactionRequestType = new AnetAPI\TransactionRequestType();
                $transactionRequestType->setTransactionType("authCaptureTransaction");
                $transactionRequestType->setAmount($ride_amount);
                $transactionRequestType->setOrder($order);
                $transactionRequestType->setPayment($paymentOne);
                $transactionRequestType->setBillTo($customerAddress);
                $transactionRequestType->setCustomer($customerData);
                $transactionRequestType->addToTransactionSettings($duplicateWindowSetting);
                //$transactionRequestType->addToUserFields($merchantDefinedField1);
                //$transactionRequestType->addToUserFields($merchantDefinedField2);
                // Assemble the complete transaction request
                $request = new AnetAPI\CreateTransactionRequest();        
                $request->setMerchantAuthentication($merchantAuthentication);
                $request->setRefId($refId);
                $request->setTransactionRequest($transactionRequestType);
                // Create the controller and get the response
                $controller = new AnetController\CreateTransactionController($request);

                $t_response = $controller->executeWithApiResponse(\net\authorize\api\constants\ANetEnvironment::PRODUCTION);
               
                if ($t_response != null) {
                    // Check to see if the API request was successfully received and acted upon
                    if ($t_response->getMessages()->getResultCode() == "Ok") {
                        // Since the API request was successful, look for a transaction response
                        // and parse it to display the results of authorizing the card
                        $tresponse = $t_response->getTransactionResponse();

                        if ($tresponse != null && $tresponse->getMessages() != null) {

                            if($ride_type=='main'){
                                $ride->ride_bill->payment_status = 'done';
                                $ride->ride_bill->payment_response = json_encode($tresponse);
                                $ride->ride_bill->save();                                
                             }else{
                                $ride->payment_status = 'done';
                                $ride->payment_response = json_encode($tresponse);
                                $ride->save(); 
                             } 

                            Log::info('Successfully transaction: Ride ID('.$ride->id.') :',json_decode(json_encode($tresponse), true)); 
                            $response['status'] = 1;
                            return $response;
                        } else {
                            
                            if($ride_type=='main'){                                
                                $ride->ride_bill->payment_response = json_encode($tresponse);
                                $ride->ride_bill->save();                                
                             }else{                            
                                $ride->payment_response = json_encode($tresponse);
                                $ride->save(); 
                             } 
                            Log::info('Transaction Failed: Ride ID('.$ride->id.') :',json_decode(json_encode($tresponse), true)); 
                        }
                        // Or, print errors if the API request wasn't successful
                    } else {

                        
                        $tresponse = $t_response->getTransactionResponse();

                        if ($tresponse != null && $tresponse->getErrors() != null) {
                            if($ride_type=='main'){                                
                                $ride->ride_bill->payment_response = json_encode($tresponse);
                                $ride->ride_bill->save();                                
                             }else{                            
                                $ride->payment_response = json_encode($tresponse);
                                $ride->save(); 
                             } 
                             Log::info('Transaction Failed: Ride ID('.$ride->id.') :',json_decode(json_encode($tresponse), true));
                        } else {
                            if($ride_type=='main'){                                
                                $ride->ride_bill->payment_response = json_encode($t_response);
                                $ride->ride_bill->save();                                
                             }else{                            
                                $ride->payment_response = json_encode($t_response);
                                $ride->save(); 
                             } 
                            Log::info('Transaction Failed: Ride ID('.$ride->id.') :',json_decode(json_encode($t_response), true));
                        }

                    }
                } else {
                    Log::info('Transaction Failed: Ride ID('.$ride->id.') No response returned');
                    $response['status'] = 2;
                }
            }else{
                if($ride_type=='main'){                                
                    $ride->ride_bill->payment_response = json_encode($t_response);
                    $ride->ride_bill->save();                                
                 }else{                            
                    $ride->payment_response = json_encode($t_response);
                    $ride->save(); 
                 } 
                Log::info('Transaction: Ride ID('.$ride->id.') Rider card not found',json_decode(json_encode($t_response), true));
                $response['status'] = 2;                        
            }
            
            
        }else{
            Log::info('Transaction: Ride ID('.$ride->id.') Ride charges is zero');
            $response['status'] = 3;                    
        }

                
        return $response;

    }

    public function sendScheduleRideNotification()
    {
        //echo date("d-m-Y H:i:s");
        $rides = ScheduleRide::with('rider')->where('status','pending')->get();

        foreach($rides as $ride){
            $currentTime = Carbon::now();
            $minute_diff = $currentTime->diffInMinutes($ride->ride_date);
            if($minute_diff==60 || $minute_diff==720 || $minute_diff==1440){
                $user = @$ride->rider;
                if($user){
                    Notification::send($user, new ScheduleRideNotification($ride)); 
                    Notification::send($user, new ScheduleRideAdminNotification($ride,settingValue('email'))); 
                }  
            }
                
        }
        
    }

    public function rideRequest(Request $request)
    {


        $response['status'] = false;
        
        $validator = Validator::make($request->all(), [
            'name' => 'required',            
            'email' => 'required|email',            
            'phone_number' => 'required',            
            'pickup_date' => 'required',            
            'pickup_time' => 'required',            
            'pickup_location' => 'required',            
            'dropoff_location' => 'required'        
        ]);

        if ($validator->fails()){
            $response['error'] = $validator->errors()->first();
            return response()->json($response, 200); 
        }
        
        $input = $request->all();
        $input->pickup_date = date('Y-m-d', strtotime($request->pickup_date));
        $input->pickup_time = date('H:i:s', strtotime($request->pickup_time));

        $ride = RideRequest::create($input);
        if($ride){      
            $response['status'] =  true;
            $response['message'] = 'Ride request successfully sent';
            return response()->json($response, 200);
        }else{
            $response['message'] = 'Ride not created';
        }
        
  
        $response['status'] =  false;
        
        return response()->json($response, 200);    
    }
    
    
    

}









