<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Categories;
use App\Models\DriverLocations;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('index');
//        \Session::flush();
        // $categories = Categories::take(4)->get();
        // return view('index',compact('categories'));
    }
    
        public function index1()
    {
//        \Session::flush();
        $categories = Categories::take(4)->get();
        return view('index',compact('categories'));
    }

    public function driverSignup()
    {
        return view('driver-signup');
    }

    public function login()
    {
        return view('login');
    }

    public function privacyPolicy()
    {
        return view('privacy-policy');
    }

    public function ride()
    {
        return view('ride');
    }
    
     public function products()
    {
        return view('our-products');
    }

    public function riderSignup()
    {
        return view('rider-signup');
    }

    public function termsConditions()
    {
        return view('terms-conditions');
    }

    public function aboutUs()
    {
        return view('about-us');
    }
    
    
    public function SampleContent()
    {
        return view('cheap-limo-black-car-service-nyc');
    }
    
    
     public function aboutUs1()
    {
        return view('about');
    }

    public function services()
    {
        return view('services');
    }
    
    public function otherservices()
    {
        return view('other-services');
    }

    public function newsroom()
    {
        return view('newsroom');
    }

    public function contactUs()
    {
        return view('contact-us');
    }

    public function calculateFare(Request $request)
    {
        $pickup_lat = $request->pickup_lat;
        $pickup_lon = $request->pickup_lon;
        $dropoff_lat = $request->dropoff_lat;
        $dropoff_lon = $request->dropoff_lon;

        $categories = Categories::get();
        foreach ($categories as $key => $category) {
            $url = "https://maps.googleapis.com/maps/api/distancematrix/json?units=imperial&origins=".$pickup_lat.",".$pickup_lon."&destinations=".$dropoff_lat.",".$dropoff_lon."&departure_time=now&key=AIzaSyBfe1Nw8nQENKRT9WcLlz7Uu0wTlrrFLQU"; 
            $ch = curl_init();  
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
            curl_setopt($ch, CURLOPT_URL, $url); 

            $result = curl_exec($ch); 
            
            $address = json_decode($result);
                                
            if($address->status=="OK"){
                
                $distance = @$address->rows[0]->elements[0]->distance->text;
                if($distance!=""){

                    // $url = "https://maps.googleapis.com/maps/api/geocode/json?latlng=".$pickup_lat.",".$pickup_lon."&key=AIzaSyBfe1Nw8nQENKRT9WcLlz7Uu0wTlrrFLQU"; 
                    // $ch = curl_init();  
                    // curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
                    // curl_setopt($ch, CURLOPT_URL, $url); 

                    // $pickup_state = $dropoff_state = "";
                    // $result1 = curl_exec($ch); 
                    // $address1 = json_decode($result1);
                    // if($address1->status=="OK") {
                    //     for ($j=0;$j<count($address1->results[0]->address_components);$j++) {
                    //         $cn=array($address1->results[0]->address_components[$j]->types[0]);
                    //         if($address1->results[0]->address_components[$j]->long_name=="New York") {
                    //             $pickup_state = $address1->results[0]->address_components[$j]->long_name;
                    //         }
                    //     }
                    //  }

                    //  $url = "https://maps.googleapis.com/maps/api/geocode/json?latlng=".$dropoff_lat.",".$dropoff_lon."&key=AIzaSyBfe1Nw8nQENKRT9WcLlz7Uu0wTlrrFLQU"; 
                    // $ch = curl_init();  
                    // curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
                    // curl_setopt($ch, CURLOPT_URL, $url); 

                    // $result2 = curl_exec($ch); 
                    // $address2 = json_decode($result2);
                    // if($address1->status=="OK") {
                    //     for ($j=0;$j<count($address2->results[0]->address_components);$j++) {
                    //         $cn=array($address2->results[0]->address_components[$j]->types[0]);
                    //         if($address2->results[0]->address_components[$j]->long_name=="New York") {
                    //             $dropoff_state = $address2->results[0]->address_components[$j]->long_name;
                    //         }
                    //     }
                    //  }

                    $distance = explode(' ', $distance);
                    $distance = (double) $distance[0];

                    $duration_in_traffic = ceil($address->rows[0]->elements[0]->duration_in_traffic->value/60);

                    $total_charges = $category->base_fare;
                    $total_charges = $total_charges + ($distance*$category->cost_per_mile);
                    $total_charges = $total_charges + ($duration_in_traffic*$category->cost_per_minute);
                    
                    $category->black_car_charges = 0; 
                    $category->new_york_city_charges = 0; 
                    // if($pickup_state=="New York" && $dropoff_state=="New York"){
                    //     $black_car_finder_fee = $category->black_car_finder_fee;
                    //     $new_york_city_fee = $category->new_york_city_fee;
                    //     if($black_car_finder_fee>0){
                    //         $black_car_fund = ($total_charges*$black_car_finder_fee/100);
                    //         $total_charges = $total_charges + $black_car_fund;
                    //         $category->black_car_charges = number_format($black_car_fund,2);                        
                    //     } 
                    //     if($new_york_city_fee>0){
                    //         $new_york_city_fund = ($total_charges*$new_york_city_fee/100);
                    //         $total_charges = $total_charges + $new_york_city_fund;
                    //         $category->new_york_city_charges = number_format($new_york_city_fund,2); 
                    //     }
                    // }

                    $total_charges_with_meet_greet = $total_charges + (int) $category->meet_greet_fee;
                    $category->total_charges = number_format($total_charges,2); 
                    $category->total_charges_with_meet_greet = number_format($total_charges_with_meet_greet,2); 
                    $category->distance = number_format($distance,2); 
                    $category->duration_in_traffic = $duration_in_traffic; 
                    // $category->map_info = $address; 

                
                }
                

                
            }
        }
        
        $response['status'] =  true;
        $response['categories'] =  $categories;
        return response()->json($response, 200); 
    }

    public function showCarsOnMap()
    {
        $driver = DriverLocations::first();
        return view('map',compact('driver'));
    }
    public function getDrivers()
    {
        $drivers = DriverLocations::with('driver.driver_car.category_model.category')->get();

        $drivers->map(function($driver){

            $driver->car_icon = checkImage('categories/'. @$driver->driver->driver_car->category_model->category->car_icon);

            return $driver;
        });

        $response['status'] =  true;
        $response['drivers'] =  $drivers;
        return response()->json($response, 200); 
    }
}
