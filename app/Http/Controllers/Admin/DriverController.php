<?php



namespace App\Http\Controllers\Admin;


use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Hashids,Datatables,Auth,Session;
use App\User;
use App\Models\Make;
use App\Models\DriverCar;
use App\Models\CategoryModels;
use Image;
use Twilio\Rest\Client;

class DriverController extends Controller

{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */

    public function index()
    {   
        //$drivers = User::with('driver_car.category_model.model.make')->driver()->orderBy('updated_at','desc')->get(); 
        //dd($drivers->toArray());
        // $origin = "45.291002,-0.868131";
        // $destination = "44.683159,-0.405704";
        // $waypoints = array(
        //     "44.8765065,-0.4444849",
        //     "44.8843778,-0.1368667"
        //   );

        // $map_url = $this->getStaticGmapURLForDirection($origin, $destination, $waypoints);

        // echo '<img src="'.$map_url.'"/>';
        // exit;
        return view('admin.drivers.index');
    }

    private function getStaticGmapURLForDirection($origin, $destination, $waypoints, $size = "500x500") {
        $markers = array();
        $waypoints_labels = array("A", "B", "C", "D", "E", "F", "G", "H", "I", "J", "K");
        $waypoints_label_iter = 0;
        $markers[] = "markers=color:green" . urlencode("|") . "label:" . urlencode($waypoints_labels[$waypoints_label_iter++] . '|' . $origin);
        foreach ($waypoints as $waypoint) {
            $markers[] = "markers=color:blue" . urlencode("|") . "label:" . urlencode($waypoints_labels[$waypoints_label_iter++] . '|' . $waypoint);
        }
        $markers[] = "markers=color:red" . urlencode("|") . "label:" . urlencode($waypoints_labels[$waypoints_label_iter] . '|' . $destination);
        $url = "https://maps.googleapis.com/maps/api/directions/json?mode=driving&origin=$origin&destination=$destination&key=AIzaSyBfe1Nw8nQENKRT9WcLlz7Uu0wTlrrFLQU&waypoints=optimize:true|" . implode($waypoints, '|');
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, false);
        $result = curl_exec($ch);
        curl_close($ch);
        $googleDirection = json_decode($result, true);
        $polyline = urlencode($googleDirection['routes'][0]['overview_polyline']['points']);
        $markers = implode($markers, '&');
        
