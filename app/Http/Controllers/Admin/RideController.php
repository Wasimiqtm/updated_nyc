<?php



namespace App\Http\Controllers\Admin;



use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Hashids,Datatables,Auth,Session;
use App\User;
use App\Models\Ride;
use App\Models\RideRequest;


class RideController extends Controller

{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */

    public function index()
    {   
        return view('admin.rides.index');
    }

    /**
     * get makes
     *
     * 
     */

    public function getRides(Request $request){
        
        $rides = Ride::with('driver','rider','category','ride_bill','ride_status')->orderBy('updated_at','desc');
        
        if(!empty($request->driver_id)){            
            $rides->where('driver_id',$request->driver_id);
        }

        if(!empty($request->rider_id)){            
            $rides->where('rider_id',$request->rider_id);
        }

        return Datatables::of($rides)
            ->addColumn('category_name', function ($ride) {
                return @$ride->category->name;               
            })            
            ->addColumn('driver_name', function ($ride) {
                return @$ride->driver->name;               
            })
            ->addColumn('rider_name', function ($ride) {
                return @$ride->rider->name;               
            })
            ->addColumn('total_charges', function ($ride) {
                if(@$ride->ride_bill->total_charges>0){
                    return '$'.$ride->ride_bill->total_charges;    
                }
                return @$ride->ride_bill->total_charges;               
            })
            ->addColumn('cancelation_charges', function ($ride) {
                if(@$ride->ride_bill->cancelation_charges>0){
                    return '$'.$ride->ride_bill->cancelation_charges;    
                }
                return @$ride->ride_bill->cancelation_charges;               
            })
            ->addColumn('start_date', function ($ride) {
                return date('m-d-Y h:i a', strtotime($ride->created_at));               
            })
            ->addColumn('end_date', function ($ride) {
                return date('m-d-Y h:i a', strtotime($ride->updated_at));               
            })->setRowAttr([
    'color' => function($user) {
        return $ride->payment_response=='done'?'green':'grey';
    },
])
            ->editColumn('id', 'ID: {{$id}}')
            ->rawColumns(['category_name','driver_name'])
            ->make(true);    

    }

    public function rideRequests(Request $request){



        if($request->ajax()){

            $rides = RideRequest::with('category')->orderBy('updated_at','desc');
            
            if($request->has('from_date') && $request->has('to_date')){
                $rides->where(function ($query)use($request) {
                    $query->whereBetween('pickup_date', [$request->from_date,$request->to_date]);
                    $query->orWhereBetween('round_pickup_date', [$request->from_date,$request->to_date]);
                });
            }

            if($request->filled('payment_status')) 
            {   
                if ($request->payment_status != 'all') {
                    $rides->where('payment_status', $request->payment_status);
                }
            }

            return Datatables::of($rides)
            ->addColumn('ride_id', function ($ride) {
                return 1000000 + $ride->id;
            })
            ->addColumn('category_name', function ($ride) {
                if($ride->category_id>0){
                    return @$ride->category->name;
                }
                $categories = ['ULS'=>'Ultra Luxury SUV','LMV'=>'Luxury Metris Van','LSV'=>'Luruxy Sprinter Van'];
                return @$categories[$ride->category_id];
            })    
            ->editColumn('payment_details', function ($ride) {
                if ($ride->payment_details != '') {
                    $paymentDetails = json_decode($ride->payment_details, true);
                    if (!isset($paymentDetails['toll'])) {
                        $paymentDetails['toll'] = 0;
                    }
                    return $paymentDetails;
                } else {
                    return ['fare_without_taxes' => 0,'gratuty' => 0,'toll' => 0,'black_car_finder_fee' => 0,'charges' => 0, 'new_york_city_fee' => 0];
                }
            })
            ->addColumn('date', function ($ride) {
                return date('d-m-Y', strtotime($ride->pickup_date));               
            })
            ->editColumn('pickup_date', function ($ride) {
                 if($ride->round_trip){
                     $date =  date('d-m-Y h:i a', strtotime($ride->pickup_date.' '.$ride->pickup_time)).'/'.date('d-m-Y h:i a', strtotime($ride->round_pickup_date.' '.$ride->round_pickup_time));
                     
                     return $date;               
                 }else{
                     return date('d-m-Y h:i a', strtotime($ride->pickup_date.' '.$ride->pickup_time));               
                 }
                
            })
            ->editColumn('meet_greet', function ($ride) {
                return ($ride->meet_greet==1)?'Yes':'No';               
            }) 
            ->editColumn('round_trip', function ($ride) {
                return ($ride->round_trip==1)?'Yes':'No';               
            })->addColumn('trip_type', function ($ride) {
                $trip = '';
                    if($ride->round_trip){
                        $trip = 'Round Trip';
                    }else if($ride->hourly){
                        $trip = 'Hourly-'.$ride->number_of_hours;
                    }else{
                        $trip ='One Way';
                    }        
                    return $trip;
            })            
            ->addColumn('action', function ($ride) {
                return '<a href="ride-requests/'.Hashids::encode($ride->id).'" class="text-success" data-toggle="tooltip" title="Send Response"><i class="fa fa-sign-out fa-2x"></i></a>';               
            })
            ->rawColumns(['action','category_name'])
            ->make(true);   
        }        

        return view('admin.rides.ride-requests');    
    }
    
