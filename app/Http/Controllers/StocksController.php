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
use App\Stock;
use Illuminate\Support\Collection;

class StocksController extends Controller
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
        
        return view('stocks.index');
    }

    /**
     * get students
     *
     * 
     */
    public function getStocks(){
        
        $stocks = Stock::orderBy('id','desc');            
        
        return Datatables::of($stocks)
            ->addColumn('image', function ($stock) {
                return "<img style='width:30px;' src=".checkImage('products/thumbs/'. $stock->image).">";               
            })            
            ->addColumn('action', function ($stock) {
                return '<a href="stocks/'.Hashids::encode($stock->id).'/edit" class="text-primary" data-toggle="tooltip" title="Edit Stock"><i class="fa fa-edit"></i></a> 
                        <a href="javascript:void(0)" class="text-danger btn-delete" data-toggle="tooltip" title="Delete Stock" id="'.Hashids::encode($stock->id).'"><i class="fa fa-trash"></i></a>';
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
        return view('stocks.create');
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
            'code' => 'required|unique:stocks',            
            'cost' => 'required|numeric',            
            'price' => 'required|numeric'            
        ]);   
        
        $requestData = $request->all();  
       
        $stock = Stock::create($requestData);        
        
        //save profile image
        if($request->hasFile('image')){
            $destinationPath = 'uploads/products'; // upload path
            $image = $request->file('image'); // file
            $extension = $image->getClientOriginalExtension(); // getting image extension
            $fileName = $stock->id.'-'.str_random(10).'.'.$extension; // renameing image
            
            $img = Image::make($image->getRealPath());
            $img->resize(100, 100, function ($constraint) {
                $constraint->aspectRatio();
            })->save($destinationPath.'/thumbs/'.$fileName);

            $image->move($destinationPath, $fileName); // uploading file to given path
            
            //update image record
            $stock_image['image'] = $fileName;
            $stock->update($stock_image);
        }
        
        Session::flash('success', 'Stock successfully added!');        

        return redirect('stocks');  
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
        
        $stock = Stock::find($id);
        
        return view('stocks.edit', compact('stock'));
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
            'code' => 'required|unique:stocks,code,'.$id,            
            'cost' => 'required|numeric',            
            'price' => 'required|numeric'            
        ]);           
        
        
        $stock = Stock::findOrFail($id);
                      
        $requestData = $request->all();
                                
        
        $stock->update($requestData);

        /*-----image manipulation-----*/
        if ($request->hasFile('image'))
        {
            $image = $request->file('image');
            $image_name = $stock->id.'_'.rand(11111,99999).'.'.$image->getClientOriginalExtension();
            $destinationPath = public_path('/uploads/products/thumbs');
            $img = Image::make($image->getRealPath());
            /*save image thumbnamil*/
            $img->resize(100, 100, function ($constraint) {
                $constraint->aspectRatio();
            })->save($destinationPath.'/'.$image_name);

            /*save original image*/
            $destinationPath = public_path('/uploads/products');
            $image->move($destinationPath, $image_name);

            /*unlink old image*/
            @unlink(public_path("/uploads/products/$stock->image"));
            @unlink(public_path("/uploads/products/thumbs/$stock->image"));

            $stock->image = $image_name;
            $stock->save(); 
        }
        
        Session::flash('success', 'Stock successfully updated!');

        return redirect('stocks');
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

        $stock = Stock::find($id);

        if($stock){
            $stock->delete();
            $response['success'] = 'Stock successfully deleted!';
            $status = $this->successStatus;  
        }else{
            $response['error'] = 'Stock not exist against this id!';
            $status = $this->notFoundStatus;  
        }
        
        return response()->json(['result'=>$response], $status);
    }    
    
}