        return "https://maps.googleapis.com/maps/api/staticmap?size=$size&maptype=roadmap&key=AIzaSyBfe1Nw8nQENKRT9WcLlz7Uu0wTlrrFLQU&path=enc:$polyline&$markers";
    }

    /**
     * get makes
     *
     * 
     */

    public function getDrivers(){
        
        $drivers = User::driver()->orderBy('updated_at','desc');            

        return Datatables::of($drivers)
            ->addColumn('category_name', function ($driver) {
                return @$driver->driver_car->category_model->category->name;               
            })
            ->addColumn('make_model_name', function ($driver) {
                return @$driver->driver_car->category_model->model->make->name .' - '. @$driver->driver_car->category_model->model->name;               
            })
            ->addColumn('status', function ($driver) {
                if($driver->status == 1){
                    return '<a href="javascript:void(0)" class="btn btn-xs btn-success" data-toggle="tooltip" title="Active"><i class="fa fa-check"></i> Active</a>';
                }else{
                    return '<a href="javascript:void(0)" class="btn btn-xs btn-danger" data-toggle="tooltip" title="Inactive"><i class="fa fa-times"></i> Inactive</a>';
                }               
            })
            ->addColumn('online_status', function ($driver) {
                if($driver->online_status == '1'){
                    return '<a href="javascript:void(0)" class="btn btn-xs btn-success" data-toggle="tooltip" title="Online">Online</a>';
                }else{
                    return '<a href="javascript:void(0)" class="btn btn-xs btn-danger" data-toggle="tooltip" title="Offline">Offline</a>';
                }               
            })
            ->addColumn('action', function ($driver) {
                return '<a href="driver-car/'.Hashids::encode($driver->id).'" class="text-success" data-toggle="tooltip" title="Edit Car"><i class="fa fa-car"></i></a>
                    <a href="drivers/'.Hashids::encode($driver->id).'/edit" class="text-primary" data-toggle="tooltip" title="Edit Driver"><i class="fa fa-edit"></i></a>';
            })
            ->editColumn('id', 'ID: {{$id}}')
            ->rawColumns(['category_name','online_status','status','action'])
            ->make(true);    

    }



    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */

    public function create()
    {               
        exit;
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

        exit;

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

        $driver = User::find($id);

        return view('admin.drivers.edit', compact('driver'));
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
            'name' => 'required|max:255'            
        ]);           

        
        $user = User::findOrFail($id);

        $requestData = $request->all();

        $destinationPath = 'uploads/users'; // upload path
        //save image
        if($request->hasFile('nys_driver_license')){
            $image = $request->file('nys_driver_license'); // file
            $extension = $image->getClientOriginalExtension(); // getting image extension
            $fileName = $user->id.'-nys-'.str_random(10).'.'.$extension; // renameing image

            $img = Image::make($image->getRealPath());
            $img->resize(100, 100, function ($constraint) {
                $constraint->aspectRatio();
            })->save($destinationPath.'/thumbs/'.$fileName);

            $image->move($destinationPath, $fileName); // uploading file to given path

            $requestData['nys_driver_license'] = $fileName;
        }
        if($request->hasFile('tlc_license')){
            $image1 = $request->file('tlc_license'); // file
            $extension = $image1->getClientOriginalExtension(); // getting image extension
            $fileName1 = $user->id.'-tlc-'.str_random(10).'.'.$extension; // renameing image

            $img1 = Image::make($image1->getRealPath());
            $img1->resize(100, 100, function ($constraint) {
                $constraint->aspectRatio();
            })->save($destinationPath.'/thumbs/'.$fileName1);

            $image1->move($destinationPath, $fileName1); // uploading file to given path

            $requestData['tlc_license'] = $fileName1;
        }
        if($request->hasFile('car_registration')){
            $image2 = $request->file('car_registration'); // file
            $extension = $image2->getClientOriginalExtension(); // getting image extension
            $fileName2 = $user->id.'-car-'.str_random(10).'.'.$extension; // renameing image

            $img2 = Image::make($image2->getRealPath());
            $img2->resize(100, 100, function ($constraint) {
                $constraint->aspectRatio();
            })->save($destinationPath.'/thumbs/'.$fileName2);

            $image2->move($destinationPath, $fileName2); // uploading file to given path

            $requestData['car_registration'] = $fileName2;
        }
        if($request->hasFile('insurance_certificate_of_liability')){
            $image3 = $request->file('insurance_certificate_of_liability'); // file
            $extension = $image3->getClientOriginalExtension(); // getting image extension
            $fileName3 = $user->id.'-ins-'.str_random(10).'.'.$extension; // renameing image

            $img3 = Image::make($image3->getRealPath());
            $img3->resize(100, 100, function ($constraint) {
                $constraint->aspectRatio();
            })->save($destinationPath.'/thumbs/'.$fileName3);

            $image3->move($destinationPath, $fileName3); // uploading file to given path

            $requestData['insurance_certificate_of_liability'] = $fileName3;
        }
        if($request->hasFile('insurance_declaration_page')){
            $image4 = $request->file('insurance_declaration_page'); // file
            $extension = $image4->getClientOriginalExtension(); // getting image extension
            $fileName4 = $user->id.'-ins-'.str_random(10).'.'.$extension; // renameing image

            $img4 = Image::make($image4->getRealPath());
            $img4->resize(100, 100, function ($constraint) {
                $constraint->aspectRatio();
            })->save($destinationPath.'/thumbs/'.$fileName4);

            $image4->move($destinationPath, $fileName4); // uploading file to given path

            $requestData['insurance_declaration_page'] = $fileName4;
        }
        $user->update($requestData);

        
        Session::flash('success', 'Driver successfully updated!');

        return redirect('admin/drivers');
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

        $make = Make::find($id);

        if($make){

            $make->delete();
            $response['success'] = 'Make successfully deleted!';
            $status = $this->successStatus;  

        }else{

            $response['error'] = 'Make not exist against this id!';
            $status = $this->notFoundStatus;  

        }

        return response()->json(['result'=>$response], $status);

    }    

    public function getDriverCar($id)
    {

        $id = Hashids::decode($id)[0];

        $makes = Make::pluck('name','id');
        $driver = User::with(['driver_car.category_model.model'])->find($id);
        
        return view('admin.drivers.driver-car', compact('makes','driver'));
    }
    
    public function updateDriverCar($id, Request $request)
    {

        $id = Hashids::decode($id)[0];

        $this->validate($request, [ 
            'make_id' => 'required',
            'model_id' => 'required',
            //'registration_number' => 'required|unique:driver_car,$id',            
            'registration_number' => 'required',            
            'year' => 'required|numeric',            
        ]); 

        $driver = User::findOrFail($id);

        $requestData = $request->all();

        $model_id = $request->model_id;
        $category_model = CategoryModels::whereModelId($model_id)->first();
        
        if($category_model){
            $driver_car['user_id'] = $id;
            $driver_car = DriverCar::firstOrNew($driver_car);        
            $driver_car->category_model_id = $category_model->id;
            $driver_car->registration_number = $request->registration_number;
            $driver_car->year = $request->year;
            $driver_car->save();

            Session::flash('success', 'Driver car successfully updated!');
        }else{
            Session::flash('error', 'Driver car not successfully updated!');
        }
        

        return redirect('admin/drivers');
    }

    public function sendMessageToDrivers(Request $request)
    {

        if($request->has('message')){

            $this->validate($request, [ 
                'driver_id' => 'required',
                'message' => 'required',                        
            ]);

            $sid = "AC77ca93fec72bbefdad853a6a7385b4af"; // Your Account SID from www.twilio.com/console
            $token = "360d6b40940d4b013c7f6e26a555e000"; // Your Auth Token from www.twilio.com/console
            $client = new Client($sid, $token);
            $invalid_numbers = [];
            foreach($request->driver_id as $driver_number){
                if($driver_number!=""){

                    try{
                        $message = $client->messages->create(
                          $driver_number, // Text this number
                          array(
                            'from' => '+19292099910', // From a valid Twilio number
                            'body' => $request->message
                          )
                        );

                    } catch (\Exception $e) {
                        $invalid_numbers[] = $driver_number;
                        continue;
                        //exit($e->getMessage());
                    }
                }
                
            } 

            // if(count($invalid_numbers)>0){
            //     $invalid_number = implode(', ', $invalid_numbers);
            //     Session::flash('invalid_numbers', 'Message not sent to these numbers ('.$invalid_number.')');  
            //     if(count($invalid_numbers)<count($request->driver_id)){
            //         Session::flash('success', 'Message successfully sent other valid numbers!');
            //     }              
            // }else{
                Session::flash('success', 'Message successfully sent to drivers!');
            // }                       

            
            return redirect('admin/send-message-to-drivers');
        }

        $drivers = User::driver()->where('phone_number','!=','')->pluck('name','phone_number'); 
        return view('admin.drivers.message',compact('drivers'));
    }

    public function sendMessage($number,$message)
    {


            $sid = "AC77ca93fec72bbefdad853a6a7385b4af"; // Your Account SID from www.twilio.com/console
            $token = "360d6b40940d4b013c7f6e26a555e000"; // Your Auth Token from www.twilio.com/console
            $client = new Client($sid, $token);

            try{
                $client->messages->create(
                  $number, // Text this number
                  array(
                    'from' => '+19292099910', // From a valid Twilio number
                    'body' => $message
                  )
                );
            } catch (\Exception $e) {
                exit($e->getMessage());
            }
            

            exit('Message successfully sent!');
    }

    

}

