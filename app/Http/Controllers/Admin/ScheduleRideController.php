<?php



namespace App\Http\Controllers\Admin;



use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Hashids,Datatables,Auth,Session;
use App\User;
use App\Models\ScheduleRide;


class ScheduleRideController extends Controller

{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */

    public function index()
    {   
        return view('admin.schedule-rides.index');
    }

    /**
     * get makes
     *
     * 
     */

    public function getScheduleRides(Request $request){
        
        $rides = ScheduleRide::with('rider','category')->orderBy('updated_at','desc');
        
        if(!empty($request->rider_id)){            
            $rides->where('rider_id',$request->rider_id);
        }
        
        return Datatables::of($rides)
            ->addColumn('category_name', function ($ride) {
                return @$ride->category->name;               
            })            
            ->addColumn('rider_name', function ($ride) {
                return @$ride->rider->name;               
            })
            ->addColumn('advance_booking_fee', function ($ride) {
                if($ride->advance_booking_fee>0){
                    return '$'.$ride->advance_booking_fee;    
                }                
                return $ride->advance_booking_fee;               
            })
            ->addColumn('cancelation_fee', function ($ride) {
                if($ride->cancelation_fee>0){
                    return '$'.$ride->cancelation_fee;    
                }
                return $ride->cancelation_fee;               
            })
            ->addColumn('ride_date', function ($ride) {
                return date('m-d-Y h:i a', strtotime($ride->created_at));               
            })
            ->editColumn('id', 'ID: {{$id}}')
            ->rawColumns(['category_name'])
            ->make(true);    

    }

}

