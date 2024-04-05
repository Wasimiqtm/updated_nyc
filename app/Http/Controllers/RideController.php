<?php



namespace App\Http\Controllers;



use App\Http\Requests;

use App\Http\Controllers\Controller;

use App\Helpers\LogActivity;

use App\Models\Categories;
use App\Models\Email;
use App\Models\RideRequest;
use Illuminate\Http\Request;

use phpseclib\Crypt\Hash;
use Session;

use Alert;

use Image;

use File;

use Hashids;

use Datatables;

use Auth;

use DB;

use App\Stock;

use Illuminate\Support\Collection;
use App\Http\Controllers\Api\ApiController;




class RideController extends Controller

{

    public $successStatus = 200;

    public $errorStatus = 401;

    public $notFoundStatus = 404;
    
    public $appName = 'luxride';

    

    /**

     * Display a listing of the resource.

     *

     * @return \Illuminate\View\View

     */

    public function index()

    {
    }

    /**

     * Show the form for creating a new resource.

     *

     * @return \Illuminate\View\View

     */

    public function create()

    {               
    }

    

    /**

     * Store a newly created resource in storage.

     *

     * @param \Illuminate\Http\Request $request

     *

     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector

     */

    public function store(Request $request)
    {
    }

    public function timeFormatted($timeString)
    {
        if($timeString)
        {
            return $timeString . ":00";
        }
        return $timeString;


        if($timeString) {
            preg_match('/(\d+)\s+(AM|PM)\s+:\s+(\d+)/', $timeString, $matches);
            $hour = (int)$matches[1];
            $minute = (int)$matches[3];
            $ampm = strtoupper($matches[2]);

// Convert hour to 24-hour format if PM
            if ($ampm === 'PM' && $hour < 12) {
                $hour += 12;
            }

// Format the time as HH:mm:ss
            $formattedTime = sprintf("%02d:%02d:00", $hour, $minute);
            return $formattedTime;
        }
        return $timeString;
    }

    /**
     * Post Request to store step1 info in session
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function postCreateStep1(Request $request)
    {
        $this->validate($request, [
            'pickup_location'   => 'required',
            'dropoff_location'  => 'required',
            'pickup_date'       => 'required',
            'pickup_time_hour'  => 'required',
        ]);

        $input['pickup_lat'] = $request->lat;
        $input['pickup_lon'] = $request->lng;
        $input['dropoff_lat'] = $request->lat2;
        $input['dropoff_lon'] = $request->lng2;

        $time = $request->pickup_time_hour;
        $pickup_time = $this->timeFormatted($time);

        $round_time = $request->round_pickup_time_hour;
        $round_pickup_time = $this->timeFormatted($round_time);

        $api_data1 = calculateDistance($request->lat, $request->lng, $request->lat2, $request->lng2);
        $distance1 = $api_data1['distance'];
        $duration_in_traffic1 = $api_data1['duration_in_traffic'];

        $distance2 = 0;
        $duration_in_traffic2 = 0;
        if($request->form_type == 'flat')
        {
            $api_data2 = calculateDistance($request->lat3, $request->lng3, $request->lat4, $request->lng4);
            $distance2 = $api_data2['distance'];
            $duration_in_traffic2 = $api_data2['duration_in_traffic'];
        }
        $distance = $distance1 + $distance2;
        $duration_in_traffic = $duration_in_traffic1 + $duration_in_traffic2;

        $requestData['pickup_location']         = $request->pickup_location;
        $requestData['round_pickup_location']   = $request->round_pickup_location;
        $requestData['dropoff_location']        = $request->dropoff_location;
        $requestData['round_dropoff_location']  = $request->round_dropoff_location;
        /*$requestData['pickup_date']             = date('Y-m-d', strtotime(str_replace('/', '-', $request->pickup_date)));
        $requestData['round_pickup_date']       = date('Y-m-d', strtotime(str_replace('/', '-', $request->round_pickup_date)));*/
        $requestData['pickup_date']             = date('Y-m-d', strtotime($request->pickup_date));
        $requestData['round_pickup_date']       = date('Y-m-d', strtotime($request->round_pickup_date));
        $requestData['pickup_time']             = $pickup_time;
        $requestData['round_pickup_time']       = $round_pickup_time;
        $requestData['round_trip']              = $request->form_type != 'flat'?0:1;
        $requestData['hourly']                  = $request->form_type == 'hourly'?1:0;
        $requestData['number_of_hours']         = $request->number_of_hours??0;
        $requestData['distance1']               = $distance1;
        $requestData['distance2']               = $distance2;
        $requestData['distance']                = $distance;
        $requestData['duration_in_traffic1']    = $duration_in_traffic1;
        $requestData['duration_in_traffic2']    = $duration_in_traffic2;
        $requestData['duration_in_traffic']     = $duration_in_traffic;

