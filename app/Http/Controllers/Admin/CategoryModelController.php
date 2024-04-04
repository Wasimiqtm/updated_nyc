<?php



namespace App\Http\Controllers\Admin;



use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Hashids,Datatables,Auth,Session;
use App\Models\Make;
use App\Models\Models;
use App\Models\Categories;
use App\Models\CategoryModels;
use Image;


class CategoryModelController extends Controller

{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */

    public function index($id)
    {
        $encoded_id = $id;
        $id = Hashids::decode($id)[0];

        $category = Categories::find($id);

        return view('admin.category-models.index',compact('id','encoded_id','category'));
    }


    /**
     * get category models
     * 
     */

    public function getCategoryModels($id){
        
       
        $models = CategoryModels::with('model.make')->where('category_id',$id)->orderBy('updated_at','desc');               

        return Datatables::of($models)
            ->addColumn('make_name', function ($model) {
                return @$model->model->make->name;
            })
            ->addColumn('model_name', function ($model) {
                return @$model->model->name;
            })
            ->addColumn('action', function ($model) {
                return '<a href="javascript:void(0)" class="text-danger btn-delete" data-toggle="tooltip" title="Delete Category Model" id="'.Hashids::encode($model->id).'"><i class="fa fa-trash"></i></a>';
            })
            ->editColumn('id', 'ID: {{$id}}')
            ->rawColumns(['image','action'])
            ->make(true);    

    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */

    public function create($id)
    {               
        $encoded_id = $id;
        $makes = Make::pluck('name','id');
        return view('admin.category-models.create', compact('encoded_id','makes'));
    }

    
    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */

    public function store($id, Request $request)
    {     
        $encoded_id = $id;
        $id = Hashids::decode($id)[0];       

        $this->validate($request, [ 
            'make_id' => 'required',
            'model_id' => 'required'       
        ]);   

        $category = Categories::find($id);
        if($category){
            $requestData['category_id'] = $category->id;            
            $requestData['model_id'] = $request->model_id;  
            $category_model = CategoryModels::firstOrNew($requestData);        
            $category_model->save();     

            Session::flash('success', 'Category model successfully added!');        

            return redirect('admin/category-models/'.$encoded_id);  
        }else{
            Session::flash('error', 'Category not found against this id!');        

            return redirect('admin/category-models/'.$encoded_id); 
        }

        
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

        $category = CategoryModels::find($id);

        if($category){

            $category->delete();
            $response['success'] = 'Category model successfully deleted!';
            $status = $this->successStatus;  

        }else{

            $response['error'] = 'Category not exist against this id!';
            $status = $this->notFoundStatus;  

        }

        return response()->json(['result'=>$response], $status);

    }    

    public function getModels($id)
    {
        $models = Models::where('make_id',$id)->pluck('name','id');
        if(count($models)>0){
            $response['status'] = true;
            $response['models'] = $models;
        }else{
            $response['status'] = false;
        }

        return response()->json(['result'=>$response], 200);
    }

}

