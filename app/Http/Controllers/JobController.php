<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Helpers\LogActivity;
use Illuminate\Http\Request;
use Session;
use Alert;
use Image;
use File;
use Hashids;
use Datatables;
use Auth;
use DB;
use App\Student;
use App\Job;
use App\Job_items;
use Illuminate\Support\Collection;

class JobController extends Controller
{
    public $successStatus = 200;
    public $errorStatus = 401;
    public $notFoundStatus = 404;
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {        

        return view('jobs.index');
    }

    /**
     * get students
     *
     * 
     */
    public function getJobs(){
        
        $jobs = Job::orderBy('id','desc');            
        
        return Datatables::of($jobs)            
            ->addColumn('created_at', function ($job) {
                return date('d M, Y H:m a',strtotime($job->created_at));               
            })            
            ->addColumn('status', function ($job) {
                if($job->status == 0){
                    return '<a href="javascript:void(0)" class="btn btn-xs btn-info" data-toggle="tooltip" title="In Progress">In Progress</a>';
                }elseif($job->status == 1){
                    return '<a href="javascript:void(0)" class="btn btn-xs btn-success" data-toggle="tooltip" title="Completed">Completed</a>';
                }else{
                    return '<a href="javascript:void(0)" class="btn btn-xs btn-success" data-toggle="tooltip" title="Collected">Collected</a>';
                }               
            })
            ->addColumn('message', function ($job) {
                if($job->status == 0){
                    return '<a href="change-job-status/'.Hashids::encode($job->id).'/1" class="btn btn-xs btn-primary" data-toggle="tooltip" title="Complete Job">Complete Job</a>';
                }elseif($job->status == 1){
                    return '<a href="change-job-status/'.Hashids::encode($job->id).'/2" class="btn btn-xs btn-primary" data-toggle="tooltip" title="Collect Job">Collect Job</a>';
                }else{
                    return '-';
                }              
            })
            ->addColumn('action', function ($job) {

                
                return '<a href="service-sheet/'.Hashids::encode($job->id).'" target="_blank" class="text-primary" data-toggle="tooltip" title="Print Service Sheet"><i class="fa fa-print"></i></a>
                    <a href="print-invoice/'.Hashids::encode($job->id).'" target="_blank" class="text-success" data-toggle="tooltip" title="Print Invoice"><i class="fa fa-print"></i></a>
                    <a href="print-sticker/'.Hashids::encode($job->id).'" target="_blank" class="text-defautl" data-toggle="tooltip" title="Print Sticker"><i class="fa fa-print"></i></a>
                    <a href="jobs/'.Hashids::encode($job->id).'/edit" class="text-primary" data-toggle="tooltip" title="Edit Job"><i class="fa fa-edit"></i></a>
                        <a href="javascript:void(0)" class="text-danger btn-delete" data-toggle="tooltip" title="Delete Job" id="'.Hashids::encode($job->id).'"><i class="fa fa-trash"></i></a>';
            })
            ->editColumn('id', 'ID: {{$id}}')
            ->rawColumns(['status','message','action'])
            ->make(true);
    // <a href="javascript:void(0)" class="text-danger btn-delete" data-toggle="tooltip" title="Delete Employee" id="'.Hashids::encode($student->id).'"><i class="fa fa-trash"></i></a>
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {                       
        return view('jobs.create',['payment_status'=>1]);
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
        
        
        $requestData = $request->all();  

        $job = Job::create($requestData);        
        
        if($job){
            for($i=1; $i<=$request->total_items; $i++){
                $item_data = [];
                $item_data['job_id'] = $job->id;
                $item_data['name'] = $requestData['item_name-'.$i];
                $item_data['issue'] = $requestData['item_issue-'.$i];
                $item_data['charges'] = $requestData['item_charges-'.$i];

                Job_items::create($item_data);    
            }            
        }
        
        Session::flash('service_id', $job->id); 
        Session::flash('sticker_id', $job->id); 
        Session::flash('success', 'Job successfully created!');        

        return redirect('jobs');  
    }
    
    /**
     * Show the detail of user.
     *
     * @return \Illuminate\View\View
     */
    public function show($id)
    {        
        $id = Hashids::decode($id)[0];
        
        $student = Student::findOrFail($id);
        
        return view('students.registration_form', compact('student'));
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
        
        $job = Job::with('job_items')->find($id);
        
        return view('jobs.edit', compact('job'));
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
        
        
        $job = Job::findOrFail($id);
              
        
        $requestData = $request->all();
                        
        
        $job->update($requestData);

        if($job){
            for($i=1; $i<=$request->total_items; $i++){
                $item_data = [];
                $item_data['id'] = $requestData['item_id-'.$i];
                    
                $job_items = Job_items::firstOrNew($item_data);
                $job_items->job_id = $job->id;
                $job_items->name = $requestData['item_name-'.$i];
                $job_items->issue = $requestData['item_issue-'.$i];
                $job_items->charges = $requestData['item_charges-'.$i];
                $job_items->save(); 
            }            
        } 
        
        Session::flash('success', 'Job successfully updated!');

        return redirect('jobs');
    }

    public function serviceSheet($id)
    {
        $id = Hashids::decode($id)[0];

        $job = Job::with('job_items')->find($id);
        
        return view('jobs.service-sheet', compact('job'));

    }

    public function printInvoice($id)
    {
        $id = Hashids::decode($id)[0];

        $job = Job::with('job_items')->find($id);
        
        return view('jobs.print-invoice', compact('job'));

    }

    public function printSticker($id)
    {
        $id = Hashids::decode($id)[0];

        $job = Job::with('job_items')->find($id);
        
        return view('jobs.print-sticker', compact('job'));

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

        $job = Job::find($id);

        if($job){
            $job->delete();
            $response['success'] = 'Job deleted!';
            $status = $this->successStatus;  
        }else{
            $response['error'] = 'Job not exist against this id!';
            $status = $this->notFoundStatus;  
        }
        
        return response()->json(['result'=>$response], $status);
    }
    
     /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroyItem($id)
    {

        $job = Job_items::find($id);

        if($job){
            $job->delete();
            $response['success'] = 'Job item deleted!';
            $status = $this->successStatus;  
        }else{
            $response['error'] = 'Job not exist against this id!';
            $status = $this->notFoundStatus;  
        }
        
        return response()->json(['result'=>$response], $status);
    }   
    
     /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function changeStatus($id,$status)
    {
        $id = Hashids::decode($id)[0];
        $job = Job::find($id);

        if($job){
            $job->status = $status;
            $job->save();

            Session::flash('success', 'Job status successfully changed!');
        }else{
            Session::flash('error', 'Job not exist against this id!');            
        }
        
        
        return redirect('jobs');        
    }
}