        $requestData['pickup_lat']              = $request->lat;
        $requestData['pickup_lng']              = $request->lng;
        $requestData['dropoff_lat']             = $request->lat2;
        $requestData['dropoff_lng']             = $request->lng2;

        $requestData['round_pickup_lat']        = $request->lat3;
        $requestData['round_pickup_lng']        = $request->lng3;
        $requestData['round_dropoff_lng']       = $request->lng4;
        $requestData['round_dropoff_lat']       = $request->lat4;
        $requestData['flight_name']       = $request->flight_name ?? "";
        $requestData['flight_name1']       = $request->flight_name1 ?? "";
        $requestData['flight_number']       = $request->flight_number ?? "";
        $requestData['flight_number1']       = $request->flight_number1 ?? "";
        $requestData['terminal']       = $request->terminal ?? "";
        $requestData['terminal1']       = $request->terminal1 ?? "";

        $requestData['app_name']               = $this->appName;
        $request->session()->put('ride', $requestData);

        return redirect('/ride-request/create-step2');
    }

    /**
     * Show the step 2 Form for creating a new product.
     *
     * @return \Illuminate\Http\Response
     */
    public function createStep2(Request $request)
    {
        try{
        $ride = $request->session()->get('ride');
        if(!$ride)
            return redirect('/');

        $distance1  = $ride['distance1'];
        $distance2  = $ride['distance2'];
        $distance   = $ride['distance'];

        $duration_in_traffic1   = $ride['duration_in_traffic1'];
        $duration_in_traffic2   = $ride['duration_in_traffic2'];
        $duration_in_traffic    = $ride['duration_in_traffic'];
        
        //dd($distance1,$distance2);

        

        $categories_data = Categories::get();

        $categories = [];
        foreach($categories_data as $category)
        {
          
//            for round trip and one way
            if($ride['hourly'] == 0)
            {
                $fare_without_taxes1 = $category->base_fare;

                $fare_without_taxes1 = $fare_without_taxes1 + ($distance1*$category->cost_per_mile);


                $fare_without_taxes1 = number_format((float)$fare_without_taxes1 + ((float)$duration_in_traffic1*(float)$category->cost_per_minute), 2);
               $fare_without_taxes1 =(float)str_replace( ',', '', $fare_without_taxes1);
              

                /*adding alternate fare*/
                //$fare_without_taxes1  = ($fare_without_taxes1 < 10)?$category['alternate_fare']:$fare_without_taxes1;
                
                $charges1 = $fare_without_taxes1 + ($fare_without_taxes1 * ($category['meet_greet_fee']/100)) + ($fare_without_taxes1 * ($category['black_car_finder_fee']/100)) + ($fare_without_taxes1 * ($category['state_wise_percentage']/100)) + ($fare_without_taxes1 * ($category['new_york_city_fee']/100));


                if($ride['round_trip'] == 0)
                {
                    $fare_without_taxes2 = 0;
                    $charges2 = 0;
                } else {

                    $fare_without_taxes2 = $category->base_fare;
                    $fare_without_taxes2 = $fare_without_taxes2 + ($distance2*$category->cost_per_mile);;
                    $fare_without_taxes2 = number_format((float)$fare_without_taxes2 + ((float)$duration_in_traffic2*(float)$category->cost_per_minute), 2);
                    $fare_without_taxes2 =(float)str_replace( ',', '', $fare_without_taxes2);
                    /*adding alternate fare*/
                    //$fare_without_taxes2  = ($fare_without_taxes2 < 10)?$category['alternate_fare']:$fare_without_taxes2;
                    $charges2 = $fare_without_taxes2 + ($fare_without_taxes2 * ($category['meet_greet_fee']/100)) + ($fare_without_taxes2 * ($category['black_car_finder_fee']/100)) + ($fare_without_taxes2 * ($category['state_wise_percentage']/100)) + ($fare_without_taxes2 * ($category['new_york_city_fee']/100));
                }

                $fare_without_taxes  = $fare_without_taxes1 + $fare_without_taxes2;
                $total_charges = $charges1 + $charges2;

            } else {
//            for hourly
                $fare_without_taxes = $ride['number_of_hours'] * $category['advance_booking_fee'];
                /*adding alternate fare*/
                //$fare_without_taxes = ($fare_without_taxes < 10)?$category['alternate_fare']:$fare_without_taxes;

                $charges1 = $fare_without_taxes + ($fare_without_taxes * ($category['meet_greet_fee']/100)) + ($fare_without_taxes * ($category['black_car_finder_fee']/100)) + ($fare_without_taxes * ($category['state_wise_percentage']/100)) + ($fare_without_taxes * ($category['new_york_city_fee']/100));
                $charges2 = 0;
                $total_charges = $charges1 + $charges2;
            }

            $categories[] = [
                'id' => $category['id'],
                'name' => $category['name'],
                'no_of_bags' => $category['no_of_bags'],
                'no_of_passengers' => $category['no_of_passengers'],
                'image' => checkImage('categories/thumbs/'. $category['image']),
                'charges1' => number_format($charges1,2),
                'charges2' => number_format($charges2,2),
                'total_charges' => number_format($total_charges,2),
                'fare_without_taxes' => number_format($fare_without_taxes,2)
            ];
        }

      
        return view('ride-request.create-step2',compact('ride', 'categories', 'distance'));
        }catch(\Exception $e){
            dd($e->getMessage(),$e->getLine());
        }
    }

    /**
     * Post Request to store step1 info in session
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function postCreateStep2(Request $request)
    {
        $this->validate($request, [
            'name'   => 'required',
            'phone_number'  => 'required',
            'email'       => 'required|email'
        ]);
        $ride = $request->session()->get('ride');

        /*..........*/
        $cat_id = $request->cat_id;
        $category = Categories::findOrFail($cat_id);

        $fare_without_taxes2     = 0;
        $gratuty2                = 0;
        $black_car_finder_fee2   = 0;
        $state_wise_percentage2  = 0;
        $new_york_city_fee2      = 0;
        $charges2 = 0;

        $congestion_fee_1 = settingValue('congestion_fee_1');
        $congestion1 = ($congestion_fee_1=='') ? 2.75 : $congestion_fee_1;

        $congestion_fee_2 = settingValue('congestion_fee_2');
        $congestion2 = ($congestion_fee_2=='') ? 2.75 : $congestion_fee_2;

        if($ride['hourly'] == 0)
        {
            $fare_without_taxes1 = (float)$category->base_fare;
            $fare_without_taxes1 = $fare_without_taxes1 + ($ride['distance1']*$category->cost_per_mile);;
            $fare_without_taxes1 = number_format($fare_without_taxes1 + ($ride['duration_in_traffic1']*$category->cost_per_minute), 2);
            $fare_without_taxes1 =(float)str_replace( ',', '', $fare_without_taxes1);
              
            /*adding alternate fare*/
            //$fare_without_taxes1  = ($fare_without_taxes1 < 10)?$category['alternate_fare']:$fare_without_taxes1;

            $gratuty1                = ($fare_without_taxes1 * ($category['meet_greet_fee']/100));
            //$gratuty1                = 0;
            $black_car_finder_fee1   = ($fare_without_taxes1 * ($category['black_car_finder_fee']/100));
            $state_wise_percentage1  = ($fare_without_taxes1 * ($category['state_wise_percentage']/100));
            $new_york_city_fee1      = ($fare_without_taxes1 * ($category['new_york_city_fee']/100));
            $charges1 = $fare_without_taxes1 + $gratuty1 + $black_car_finder_fee1 + $state_wise_percentage1 + $new_york_city_fee1 + $congestion1;

            if($ride['round_trip'] == 1)
            {
                $fare_without_taxes2 = $category->base_fare;
                $fare_without_taxes2 = $fare_without_taxes2 + ($ride['distance2']*$category->cost_per_mile);;
                $fare_without_taxes2 = number_format($fare_without_taxes2 + ($ride['duration_in_traffic2']*$category->cost_per_minute), 2);;
                /*adding alternate fare*/
                //$fare_without_taxes2  = ($fare_without_taxes2 < 10)?$category['alternate_fare']:$fare_without_taxes2;

                $gratuty2                = ($fare_without_taxes2 * ($category['meet_greet_fee']/100));
                //$gratuty2                = 0;

                $black_car_finder_fee2   = (str_replace(",",'',$fare_without_taxes2) * ($category['black_car_finder_fee']/100));

                $state_wise_percentage2  = (str_replace(",",'',$fare_without_taxes2) * ($category['state_wise_percentage']/100));
                $new_york_city_fee2      = (str_replace(",",'',$fare_without_taxes2) * ($category['new_york_city_fee']/100));

                $charges2 = str_replace(",",'',$fare_without_taxes2) + $gratuty2 + $black_car_finder_fee2 + $state_wise_percentage2 + $new_york_city_fee2 + $congestion2;
            }
            $fare_without_taxes  = str_replace(",",'',$fare_without_taxes1) + str_replace(",",'',$fare_without_taxes2);


            $gratuty                = $gratuty1 + $gratuty2;
            $black_car_finder_fee   = $black_car_finder_fee1 + $black_car_finder_fee2;
            $state_wise_percentage  = $state_wise_percentage1 + $state_wise_percentage2;
            $new_york_city_fee      = $new_york_city_fee1 + $new_york_city_fee2;

            $total_charges = $charges1 + $charges2;
        } else {
//            for hourly
            $fare_without_taxes1 = $ride['number_of_hours'] * $category['advance_booking_fee'];
            /*adding alternate fare*/
            //$fare_without_taxes1 = ($fare_without_taxes1 < 10)?$category['alternate_fare']:$fare_without_taxes1;
            $fare_without_taxes  = $fare_without_taxes1 + $fare_without_taxes2;

            $gratuty1                = ($fare_without_taxes1 * ($category['meet_greet_fee']/100));
            //$gratuty1                = 0;
            $black_car_finder_fee1   = ($fare_without_taxes1 * ($category['black_car_finder_fee']/100));
            $state_wise_percentage1  = ($fare_without_taxes1 * ($category['state_wise_percentage']/100));
            $new_york_city_fee1      = ($fare_without_taxes1 * ($category['new_york_city_fee']/100));

            $gratuty                = $gratuty1 + $gratuty2;
            $black_car_finder_fee   = $black_car_finder_fee1 + $black_car_finder_fee2;
            $state_wise_percentage  = $state_wise_percentage1 + $state_wise_percentage2;
            $new_york_city_fee      = $new_york_city_fee1 + $new_york_city_fee2;

            $charges1 = $fare_without_taxes1 + $gratuty + $black_car_finder_fee + $state_wise_percentage + $new_york_city_fee + $congestion1;
            $charges2 = 0;
            $total_charges = $charges1 + $charges2;
        }

        /*..........*/
        $requestData['no_of_passengers']        = $request->no_of_passengers;
        $requestData['no_of_bags']              = $request->no_of_bags;
        $requestData['pickup_inst']             = ($request->pickup_inst)??'';
        $requestData['dropoff_inst']            = ($request->dropoff_inst)??'';
        $requestData['name']                    = $request->name;
        $requestData['phone_number']            = $request->phone_number;
        $requestData['email']                   = $request->email;
        $requestData['additional_info']         = ($request->additional_info)??'';

        $requestData['category_id']             = $cat_id;
        $requestData['charges1']                = number_format($charges1,2);
        $requestData['charges2']                = number_format($charges2,2);
        $requestData['charges']                 = number_format($total_charges,2);

        $requestData['fare_without_taxes1']     = number_format($fare_without_taxes1,2);
        $requestData['gratuty1']                = number_format($gratuty1,2);
        $requestData['black_car_finder_fee1']   = number_format($black_car_finder_fee1,2);
        $requestData['state_wise_percentage1']  = number_format($state_wise_percentage1,2);
        $requestData['new_york_city_fee1']      = number_format($new_york_city_fee1,2);

        $requestData['fare_without_taxes2']     = number_format(str_replace(",",'',$fare_without_taxes2),2);
        $requestData['gratuty2']                = number_format($gratuty2,2);
        $requestData['congestion2']                = number_format($congestion2,2);
        $requestData['black_car_finder_fee2']   = number_format($black_car_finder_fee2,2);
        $requestData['state_wise_percentage2']  = number_format($state_wise_percentage2,2);
        $requestData['new_york_city_fee2']      = number_format($new_york_city_fee2,2);

        $requestData['fare_without_taxes']      = number_format($fare_without_taxes,2);
        $requestData['gratuty']                 = number_format($gratuty,2);
        $requestData['congestion']             = number_format($congestion1,2);
        $requestData['black_car_finder_fee']    = number_format($black_car_finder_fee,2);
        $requestData['state_wise_percentage']   = number_format($state_wise_percentage,2);
        $requestData['new_york_city_fee']       = number_format($new_york_city_fee,2);
        $requestData['unique_id']               = time();
      

        $ride = array_merge($ride, $requestData);
        $request->session()->put('ride', $ride);

        return redirect('/ride-request/create-step3');
    }

    /**
     * Show the step 2 Form for creating a new product.
     *
     * @return \Illuminate\Http\Response
     */
    public function createStep3(Request $request)
    {
        $ride = $request->session()->get('ride');
        if(!$ride)
            return redirect('/');
        // if ($ride['unique_id'] == 1661945421) {
        //     dd($ride);
        // }
        $check_ride = RideRequest::where('unique_id', $ride['unique_id'])->first();

        if($check_ride){
            $ride_request = $check_ride;
        } else {
            $rideRequest = new RideRequest();
            $rideRequest->fill($ride);
            $rideRequest->save();

            $ride_request = RideRequest::latest()->first();
        }
        
        $ride['request_id'] = $ride_request->id;
        $ride['charges'] =str_replace(",",'', $ride['charges']);

        $toll = $this->calculateToll($ride_request->pickup_location, $ride_request->dropoff_location);

        $tol2 =[];
        if($ride_request->round_trip){

            $tol2 = $this->calculateToll($ride_request->round_pickup_location, $ride_request->round_dropoff_location);
            $ride['charges2'] =str_replace(",",'', $ride['charges2'])+$toll['total_toll'];
            $ride['toll2'] =$toll['total_toll'];

        }

       
        if($toll['toll']){
            $ride['charges'] =str_replace(",",'', $ride['charges'])+$toll['total_toll'];
             $tollData['toll'] = $toll['total_toll'];
        $ride = array_merge($ride, $tollData);


        

        $request->session()->put('ride', $ride);
        }

        $ride_request->payment_details = json_encode($ride);
        $ride_request->save();
       
        return view('ride-request.create-step3',compact('ride', 'ride_request', 'toll'));
    }

    /**
     * Post Request to store step1 info in session
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function postCreateStep3(Request $request)
    {
        $ride = $request->session()->get('ride');
        $input = $request->all();
        unset($input['_token']);

        $req = new \Illuminate\Http\Request();
        $res = $req->replace($input);

        $result = (new ApiController())->payRideChargesForAirportCarLimo($res);

        if($result['status']==1){
//            send email to admin and user
//        email to user
            $email = $this->testMail($ride, $ride['email']);
//        email to admin   
 //           $this->testMail($ride, 'booking@alphaitdevelopers.com');

            if($email['status'])
            {
                $this->testMail($ride, 'booking.alpharides@gmail.com');
            }

            $request->session()->forget('ride');
            $ride_id = Hashids::encode($input['ride_id']);
            Session::flash('success', 'Congratulations! Your payment is successfull.');
            return redirect('ride-request/booking-successfull/'.$ride_id.'');
        }else{
//            else case
                $msg = $result['message']??'Payment not successfull. Please try again.';
            Session::flash('error', $msg);
            return redirect()->back();

//            dummy success response
            /*$request->session()->forget('ride');
            $ride_id = Hashids::encode($input['ride_id']);
            Session::flash('success', 'Congratulations! Your payment is successfull.');
            return redirect('ride-request/booking-successfull/'.$ride_id.'');*/
        }
    }
    
    public function calculateToll($from, $to)
    {
        $res = ['toll' => false, 'total_toll' => 0];
        $curl = curl_init();
    
        curl_setopt_array($curl, [
          CURLOPT_URL => "https://dev.tollguru.com/v1/calc/gmaps",
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => "",
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 30,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => "POST",
          CURLOPT_POSTFIELDS => "{\"from\":{\"address\":\"'. $from .', TX\"},\"to\":{\"address\":\"'. $to .'\"},\"vehicleType\":\"2AxlesAuto\",\"departure_time\":1551541566,\"fuelPrice\":2.79,\"fuelPriceCurrency\":\"USD\",\"fuelEfficiency\":{\"city\":24,\"hwy\":30,\"units\":\"mpg\"},\"driver\":{\"wage\":30,\"rounding\":15,\"valueOfTime\":0},\"hos\":{\"rule\":60,\"dutyHoursBeforeEndOfWorkDay\":11,\"dutyHoursBeforeRestBreak\":7,\"drivingHoursBeforeEndOfWorkDay\":11,\"timeRemaining\":60},\"units\":{\"currencyUnit\":\"USD\"}}",
          CURLOPT_HTTPHEADER => [
            "content-type: application/json",
            "x-api-key: 2nHp8brBfHTnm4GMqM2P442tPmR6FRfJ"
          ],
        ]);

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
          
        } else {
            $tollObj = [];
            $response = json_decode($response); 
        //dd($response);
            if(isset($response->routes)){
                if(isset($response->routes[0])){
                $route = $response->routes[0];
                //foreach($response->routes as $route){
                    $summary = $route->summary;
                    if($summary->hasTolls){
                        $res['toll'] = true;
                        $tolls = $route->tolls;
                        
                        $tollManan = false;
                        foreach($tolls as $toll){
                            if(isset($toll->id)){
                                //$tollObj[$toll->id] = ['name' => @$toll->name,'road' => @$toll->road,'toll' => $toll->tagCost,'tagSecCost' => @$toll->tagSecCost, 'licensePlateCost' => @$toll->licensePlateCost];
                            
                                $tollManan = $toll;
                            }
                        }

                        if ($tollManan) {
                            $toll = $tollManan;
                            $tollObj[$toll->id] = ['name' => @$toll->name,'road' => @$toll->road,'toll' => $toll->tagCost,'tagSecCost' => @$toll->tagSecCost, 'licensePlateCost' => @$toll->licensePlateCost];
                        }
                        
                    }
               // }
                }
            }
            $tollCollect = collect($tollObj);
            $res['total_toll'] = $tollCollect->sum('toll');
            $res['toll_data'] = $tollCollect->toArray();
        }
        
        return $res;
    }
    
    /**
     * Show the step 2 Form for creating a new product.
     *
     * @return \Illuminate\Http\Response
     */
    public function bookingSuccessfull($id)
    {
        $ride_id = @Hashids::decode($id)[0];
        $ride = RideRequest::with('category')->whereId($ride_id)->first();

        if($ride)
        {
            return view('ride-request.booking-successfull',compact('ride'));
        } else {
            Session::flash('error', 'You are not authorized to view this page.');
            return redirect('/');
        }
    }
    

    /**

     * Show the detail of user.

     *

     * @return \Illuminate\View\View

     */

    public function show($id)

    {        

        exit;

    }





    /**

     * Show the form for editing the specified resource.

     *

     * @param  int  $id

     *

     * @return \Illuminate\View\View

     */

    public function edit($id)

    {

        

        $id = Hashids::decode($id)[0];            

        

        $stock = Stock::find($id);

        

        return view('stocks.edit', compact('stock'));

    }



    /**

     * Update the specified resource in storage.

     *

     * @param  int  $id

     * @param \Illuminate\Http\Request $request

     *

     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector

     */

    public function update($id, Request $request)

    {

        $id = Hashids::decode($id)[0];

        

        $this->validate($request, [ 

            'name' => 'required|max:255',            

            'code' => 'required|unique:stocks,code,'.$id,            

            'cost' => 'required|numeric',            

            'price' => 'required|numeric'            

        ]);           

        

        

        $stock = Stock::findOrFail($id);

                      

        $requestData = $request->all();

                                

        

        $stock->update($requestData);



        /*-----image manipulation-----*/

        if ($request->hasFile('image'))

        {

            $image = $request->file('image');

            $image_name = $stock->id.'_'.rand(11111,99999).'.'.$image->getClientOriginalExtension();

            $destinationPath = public_path('/uploads/products/thumbs');

            $img = Image::make($image->getRealPath());

            /*save image thumbnamil*/

            $img->resize(100, 100, function ($constraint) {

                $constraint->aspectRatio();

            })->save($destinationPath.'/'.$image_name);



            /*save original image*/

            $destinationPath = public_path('/uploads/products');

            $image->move($destinationPath, $image_name);



            /*unlink old image*/

            @unlink(public_path("/uploads/products/$stock->image"));

            @unlink(public_path("/uploads/products/thumbs/$stock->image"));



            $stock->image = $image_name;

            $stock->save(); 

        }

        

        Session::flash('success', 'Stock successfully updated!');



        return redirect('stocks');

    }



    /**

     * Remove the specified resource from storage.

     *

     * @param  int  $id

     *

     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector

     */

    public function destroy($id)

    {

        $id = Hashids::decode($id)[0];



        $stock = Stock::find($id);



        if($stock){

            $stock->delete();

            $response['success'] = 'Stock successfully deleted!';

            $status = $this->successStatus;  

        }else{

            $response['error'] = 'Stock not exist against this id!';

            $status = $this->notFoundStatus;  

        }

        

        return response()->json(['result'=>$response], $status);

    }

    public function distance($lat1, $lon1, $lat2, $lon2) {
        /*if (($lat1 == $lat2) && ($lon1 == $lon2)) {
            return 0;
        }
        else {
            $theta = $lon1 - $lon2;
            $dist = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) +  cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta));
            $dist = acos($dist);
            $dist = rad2deg($dist);
            $miles = $dist * 60 * 1.1515;

            return round($miles);
        }*/

        $url = "https://maps.googleapis.com/maps/api/distancematrix/json?units=imperial&origins=".$lat1.",".$lon1."&destinations=".$lat2.",".$lon2."&departure_time=now&key=AIzaSyCw3JxzgjSushvBkUbe-aB5p4lijEkJR-4";
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_URL, $url);

        $result = curl_exec($ch);
        $address = json_decode($result);