    public function rideRequestDetails($id)
    {
        $id = Hashids::decode($id)[0];    
        $ride = RideRequest::with('category')->findOrFail($id);

        if($ride){
            $category = $ride->category;
            if($category){
                $url = "https://maps.googleapis.com/maps/api/distancematrix/json?units=imperial&origins=".urlencode($ride->pickup_location)."&destinations=".urlencode($ride->dropoff_location)."&departure_time=now&key=AIzaSyBfe1Nw8nQENKRT9WcLlz7Uu0wTlrrFLQU"; 
               // dd($url);
                $ch = curl_init();  
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
                curl_setopt($ch, CURLOPT_URL, $url); 

                $result = curl_exec($ch); 
                $address = json_decode($result);
                if($address->status=="OK"){
                    
                    $distance = @$address->rows[0]->elements[0]->distance->text;
                    if($distance!=""){                    

                        $distance = explode(' ', $distance);
                        $distance = (double) $distance[0];

                        $duration_in_traffic = ceil($address->rows[0]->elements[0]->duration_in_traffic->value/60);

                        $total_charges = $category->base_fare;
                        $total_charges = $total_charges + ($distance*$category->cost_per_mile);
                        $total_charges = $total_charges + ($duration_in_traffic*$category->cost_per_minute);                                        

                        $category->total_charges = number_format($total_charges,2); 
                        $category->distance = number_format($distance,2); 
                        $category->duration_in_traffic = $duration_in_traffic; 
                    }
                }  

                if($ride->meet_greet==1)
                    $category->total_charges = $total_charges + 20;
                
                if($ride->round_trip==1){
                    //dd($ride->toArray());

                    $url = "https://maps.googleapis.com/maps/api/distancematrix/json?units=imperial&origins=".urlencode($ride->round_pickup_location)."&destinations=".urlencode($ride->round_dropoff_location)."&departure_time=now&key=AIzaSyBfe1Nw8nQENKRT9WcLlz7Uu0wTlrrFLQU"; 
                   // dd($url);
                    $ch = curl_init();  
                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
                    curl_setopt($ch, CURLOPT_URL, $url); 

                    $result = curl_exec($ch); 
                    $address = json_decode($result);
                    if($address->status=="OK"){
                        
                        $distance = @$address->rows[0]->elements[0]->distance->text;
                        if($distance!=""){                    

                            $distance = explode(' ', $distance);
                            $distance = (double) $distance[0];

                            $duration_in_traffic = ceil($address->rows[0]->elements[0]->duration_in_traffic->value/60);

                            $total_charges = $category->base_fare;
                            $total_charges = $total_charges + ($distance*$category->cost_per_mile);
                            $total_charges = $total_charges + ($duration_in_traffic*$category->cost_per_minute);                                                                    

                            $category->round_total_charges = number_format($total_charges,2); 
                            $category->round_distance = number_format($distance,2); 
                            $category->round_duration_in_traffic = $duration_in_traffic;                             

                            $category->total_charges = number_format($total_charges+$category->total_charges,2); 
                        }
                    }
                }  
            }
            
        }

        $email_body = '<h3>Congratulation! Your ride request is accepted.</h3>';
        $email_body .= '<table border="1" cellpadding="1" cellspacing="1" style="width:500px;">';        
        $email_body .= '<tr><th align="center">Pick Up Date & Time</th><td align="center">'.date('d-m-Y', strtotime($ride->pickup_date)).' '.date('h:i a', strtotime($ride->pickup_time)).'</td></tr>';
        $email_body .= '<tr><th align="center">Pickup Location</th><td align="center">'.$ride->pickup_location.'</td></tr>';
        $email_body .= '<tr><th align="center">Dropoff Location</th><td align="center">'.$ride->dropoff_location.'</td></tr>';
        $email_body .= '<tr><th align="center">No of Passengers</th><td align="center">'.$ride->no_of_passengers.'</td></tr>';
        $email_body .= '<tr><th align="center">Category Name</th><td align="center">'.@$ride->category->name.'</td></tr>';
        $email_body .= '<tr><th align="center">Base Fare</th><td align="center">$'.@$ride->category->base_fare.'</td></tr>';
        $email_body .= '<tr><th align="center">Cost Per Mile</th><td align="center">$'.@$ride->category->cost_per_mile.'</td></tr>';
        $email_body .= '<tr><th align="center">Cost Per Minute</th><td align="center">$'.@$ride->category->cost_per_minute.'</td></tr>';
        $email_body .= '<tr><th align="center">Duration In Traffic</th><td align="center">'.@$ride->category->duration_in_traffic.'</td></tr>';
        $email_body .= '<tr><th align="center">Total Distance</th><td align="center">'.@$ride->category->distance.'</td></tr>';

        if($ride->round_trip==1){
            $email_body .= '<tr><th align="center">Round Pick Up Date & Time</th><td align="center">'.date('d-m-Y', strtotime($ride->round_pickup_date)).' '.date('h:i a', strtotime($ride->round_pickup_time)).'</td></tr>';
            $email_body .= '<tr><th align="center">Round Pickup Location</th><td align="center">'.$ride->round_pickup_location.'</td></tr>';
            $email_body .= '<tr><th align="center">Round Dropoff Location</th><td align="center">'.$ride->round_dropoff_location.'</td></tr>';
            $email_body .= '<tr><th align="center">Total Round Distance</th><td align="center">'.@$ride->category->round_distance.'</td></tr>';
            $email_body .= '<tr><th align="center">Total Round Charges</th><td align="center">$'.@$ride->category->round_total_charges.'</td></tr>';
            if($ride->meet_greet==1){
                $email_body .= '<tr><th align="center">Meet & Greet Charges</th><td align="center">$20</td></tr>'; 
            }
        }

        $email_body .= '<tr><th align="center"> </th><td align="center"></td></tr>';
        $email_body .= '<tr><th align="center"> </th><td align="center"></td></tr>';
        $email_body .= '<tr><th align="center"> </th><td align="center"></td></tr>';
        $email_body .= '<tr><th align="center"> </th><td align="center"></td></tr>';
        $email_body .= '<tr><th align="center"> </th><td align="center"></td></tr>';
        $email_body .= '<tr><th align="center">Total Charges</th><td align="center">$'.@$ride->category->total_charges.'</td></tr>';
        $email_body .= '</table>';

        //dd($ride->toArray());
        return view('admin.rides.ride-details',compact('ride','email_body'));
    }   

