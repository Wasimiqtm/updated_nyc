<?php



namespace App\Http\Controllers\Admin;



use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Hashids,Datatables,Auth,Session;
use App\User;
use Image;
use Twilio\Rest\Client;

class RiderController extends Controller

{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */

    public function index()
    {   

        return view('admin.riders.index');
    }

    public function getRiders(){
        
        $riders = User::with('rider_rides')->rider()->orderBy('updated_at','desc');            

        return Datatables::of($riders)
            ->addColumn('total_rides', function ($rider) {
                return  @$rider->rider_rides->count();   
            })
            ->addColumn('status', function ($rider) {
                if($rider->status == 1){
                    return '<a href="javascript:void(0)" class="btn btn-xs btn-success" data-toggle="tooltip" title="Active"><i class="fa fa-check"></i> Active</a>';
                }else{
                    return '<a href="javascript:void(0)" class="btn btn-xs btn-danger" data-toggle="tooltip" title="Inactive"><i class="fa fa-times"></i> Inactive</a>';
                }               
            })
            ->editColumn('id', 'ID: {{$id}}')
            ->rawColumns(['total_rides','status','action'])
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


    public function sendMessageToRiders(Request $request)
    {

        if($request->has('message')){

            $this->validate($request, [ 
                'rider_id' => 'required',
                'message' => 'required',                        
            ]);

            $sid = "AC77ca93fec72bbefdad853a6a7385b4af"; // Your Account SID from www.twilio.com/console
            $token = "360d6b40940d4b013c7f6e26a555e000"; // Your Auth Token from www.twilio.com/console
            $client = new Client($sid, $token);
            $invalid_numbers = [];
            
            foreach($request->rider_id as $rider_number){
                if($rider_number!=""){
                    try{
                        $message = $client->messages->create(
                          $rider_number, // Text this number
                          array(
                            'from' => '+19292099910', // From a valid Twilio number
                            'body' => $request->message
                          )
                        );
                    } catch (\Exception $e) {
                        $invalid_numbers[] = $rider_number;
                        continue;
                        //exit($e->getMessage());
                    }
                }
                
            }                         

            // if(count($invalid_numbers)>0){
            //     $invalid_number = implode(', ', $invalid_numbers);
            //     Session::flash('invalid_numbers', 'Message not sent to these numbers ('.$invalid_number.')');  
            //     if(count($invalid_numbers)<count($request->rider_id)){
            //         Session::flash('success', 'Message successfully sent other valid numbers!');
            //     }              
            // }else{
                Session::flash('success', 'Message successfully sent to riders!');
            // }    

            return redirect('admin/send-message-to-riders');
        }

        $riders = User::rider()->where('phone_number','!=','')->pluck('name','phone_number'); 
        return view('admin.riders.message',compact('riders'));
    }   

}