//        dd($address);
        if(@$address->status=="OK"){
            $distance = @$address->rows[0]->elements[0]->distance->text;
            if($distance!=""){

                $distance = explode(' ', $distance);
                $distance = (double) $distance[0];

                $duration_in_traffic = ceil($address->rows[0]->elements[0]->duration_in_traffic->value/60);
            }
            return $distance;
        }
    }

    public function testMail($data, $email_to)
    {
        $categoryName = Categories::findOrFail($data['category_id'])->name;

        $flightName='';
        $flightName1='';
        $flightNumber='';
        $flightNumber1='';
        $terminal='';
        $terminal1='';
        $toll='';
        $roundTripFrom='';
        $rounTripTo ="";
        $round_pickup_date='';
        $round_pickup_time='';

        if(isset($data['flight_name']) and !empty($data['flight_name'])){
            $flightName = '  <tr>
						  <th align="center">Flight Name</th>
						  <td align="center">'.$data['flight_name'].'</td>
					  </tr>';
        }
        if(isset($data['flight_name1']) and !empty($data['flight_name1'])){
            $flightName1 = '  <tr>
						  <th align="center">Flight Name</th>
						  <td align="center">'.$data['flight_name1'].'</td>
					  </tr>';
        }
        if(isset($data['toll']) and !empty($data['toll'])){
            $toll = '  <tr>
						  <th align="center">Toll</th>
						  <td align="center">'.$data['toll'].'</td>
					  </tr>';
        }
        if(isset($data['flight_number']) and !empty($data['flight_number'])){
            $flightNumber = '  <tr>
						  <th align="center">Flight Number</th>
						  <td align="center">'.$data['flight_number'].'</td>
					  </tr>';
        }
        if(isset($data['flight_number1']) and !empty($data['flight_number1'])){
            $flightNumber1 = '  <tr>
						  <th align="center">Flight Number</th>
						  <td align="center">'.$data['flight_number1'].'</td>
					  </tr>';
        }
        if(isset($data['terminal']) and !empty($data['terminal'])){
        $terminal = '  <tr>
						  <th align="center">Terminal</th>
						  <td align="center">'.$data['terminal'].'</td>
					  </tr>';
        }
        if(isset($data['terminal1']) and !empty($data['terminal1'])){
        $terminal1 = '  <tr>
						  <th align="center">Terminal</th>
						  <td align="center">'.$data['terminal1'].'</td>
					  </tr>';
        }
        
          if($data['round_trip'] == '1'){
           
            $roundTripFrom = '<tr>
						  <th align="center">Round Trip From</th>
						  <td align="center">'.$data['round_pickup_location'].'</td>
					  </tr>';
					  
					  $rounTripTo = '<tr>
						  <th align="center">Round Trip To</th>
						  <td align="center">'.$data['round_dropoff_location'].'</td>
					  </tr>';
					  
					  $round_pickup_date='<tr>
						  <th align="center">Round Trip Date</th>
						  <td align="center">'.date('m-d-Y', strtotime($data['round_pickup_date'])).'</td>
					  </tr>';
					  
			$round_pickup_time='<tr>
						  <th align="center">Round Trip Date</th>
						  <td align="center">'.date('h:i:s a', strtotime($data['round_pickup_time'])).'</td>
					  </tr>';
        }
        $message = '<html>
				<head>
				  <title>Your Confirmed Ride Detail</title>
				  <style>
						#ride {
						  font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
						  border-collapse: collapse;
						  width: 50%;
						}

						#ride td, #ride th {
						  border: 1px solid #ddd;
						  padding: 8px;
						}

						#ride tr:nth-child(even){background-color: #f2f2f2;}

						#ride tr:hover {background-color: #ddd;}

						#ride th {
						  padding-top: 12px;
						  padding-bottom: 12px;
						  text-align: right;
						  background-color: #4CAF50;
						  color: white;
						  width:200px;
						}
					</style>
				</head>
				<body>
				 	  
				  <table id="ride">
			  
                    <tr>
                        <th align="center">BOOKING CONFIRMATION #</th>
                        <td align="center">'.$data['unique_id'].'</td>
                    </tr>	
					  <tr>
						  <th align="center">Name</th>
						  <td align="center">'.$data['name'].'</td>
					  </tr>					  
					  <tr>
						  <th align="center">Email Address</th>
						  <td align="center">'.$data['email'].'</td>
					  </tr>
					  <tr>
						  <th align="center">Contact Number</th>
						  <td align="center">'.$data['phone_number'].'</td>
					  </tr>
					  <tr>
						  <th align="center">Passengers</th>
						  <td align="center">'.$data['no_of_passengers'].'</td>
					  </tr>
					  <tr>
						  <th align="center">Pickup Date</th>
						  <td align="center">'.date('m-d-Y', strtotime($data['pickup_date'])).'</td>
					  </tr>
					  <tr>
						  <th align="center">Pickup Time</th>
						  <td align="center">'.date('h:i a', strtotime($data['pickup_time'])).'</td>
					  </tr>
					  <tr>
						  <th align="center">Pick Up Address</th>
						  <td align="center">'.$data['pickup_location'].'</td>
					  </tr>'.$flightName.''.$flightNumber.''.$terminal.'
					  <tr>
						  <th align="center">Drop Off Address</th>
						  <td align="center">'.$data['dropoff_location'].'</td>
					  </tr>'.$flightName1.''.$flightNumber1.''.$terminal1.'
					  '.$toll.''.$roundTripFrom.''.$rounTripTo.''.$round_pickup_date.''.$round_pickup_time.'
					  <tr>
						  <th align="center">Category Name</th>
						  <td align="center">'.$categoryName.'</td>
					  </tr>
					  
					  <tr>
						  <th align="center">Base Fare</th>
						  <td align="center">$ '.$data['fare_without_taxes'].'</td>
					  </tr>
					  
					  <tr>
						  <th align="center">Gratuity</th>
						  <td align="center">$ '.$data['gratuty'].'</td>
					  </tr>

                      <tr>
						  <th align="center">Congestion</th>
						  <td align="center">$ '.$data['congestion'].'</td>
					  </tr>
					  
					  <tr>
						  <th align="center">Black Car Fund</th>
						  <td align="center">$ '.$data['black_car_finder_fee'].'</td>
					  </tr>
					  
					  <tr>
						  <th align="center">Sales Tax</th>
						  <td align="center">$ '.$data['new_york_city_fee'].'</td>
					  </tr>
					  
					  <tr>
						  <th align="center">Total Amount</th>
						  <td align="center">$ '.$data['charges'].'</td>
					  </tr>
					  
					  <tr>
					    <td colspan="2" style="color:red">Note* Toll tax may be applicable</td>
                    </tr>
					 
					</table>
				</body>
				</html>
				';

        $emailData = [
            'email_from'    => env("MAIL_USERNAME", "booking.alpharides@gmail.com"),
            'email_to'      => $email_to,
            'email_subject' => 'Your Confirmed Ride Detail',
            'final_content' => $message,
        ];

        Email::sendEmail($emailData);
        return ['status' => true, 'message' => 'email send'];
    }

    public function testingEmail()
    {
        $emailData = [
            'email_from'    => env("MAIL_USERNAME", "booking.alpharides@gmail.com"),
            'email_to'      => 'wasim.iqtm@gmail.com',
            'email_subject' => 'Your Confirmed Ride Detail',
            'final_content' => '<h1>Testing</h1>',
        ];

        Email::sendEmail($emailData);
        /*if($email['status'])
        {
            $this->testMail($ride, 'booking.alpharides@gmail.com');
        }*/
        echo 'email sent';
    }

}