    public function rideRequestResponse(Request $request)
    {
        $ride = RideRequest::with('category')->findOrFail($request->ride_id);

        if($ride){


            $category = $ride->category;
            if($category){
                $url = "https://maps.googleapis.com/maps/api/distancematrix/json?units=imperial&origins=".urlencode($ride->pickup_location)."&destinations=".urlencode($ride->dropoff_location)."&departure_time=now&key=AIzaSyBfe1Nw8nQENKRT9WcLlz7Uu0wTlrrFLQU"; 
               // dd($url);
                $ch = curl_init();  
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
                curl_setopt($ch, CURLOPT_URL, $url); 

                $result = curl_exec($ch); 
                $address = json_decode($result);
                if($address->status=="OK"){
                    
                    $distance = @$address->rows[0]->elements[0]->distance->text;
                    if($distance!=""){                    

                        $distance = explode(' ', $distance);
                        $distance = (double) $distance[0];

                        $duration_in_traffic = ceil($address->rows[0]->elements[0]->duration_in_traffic->value/60);

                        $total_charges = $category->base_fare;
                        $total_charges = $total_charges + ($distance*$category->cost_per_mile);
                        $total_charges = $total_charges + ($duration_in_traffic*$category->cost_per_minute);                                         
                    }
                }  

                if($ride->meet_greet==1)
                    $total_charges = $total_charges + 20; 

                if($ride->round_trip==1){
                    //dd($ride->toArray());

                    $url = "https://maps.googleapis.com/maps/api/distancematrix/json?units=imperial&origins=".urlencode($ride->round_pickup_location)."&destinations=".urlencode($ride->round_dropoff_location)."&departure_time=now&key=AIzaSyBfe1Nw8nQENKRT9WcLlz7Uu0wTlrrFLQU"; 
                   // dd($url);
                    $ch = curl_init();  
                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
                    curl_setopt($ch, CURLOPT_URL, $url); 

                    $result = curl_exec($ch); 
                    $address = json_decode($result);
                    if($address->status=="OK"){
                        
                        $distance = @$address->rows[0]->elements[0]->distance->text;
                        if($distance!=""){                    

                            $distance = explode(' ', $distance);
                            $distance = (double) $distance[0];

                            $duration_in_traffic = ceil($address->rows[0]->elements[0]->duration_in_traffic->value/60);

                            $total_charges = $total_charges + $category->base_fare;
                            $total_charges = $total_charges + ($distance*$category->cost_per_mile);
                            $total_charges = $total_charges + ($duration_in_traffic*$category->cost_per_minute);                                                     
                        }
                    }
                }  
            }
            
            if($request->charges_1>0)
                $total_charges = $total_charges + $request->charges_1;
            if($request->charges_2>0)
                $total_charges = $total_charges + $request->charges_2;
            if($request->charges_3>0)
                $total_charges = $total_charges + $request->charges_3;
            if($request->charges_4>0)
                $total_charges = $total_charges + $request->charges_4;
            if($request->charges_5>0)
                $total_charges = $total_charges + $request->charges_5;


            $ride->status = $request->status;
            $ride->charges = $total_charges;
            $ride->save();

            $headers = 'MIME-Version: 1.0' . "\r\n";
            $headers .= 'Content-Type: text/html; charset=ISO-8859-1' . "\r\n";
            $headers .= "From: info@airportcarandlimo.com" . "\r\n";
            $message = $request->email;

            mail($ride->email,"Ride Response",$message,$headers);
            Session::flash('success', 'Email successfully sent!');
        }else{
            Session::flash('error', 'Email not successfully sent!');
        }

        return redirect('admin/ride-requests');
    }

     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */

