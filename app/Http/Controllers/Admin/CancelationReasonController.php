<?php



namespace App\Http\Controllers\Admin;



use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Hashids,Datatables,Auth,Session;
use App\Models\CancelationReason;


class CancelationReasonController extends Controller

{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */

    public function index()
    {
        
        return view('admin.cancelation-reasons.index');
    }


    /**
     * get makes
     *
     * 
     */

    public function getCancelationReasons(){
        
        $reasons = CancelationReason::orderBy('updated_at','desc');          

        return Datatables::of($reasons)
            ->addColumn('action', function ($reason) {
                return '<a href="cancelation-reasons/'.Hashids::encode($reason->id).'/edit" class="text-primary" data-toggle="tooltip" title="Edit Reason"><i class="fa fa-edit fa-lg"></i></a> 
                        <a href="javascript:void(0)" class="text-danger btn-delete" data-toggle="tooltip" title="Delete Reason" id="'.Hashids::encode($reason->id).'"><i class="fa fa-trash fa-lg"></i></a>';
            })
            ->editColumn('id', 'ID: {{$id}}')
            ->rawColumns(['action'])
            ->make(true);    

    }



    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */

    public function create()
    {               
        return view('admin.cancelation-reasons.create');
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

        $this->validate($request, [ 
            'reason' => 'required|max:255'            
        ]);   


        $requestData = $request->all();  

        CancelationReason::create($requestData);        

        Session::flash('success', 'Cancelation Reason successfully created!');        

        return redirect('admin/cancelation-reasons');  

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

        $reason = CancelationReason::find($id);

        return view('admin.cancelation-reasons.edit', compact('reason'));
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
            'reason' => 'required|max:255'            
        ]);           

        
        $reason = CancelationReason::findOrFail($id);

        $requestData = $request->all();

        $reason->update($requestData);

        
        Session::flash('success', 'Cancelation Reason successfully updated!');

        return redirect('admin/cancelation-reasons');
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

        $reason = CancelationReason::find($id);

        if($reason){

            $reason->delete();
            $response['success'] = 'Cancelation Reason successfully deleted!';
            $status = $this->successStatus;  

        }else{

            $response['error'] = 'Cancelation Reason not exist against this id!';
            $status = $this->notFoundStatus;  

        }

        return response()->json(['result'=>$response], $status);

    }    

    

}

