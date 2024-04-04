<?php



namespace App\Http\Controllers\Admin;



use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Hashids,Datatables,Auth,Session;
use App\Models\Make;
use App\Models\Models;


class ModelController extends Controller

{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */

    public function index()
    {
        
        return view('admin.models.index');
    }


    /**
     * get models
     * 
     */

    public function getModels(){
        
        $models = Models::with('make')->orderBy('updated_at','desc');           

        return Datatables::of($models)
            ->addColumn('make_name', function ($model) {
                return @$model->make->name;
            })
            ->addColumn('action', function ($model) {
                return '<a href="models/'.Hashids::encode($model->id).'/edit" class="text-primary" data-toggle="tooltip" title="Edit Model"><i class="fa fa-edit"></i></a> 
                        <a href="javascript:void(0)" class="text-danger btn-delete" data-toggle="tooltip" title="Delete Model" id="'.Hashids::encode($model->id).'"><i class="fa fa-trash"></i></a>';
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
        $makes = Make::pluck('name','id');
        return view('admin.models.create', compact('makes'));
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
            'make_id' => 'required',            
            'name' => 'required|max:255'            
        ]);   


        $requestData = $request->all();  

        $model = Models::create($requestData);        

        Session::flash('success', 'Model successfully created!');        

        return redirect('admin/models');  

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

        $makes = Make::pluck('name','id');
        $model = Models::find($id);

        return view('admin.models.edit', compact('model','makes'));
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
            'make_id' => 'required',
            'name' => 'required|max:255'            
        ]);           

        
        $model = Models::findOrFail($id);

        $requestData = $request->all();

        $model->update($requestData);

        
        Session::flash('success', 'Model successfully updated!');

        return redirect('admin/models');
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

        $model = Models::find($id);

        if($model){

            $model->delete();
            $response['success'] = 'Model successfully deleted!';
            $status = $this->successStatus;  

        }else{

            $response['error'] = 'Model not exist against this id!';
            $status = $this->notFoundStatus;  

        }

        return response()->json(['result'=>$response], $status);

    }    

    

}

