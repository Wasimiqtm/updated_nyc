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
use App\Asset;
use Illuminate\Support\Collection;

class AssetsController extends Controller
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
        
        return view('assets.index');
    }

    /**
     * get students
     *
     * 
     */
    public function getAssets(){
        
        $assets = Asset::get();            
        
        return Datatables::of($assets)
            ->addColumn('image', function ($asset) {
                return "<img style='width:30px;' src=".checkImage('assets/thumbs/'. $asset->image).">";               
            })            
            ->addColumn('action', function ($asset) {
                return '<a href="company-assets/'.Hashids::encode($asset->id).'/edit" class="text-primary" data-toggle="tooltip" title="Edit Asset"><i class="fa fa-edit"></i></a> 
                        <a href="javascript:void(0)" class="text-danger btn-delete" data-toggle="tooltip" title="Delete Asset" id="'.Hashids::encode($asset->id).'"><i class="fa fa-trash"></i></a>';
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
        return view('assets.create');
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
       
        $asset = Asset::create($requestData);        
        
        //save profile image
        if($request->hasFile('image')){
            $destinationPath = 'uploads/assets'; // upload path
            $image = $request->file('image'); // file
            $extension = $image->getClientOriginalExtension(); // getting image extension
            $fileName = $asset->id.'-'.str_random(10).'.'.$extension; // renameing image
            
            $img = Image::make($image->getRealPath());
            $img->resize(100, 100, function ($constraint) {
                $constraint->aspectRatio();
            })->save($destinationPath.'/thumbs/'.$fileName);

            $image->move($destinationPath, $fileName); // uploading file to given path
            
            //update image record
            $asset_image['image'] = $fileName;
            $asset->update($asset_image);
        }
        
        Session::flash('success', 'Company asset added!');        

        return redirect('company-assets');  
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
        
        $asset = Asset::find($id);
        
        return view('assets.edit', compact('asset'));
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
        
        
        $asset = Asset::findOrFail($id);
              
        
        $requestData = $request->all();
                                
        
        $asset->update($requestData);

        /*-----image manipulation-----*/
        if ($request->hasFile('image'))
        {
            $image = $request->file('image');
            $image_name = $asset->id.'_'.rand(11111,99999).'.'.$image->getClientOriginalExtension();
            $destinationPath = public_path('/uploads/assets/thumbs');
            $img = Image::make($image->getRealPath());
            /*save image thumbnamil*/
            $img->resize(100, 100, function ($constraint) {
                $constraint->aspectRatio();
            })->save($destinationPath.'/'.$image_name);

            /*save original image*/
            $destinationPath = public_path('/uploads/students');
            $image->move($destinationPath, $image_name);

            /*unlink old image*/
            @unlink(public_path("/uploads/assets/$asset->image"));
            @unlink(public_path("/uploads/assets/thumbs/$asset->image"));

            $asset->image = $image_name;
            $asset->save(); 
        }
        
        Session::flash('success', 'Company asset successfully updated!');

        return redirect('company-assets');
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

        $asset = Asset::find($id);

        if($asset){
            $asset->delete();
            $response['success'] = 'Company asset deleted!';
            $status = $this->successStatus;  
        }else{
            $response['error'] = 'Company asset not exist against this id!';
            $status = $this->notFoundStatus;  
        }
        
        return response()->json(['result'=>$response], $status);
    }    
    
}
