<?php



namespace App\Http\Controllers\Admin;



use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Slider;
use Image, Hashids,Datatables,Auth,Session;

class SliderController extends Controller

{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */

    public function index()
    {
        
        return view('admin.sliders.index');
    }


    /**
     * get sliders
     * 
     */

    public function getSliders(){
        
        $sliders = Slider::orderBy('updated_at','desc');             

        return Datatables::of($sliders)
            ->addColumn('image', function ($slider) {
                return '<img width="60px" src="'. $slider->image_thumb.'" alt="" />';
            })
            ->addColumn('action', function ($slider) {
                return '<a href="sliders/'.Hashids::encode($slider->id).'/edit" class="text-primary" data-toggle="tooltip" title="Edit Slider"><i class="fa fa-edit"></i></a> 
                        <a href="javascript:void(0)" class="text-danger btn-delete" data-toggle="tooltip" title="Delete Slider" id="'.Hashids::encode($slider->id).'"><i class="fa fa-trash"></i></a>';
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

    public function create()
    {               
        return view('admin.sliders.create');
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

        $slider = Slider::create($requestData);        

        //save image
        if($request->hasFile('image')){
            $destinationPath = 'uploads/sliders'; // upload path
            $image = $request->file('image'); // file
            $extension = $image->getClientOriginalExtension(); // getting image extension
            $fileName = $slider->id.'-'.str_random(10).'.'.$extension; // renameing image

            $img = Image::make($image->getRealPath());
            $img->resize(100, 100, function ($constraint) {
                $constraint->aspectRatio();
            })->save($destinationPath.'/thumbs/'.$fileName);

            $image->move($destinationPath, $fileName); // uploading file to given path

            //update image record
            $slider_image['image'] = $fileName;
            $slider->update($slider_image);
        
        }


        Session::flash('success', 'Slider successfully created!');        

        return redirect('admin/sliders');  

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
        $slider = Slider::find($id);
        return view('admin.sliders.edit', compact('slider'));
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
        ]);          

        
        $slider = Slider::findOrFail($id);

        $requestData = $request->all();

        //save image
        if($request->hasFile('image')){
            $destinationPath = 'uploads/sliders'; // upload path
            $image = $request->file('image'); // file
            $extension = $image->getClientOriginalExtension(); // getting image extension
            $fileName = $slider->id.'-'.str_random(10).'.'.$extension; // renameing image

            $img = Image::make($image->getRealPath());
            $img->resize(100, 100, function ($constraint) {
                $constraint->aspectRatio();
            })->save($destinationPath.'/thumbs/'.$fileName);

            $image->move($destinationPath, $fileName); // uploading file to given path

            //update image record
            $requestData['image'] = $fileName;            
        }
        

        $slider->update($requestData);

        
        Session::flash('success', 'Slider successfully updated!');

        return redirect('admin/sliders');
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

        $slider = Slider::find($id);

        if($slider){

            $slider->delete();
            $response['success'] = 'Slider successfully deleted!';
            $status = $this->successStatus;  

        }else{

            $response['error'] = 'Slider not exist against this id!';
            $status = $this->notFoundStatus;  

        }

        return response()->json(['result'=>$response], $status);

    }   


}