    public function getCalculator()
    {   
        $rides = [];
        $drivers = User::where('user_type','driver')->pluck('name','id');
        return view('admin.rides.calculator',compact('rides','drivers'));
    }

    public function calculator(Request $request) 
    {   
        $this->validate($request, [ 
            'driver_id' => 'required',            
            'daterange' => 'required'            
        ]); 

        $daterange = $request->daterange;
        
        $daterange_explode = explode(' - ', $daterange);
        $start_date = $daterange_explode[0].' 00:00:00';
        $end_date = $daterange_explode[1].' 23:59:59';

        $rides  = Ride::with('driver','rider','category','ride_bill','ride_status')
                    ->where('driver_id',$request->driver_id)
                    ->whereIn('status',['completed','canceled']);

        
        $rides->where('created_at', '>=' , date('Y-m-d', strtotime($daterange_explode[0])).' 00:00:00');        
        $rides->where('created_at', '<=' , date('Y-m-d', strtotime($daterange_explode[1])).' 23:59:59');
        
        $rides = $rides->get();

        //dd($rides->toArray()); 

        $total_driver_commission = 0;
        $driver_commission_per = settingValue('driver_commission');
        $rides->map(function($ride) use (&$total_driver_commission,$driver_commission_per){
            $ride_bill = $ride->ride_bill;

            if($ride_bill){
                if($ride_bill->payment_status=='done'){
                     $total_commision = $ride_bill->base_fare + ($ride_bill->cost_per_mile*$ride_bill->distance) + ($ride_bill->cost_per_minute*$ride_bill->duration);
                     $driver_commission =  (($total_commision*$driver_commission_per/100)+$ride_bill->tip);
                     $total_driver_commission = $total_driver_commission + $driver_commission;
                     $ride->driver_commission = $driver_commission;
                }                  
            }

            return $ride;
                
        });

        
        $drivers = User::where('user_type','driver')->pluck('name','id');

        return view('admin.rides.calculator',compact('rides','drivers','total_driver_commission'));
    }

}

