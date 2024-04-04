<?php



namespace App\Http\Controllers\Admin;



use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Hashids,Datatables,Auth,Session;
use App\Models\Make;


class MakeController extends Controller

{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */

    public function index()
    {
        
        return view('admin.makes.index');
    }


    /**
     * get makes
     *
     * 
     */

    public function getMakes(){
        
        $makes = Make::orderBy('updated_at','desc');          

        return Datatables::of($makes)
            ->addColumn('action', function ($make) {
                return '<a href="makes/'.Hashids::encode($make->id).'/edit" class="text-primary" data-toggle="tooltip" title="Edit Make"><i class="fa fa-edit"></i></a> 
                        <a href="javascript:void(0)" class="text-danger btn-delete" data-toggle="tooltip" title="Delete Make" id="'.Hashids::encode($make->id).'"><i class="fa fa-trash"></i></a>';
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
        return view('admin.makes.create');
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
            'name' => 'required|max:255'            
        ]);   


        $requestData = $request->all();  

        $make = Make::create($requestData);        

        Session::flash('success', 'Make successfully created!');        

        return redirect('admin/makes');  

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

        $make = Make::find($id);

        return view('admin.makes.edit', compact('make'));
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

        
        $make = Make::findOrFail($id);

        $requestData = $request->all();

        $make->update($requestData);

        
        Session::flash('success', 'Make successfully updated!');

        return redirect('admin/makes');
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

    

}

