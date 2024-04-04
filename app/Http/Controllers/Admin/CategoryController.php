<?php



namespace App\Http\Controllers\Admin;



use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Hashids,Datatables,Auth,Session;
use App\Models\Make;
use App\Models\Models;
use App\Models\Categories;
use Image;


class CategoryController extends Controller

{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */

    public function index()
    {
        
        return view('admin.categories.index');
    }


    /**
     * get categories
     * 
     */

    public function getCategories(){
        
        $categories = Categories::orderBy('updated_at','desc');             

        return Datatables::of($categories)
            ->addColumn('image', function ($category) {
                return '<img width="50px" src="'. checkImage('categories/'. $category->image).'" alt="" />';
            })
            ->addColumn('car_icon', function ($category) {
                return '<img width="50px" src="'. checkImage('categories/'. $category->car_icon).'" alt="" />';
            })
            ->addColumn('action', function ($category) {
                return '<a href="category-models/'.Hashids::encode($category->id).'" class="text-success" data-toggle="tooltip" title="Category Models"><i class="fa fa-car"></i></a>
                    <a href="categories/'.Hashids::encode($category->id).'/edit" class="text-primary" data-toggle="tooltip" title="Edit Category"><i class="fa fa-edit"></i></a>';
            })
            ->editColumn('id', 'ID: {{$id}}')
            ->rawColumns(['image','action'])
            ->make(true);    

             
            // <a href="javascript:void(0)" class="text-danger btn-delete" data-toggle="tooltip" title="Delete Category" id="'.Hashids::encode($category->id).'"><i class="fa fa-trash"></i></a>

    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */

    public function create()
    {               
        $makes = Make::pluck('name','id');
        return view('admin.categories.create', compact('makes'));
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
            'name' => 'required|max:255',            
            'base_fare' => 'required|numeric',            
            'no_of_bags' => 'required|numeric',
            'no_of_passengers' => 'required|numeric',
            'alternate_fare' => 'required|numeric',
            'cost_per_mile' => 'required|numeric',
            'cost_per_minute' => 'required|numeric',            
            'advance_booking_fee' => 'required|numeric',          
            'cancelation_fee' => 'required|numeric',          
            'meet_greet_fee' => 'required|numeric',          
            'black_car_finder_fee' => 'required|numeric',          
            /*'state_wise_percentage' => 'required|numeric',*/
            'new_york_city_fee' => 'required|numeric',
            /*'sr_cancelation_fee' => 'required|numeric',*/
            'cancel_schedule_ride_min_period' => 'required|numeric',          
            'cancel_schedule_ride_max_period' => 'required|numeric'          
        ]);   


        $requestData = $request->all();  

        $category = Categories::create($requestData);        

        //save image
        if($request->hasFile('image')){
            $destinationPath = public_path('uploads/categories'); // upload path
            $image = $request->file('image'); // file
            $extension = $image->getClientOriginalExtension(); // getting image extension
            $fileName = $category->id.'-'.str_random(10).'.'.$extension; // renameing image

            $img = Image::make($image->getRealPath());
            $img->resize(100, 100, function ($constraint) {
                $constraint->aspectRatio();
            })->save($destinationPath.'/thumbs/'.$fileName);

            $image->move($destinationPath, $fileName); // uploading file to given path

            //update image record
            $category_image['image'] = $fileName;
            $category->update($category_image);
        }
        if($request->hasFile('car_icon')){
            $destinationPath = 'uploads/categories'; // upload path
            $car_icon = $request->file('car_icon'); // file
            $extension = $image->getClientOriginalExtension(); // getting image extension
            $fileName = $category->id.'-icon-'.str_random(10).'.'.$extension; // renameing image

            $img = Image::make($image->getRealPath());
            $img->resize(100, 100, function ($constraint) {
                $constraint->aspectRatio();
            })->save($destinationPath.'/thumbs/'.$fileName);

            $image->move($destinationPath, $fileName); // uploading file to given path

            //update image record
            $category_image['car_icon'] = $fileName;
            $category->update($category_image);
        }


        Session::flash('success', 'Category successfully created!');        

        return redirect('admin/categories');  

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
        $category = Categories::find($id);

        //dd($category->toArray());

        return view('admin.categories.edit', compact('category','makes'));
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
            'no_of_bags' => 'required|numeric',
            'no_of_passengers' => 'required|numeric',
            'base_fare' => 'required|numeric',            
            'cost_per_mile' => 'required|numeric',            
            'cost_per_minute' => 'required|numeric',            
            'advance_booking_fee' => 'required|numeric',
            'cancelation_fee' => 'required|numeric',
            'meet_greet_fee' => 'required|numeric',          
            'black_car_finder_fee' => 'required|numeric',
            /*'state_wise_percentage' => 'required|numeric',*/
            'new_york_city_fee' => 'required|numeric',
            /*'sr_cancelation_fee' => 'required|numeric',*/
            'cancel_schedule_ride_min_period' => 'required|numeric',          
            'cancel_schedule_ride_max_period' => 'required|numeric'
        ]);

        
        $category = Categories::findOrFail($id);

        $requestData = $request->all();
        //save image
        if($request->hasFile('image')){
            $destinationPath = public_path('uploads/categories'); // upload path
            $image = $request->file('image'); // file
            $extension = $image->getClientOriginalExtension(); // getting image extension
            $fileName = $category->id.'-'.str_random(10).'.'.$extension; // renameing image

            $img = Image::make($image->getRealPath());
            $img->resize(100, 100, function ($constraint) {
                $constraint->aspectRatio();
            })->save($destinationPath.'/thumbs/'.$fileName);

            $image->move($destinationPath, $fileName); // uploading file to given path

            //update image record
            $requestData['image'] = $fileName;            
        }
        if($request->hasFile('car_icon')){
            $destinationPath = public_path('uploads/categories'); // upload path
            $image = $request->file('car_icon'); // file
            $extension = $image->getClientOriginalExtension(); // getting image extension
            $fileName = $category->id.'-icon-'.str_random(10).'.'.$extension; // renameing image

            $img = Image::make($image->getRealPath());
            $img->resize(100, 100, function ($constraint) {
                $constraint->aspectRatio();
            })->save($destinationPath.'/thumbs/'.$fileName);

            $image->move($destinationPath, $fileName); // uploading file to given path

            //update image record
            $requestData['car_icon'] = $fileName;            
        }

        $category->update($requestData);

        
        Session::flash('success', 'Category successfully updated!');

        return redirect('admin/categories');
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

        $category = Categories::find($id);

        if($category){

            $category->delete();
            $response['success'] = 'Category successfully deleted!';
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

