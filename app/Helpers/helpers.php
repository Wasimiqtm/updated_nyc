<?php

use Illuminate\Support\Facades\Auth;

use App\Country;

use App\User;
use App\Models\ScheduleRide;
use App\Models\Slider;
use App\Models\RideRequest;

if (! function_exists('isActiveRoute')) {

    

    function isActiveRoute($route, $output = "active")

    {

        if (Route::current()->uri == $route) return $output;

    }  

}



if (! function_exists('setActive')) {

    

    function setActive($paths,$class = TRUE)

    {

        foreach ($paths as $path) {



            if(Request::is($path . '*')){

              if($class)

                return ' class=active'; 

              else

                return ' active';   

            }



        }



    }

}


if (! function_exists('checkImage')) {

    

    function checkImage($path, $size=false)

    {        

        $paths = explode('/', $path);

        if($paths[count($paths)-1]==""){
            if($size)
                return asset('uploads/no_image.png'); 
            else
                return asset('uploads/thumbs/no_image.png'); 
        }else{

        if (\File::exists(public_path('uploads/'.$path)))
           return asset('uploads/'.$path);
        else
            if($size)
                return asset('uploads/no_image.png'); 
            else
                return asset('uploads/thumbs/no_image.png'); 
        }    
    } 

}



if (! function_exists('areActiveRoutes')) {



    function areActiveRoutes(Array $routes, $output = "active")

    {

        foreach ($routes as $route)

        {

            if (Route::current()->uri == $route) return $output;

        }



    }



}



if (! function_exists('settingValue')) {

    

    function settingValue($key)

    {

        $setting = \DB::table('site_settings')->where('key',$key)->first();  

        if($setting)

            return $setting->value;

        else

            return '';

    }  

}



if (! function_exists('companySettingValue')) {

    

    function companySettingValue($column)

    {

        if(Auth::guard('company')->check())

           $setting = Company_setting::where('company_id',Auth::id())->first();  

        elseif(Auth::guard('api')->check()){

            $setting = Company_setting::where('company_id',getComapnyIdByUser())->first();  

        }         

        

        if($setting)

            return $setting->{$column};

        else

            return '';

    }  

}



if (! function_exists('companySettingValueApi')) {

    

    function companySettingValueApi($column)

    {

        $setting = Company_setting::where('company_id',getComapnyIdByUser())->first();  

        if($setting)

            return $setting->{$column};

        else

            return '';

    }  

}



if (! function_exists('getCountries')) {

    

    function getCountries()

    {   

        return Country::pluck('name', 'code')->prepend('Select Country','');

    }  

}





if (! function_exists('getParentCategoriesDropdown')) {

    

    function getParentCategoriesDropdown()

    {   

        return Categories::where('parent_id', 0)->pluck('category_name', 'id')->prepend('Root Category',0);

    }  

}

if (! function_exists('getSliders')) {

    

    function getSliders()

    {   

        return Slider::orderBy('ordering','asc')->get();

    }  

}



if (! function_exists('getCurrencyDropdown')) {

    

    function getCurrencyDropdown()

    {   

        return Currency::where('company_id',Auth::id())->pluck('name', 'id')->prepend('Select Currency','');

    }  

}



if (! function_exists('getCategoriesDropdown')) {

    

    function getCategoriesDropdown()

    {   

        $store_ids = Store::where('company_id',Auth::id())->pluck('id');

        

        return Categories::whereIn('store_id',$store_ids)->pluck('category_name', 'id')->prepend('Select Categories','');

        

    }  

}



if (! function_exists('getStoreIds')) {

    

    function getStoreIds()

    {   

        

        if(Auth::guard('company')->check())

           $store_ids = Store::where('company_id',Auth::id())->pluck('id');

        elseif(Auth::guard('api')->check()){

            $store_ids = [Auth::user()->store_id];

        }       

        

        return $store_ids;

        

    }  

}



if (! function_exists('getStoresDropdown')) {

    

    function getStoresDropdown()

    {   

        return Store::where('company_id',Auth::id())->pluck('name', 'id')->prepend('Select Store','');

    }  

}



if (! function_exists('getStoreDropdownHtml')) {

    

    function getStoreDropdownHtml()

    {   

       // if(isset(Request::segment(4)))

            

        $stores = Store::where('company_id',Auth::id())->pluck('name', 'id');

                

        

        $html = '<span class="pull-right col-lg-3" style="margin-top: -5px;">';

        $html .= '<select class="form-control select2" id="store_reports"> ';

        $html .= '<option value="">All Stores</option> ';

        

        foreach($stores as $key => $value){

            $html .= '<option value="'. Hashids::encode($key) .'" '.(Request::segment(4)== Hashids::encode($key)?'selected':'').'>'. $value .'</option> ';

        }

        

        $html .= '</select> ';

        

        return $html;

    }  

}



if (! function_exists('getStoresFilterDropdown')) {

    

    function getStoresFilterDropdown()

    {   

        return Store::where('company_id',Auth::id())->pluck('name', 'id')->prepend('Filter by store','');

    }  

}

if (! function_exists('getDriversFilterDropdown')) {

    function getDriversFilterDropdown()
    {   
        return User::where('user_type','driver')->pluck('name', 'id')->prepend('Filter by Driver','');
    }  
}
if (! function_exists('getRidersFilterDropdown')) {

    function getRidersFilterDropdown()
    {   
        return User::where('user_type','rider')->pluck('name', 'id')->prepend('Filter by Rider','');
    }  
}


if (! function_exists('getProductsDropdown')) {

    

    function getProductsDropdown()

    {   

        return Product::where('company_id',Auth::id())->where('product_id',0)->pluck('name', 'id')->prepend('Select Product','');

    }  

}



if (! function_exists('getSelectedProduct')) {

    

    function getSelectedProduct($product_id)

    {   

        return Product::where('id',$product_id)->pluck('name', 'id');

    }  

}



if (! function_exists('getVariants')) {

    

    function getVariantsDropdown()

    {   

        return Variant::with(['company'])->company(Auth::id())->pluck('name', 'id')->prepend('Select attribute','');

    }  

}



if (! function_exists('getSuppliersDropdown')) {

    

    function getSuppliersDropdown()

    {   

        return Supplier::pluck('name', 'id')->prepend('Select Supplier','');

    }  

}



if (! function_exists('getTaxRatesDropdown')) {

    

    function getTaxRatesDropdown()

    {   

        return Tax_rates::where('company_id',Auth::id())->orderBy('id','asc')->pluck('name', 'id');

    }  

}



if (! function_exists('getShippingOptionsDropdown')) {

    

    function getShippingOptionsDropdown()

    {   

        return Shipping_option::where('company_id',Auth::id())->orderBy('id','asc')->pluck('name', 'id');

    }  

}



if (! function_exists('getRegions')) {

    

    function getRegions()

    {   

        return Regions::get();

    }  

}



if (! function_exists('getActiveLeagues')) {

    

    function getActiveLeagues($user_id)

    {   

        $category_ids = Items::select('category_id')->where(['user_id' => $user_id])->groupBy('category_id')->pluck('category_id');

        $active_leagues = Categories::whereIn('id', $category_ids)->groupBy('parent_id')->count();

        $active_leagues = str_pad(($active_leagues),7,0,STR_PAD_LEFT);

        return $active_leagues;

    }  

}



if (! function_exists('getActiveLeaguesByUserId')) {

    

    function getActiveLeaguesByUserId($user_id)

    {   

        $category_ids = Items::select('category_id')->where(['user_id' => $user_id])->groupBy('category_id')->pluck('category_id');

        $active_leagues_ids = Categories::select('parent_id')->whereIn('id', $category_ids)->groupBy('parent_id')->pluck('parent_id');

        $active_leagues = Categories::whereIn('id', $active_leagues_ids)->get();

        

        return $activ_leagues;

    }  

}



if (! function_exists('getActiveLeaguesList')) {

    

    function getActiveLeaguesList()

    {                   

        $category_ids = Items::select('category_id')->groupBy('category_id')->pluck('category_id');

        $active_leagues = Categories::with('category')->whereIn('id', $category_ids)->groupBy('parent_id')->get();

        

        return $active_leagues;

    }  

}



if (! function_exists('getPositionInLeagues')) {

    

    function getPositionInLeagues($record_id)

    {   

        $item_id = Items::find($record_id)->category_id;



        $query = "SELECT id, score,deleted_at, FIND_IN_SET( score, 

                        (SELECT GROUP_CONCAT( score ORDER BY score DESC ) FROM items )

                    ) AS position

                    FROM items

                    WHERE category_id = ".$item_id." and id = ".$record_id."  and deleted_at is null ";

        

        $position = DB::select( DB::raw($query) );

        

        if(!empty($position)){

           $position = $position[0]->position; 

        }else{

           $position = 0; 

        }

        

        return str_pad(($position),7,0,STR_PAD_LEFT);

         

    }  

}



if (! function_exists('getPositionInLeaguesByLeagueIdAndUserId')) {

    

    function getPositionInLeaguesByLeagueIdAndUserId($category_id,$user_id)

    {   

        $item_ids = Categories::select('id')->where('parent_id', $category_id)->pluck('id');                

        $item_ids = implode(',',$item_ids->toArray());

        

        $query = "SELECT id, score,user_id,deleted_at, FIND_IN_SET( score, 

                        (SELECT GROUP_CONCAT( score ORDER BY score DESC ) FROM items where user_id = ".$user_id." and deleted_at is null)

                    ) AS position

                    FROM items

                    WHERE category_id IN (".$item_ids.") and user_id = ".$user_id."  and deleted_at is null ";

        

        $position = DB::select( DB::raw($query) );

        

        if(!empty($position)){

           $position = $position[0]->position; 

        }else{

           $position = 0; 

        }

        

        

        return $position;

    }  

}



if (! function_exists('registeredUsers')) {

    

    function registeredUsers()

    {   

        $user = User::count();

        return number_format($user);

    }  

}



if (! function_exists('allRecords')) {

    

    function allRecords()

    {   

        $records = Items::count();

        return number_format($records);

    }  

}



if (! function_exists('get_ad_content')) {

    

    function getAdContent($id)

    {

        $resu = Ad::where('id', $id)->first();

        if($resu){

            

            $ad_detail = $resu->code;

            $base_url = \URL::to('/');

            $ad_content   =   str_replace('{asset}',$base_url,$ad_detail);

        }

        return $ad_content;

    }  

}

if (! function_exists('AddToLastViewed')) {

    

    function AddToLastViewed($user_id, $item_id)

    {   

        $input['user_id'] =  $user_id;

        $input['item_id'] =  $item_id;   

            

        $last_viewed = LastViewed::firstOrNew($input);

        $last_viewed->updated_at = date('Y-m-d G:i:s');

        $last_viewed->save();         

    }  

}



if (! function_exists('GetLastViewed')) {

    

    function GetLastViewed()

    {   

        if(Auth::id()){

          $user_id =  Auth::id();

        $GetLastViewed = LastViewed::with(['item.category.region','item.record_images'])->where(['user_id' => $user_id])->orderBy('updated_at','desc')->take(5)->get();

        $GetLastViewed->map(function ($item) {

     

            $item->item->record_images->map(function ($image) {

                $image['record_thumbnail'] = checkImage('items/thumbs/'. $image->name);

                $image['record_image'] = checkImage('items/'. $image->name);

            });

            

            return $item;

        });

        }else{

            $GetLastViewed = [];

        }

        return $GetLastViewed;

    }  

}



if (! function_exists('updateUserScore')) {

    

    function updateUserScore($user_id)

    {   

        $score = Items::select('score')->where('user_id' , $user_id)->pluck('score');

        $user_score = str_pad($score->sum(),7,0,STR_PAD_LEFT);

        $update_score['user_score'] = $user_score;

        $user = User::findOrFail($user_id);

        $user->update($update_score);

    }  

}



if (! function_exists('getProductDefaultImage')) {

    

    function getProductDefaultImage($product_id, $size=false)

    {   

        

        $product_images = Product_images::where('product_id',$product_id);

        

        if($product_images->count()>0){

            $product_image = $product_images->where('default',1)->first();

            

            if(!$product_image)              

               $product_image = Product_images::where('product_id',$product_id)->first(); 

            

                if($size)

                    return checkImage('products/'.$product_image->name); 

                else

                   return checkImage('products/thumbs/'.$product_image->name);

        }else{

            checkImage('products/no-image.jpg');

        }        

                

    } 



}



if (! function_exists('totalSales')) {

    

    function totalSales()

    {   

        $store_ids = Store::where('company_id',Auth::id())->pluck('id');

        

        $orders = Order::whereIn('store_id',$store_ids)->count();  

        return number_format($orders);

                

    } 



}

if (! function_exists('totalUsers')) {


    function totalUsers($type)
    {   
        $users = User::where('user_type',$type)->count();  
        return number_format($users);
    } 
}

if (! function_exists('totalScheduleRides')) {


    function totalScheduleRides()
    {   
        $rides = ScheduleRide::count();  
        return number_format($rides);
    } 
}

if (! function_exists('totalRideRequests')) {


    function totalRideRequests()
    {   
        $rides = RideRequest::count();  
        return number_format($rides);
    } 
}

if (! function_exists('totalStores')) {

    

    function totalStores()

    {   

        

        $stores = Store::where('company_id',Auth::id())->count();

        return number_format($stores);

                

    } 



}



if (! function_exists('totalSuppliers')) {

    

    function totalSuppliers()

    {   

        

        $supplier = Supplier::count();

        return number_format($supplier);

                

    } 



}



if (! function_exists('totalJobs')) {    

    function totalJobs()

    {                       

        $jobs = Job::count();      

        return number_format($jobs);                

    } 

}



if (! function_exists('totalAssets')) {    

    function totalAssets()

    {                       

        $assets = Asset::count();      

        return number_format($assets);                

    } 

}



if (! function_exists('totalStocks')) {    

    function totalStocks()

    {                       

        $assets = Stock::count();      

        return number_format($assets);                

    } 

}



if (! function_exists('totalActiveStudents')) {

    

    function totalActiveStudents()

    {   

            

        

        $students = Student::where('status',1)->count();

      

        return number_format($students);

                

    } 



}



if (! function_exists('totalFees')) {

    

    function totalFees()

    {   

        $student_fees = Student::where('status',1)->sum('pay_fees');

        

        return number_format($student_fees);

                

    } 



}



if (! function_exists('totalFeeReceived')) {

    

    function totalFeeReceived()

    {   

        $student_fees = Student_fee::whereMonth('month', '=', date('m'))->where('status',1)->sum('pay_fees');

        

        return number_format($student_fees);

                

    } 



}



if (! function_exists('totalFeePending')) {

    

    function totalFeePending()

    {   

        $student_ids = Student_fee::whereMonth('month', '=', date('m'))->where('status',1)->pluck('student_id');

        

        $student_fees = Student::whereNotIn('id',$student_ids)->where('status',1)->sum('pay_fees');

        

        return number_format($student_fees);

                

    } 



}



if (! function_exists('totalDiscount')) {

    

    function totalDiscount()

    {   

        $student_fees = Student_fee::whereMonth('month', '=', date('m'))->where('status',1)->sum('discount');

        

        return number_format($student_fees);

                

    } 



}



if (! function_exists('totalArrears')) {

    

    function totalArrears()

    {   

        $student_fees = Student_fee::whereMonth('month', '=', date('m'))->where('status',1)->sum('arrears');

        

        return number_format($student_fees);

                

    } 



}



if (! function_exists('totalPrintings')) {

    

    function totalPrintings()

    {   

        $student_fees = Student_fee::whereMonth('month', '=', date('m'))->where('status',1)->sum('printing');

        

        return number_format($student_fees);

                

    } 



}



if (! function_exists('totalCustomers')) {

    

    function totalCustomers()

    {   

        

        $customers = Customer::where('company_id',Auth::id())->count();

      

        return number_format($customers);

                

    } 



}



if (! function_exists('getComapnyIdByUser')) {

    

    function getComapnyIdByUser()

    {   

        

        $user = User::with(['store.company'])->find(Auth::id());

            

        return $user->store->company->id;

      

    } 



}



if (! function_exists('getVariantData')) {

    

    function getVariantData($product_id, $attribute_id, $return = 'id')

    {   

        

        $product_variant = Product_variant::where('variant_product_id',$product_id)->where('product_attribute_id',$attribute_id)->first();

       

        if($product_variant){

            if($return == 'id')

                return $product_variant->id;

            else

                return $product_variant->name;

        }

            

        return '';

      

    } 



}



if (! function_exists('getStoreProductsData')) {

    

    function getStoreProductsData($product_id, $store_id, $return = 'id')

    {   

        

        $store_product = Store_products::where('product_id',$product_id)->where('store_id',$store_id)->first();

       

        if($store_product){

            if($return == 'id')

                return $store_product->id;

            else

                return $store_product->quantity;

        }

            

        return '';

      

    } 



}



if (! function_exists('updateProductStock')) {

    

    function updateProductStock($product_id, $store_id)

    {   

        

        $stocks = Stock::where('product_id',$product_id)->where('store_id',$store_id)->get();

        

        if($stocks){

            $quantity = 0;

            

            foreach($stocks as $stock){

             

                if($stock->stock_type == 1)

                    $quantity = $quantity + $stock->quantity;

                elseif($stock->stock_type == 2)  

                    $quantity = $quantity - $stock->quantity;

            }

            

            $stock_product = Store_products::where('product_id',$product_id)->where('store_id',$store_id);

            

            $stock_data = $stock_product->update(['quantity'=>$quantity]);

            if($stock_data){

                $stock_product_data = $stock_product->first();

                if($stock_product_data->quantity<1){

                   $stock_product->delete(); 

                }

            }

        }

      

    } 



}



if (! function_exists('updateOrderProductsStock')) {

    

    function updateOrderProductsStock($order_id)

    {   

        

        $order = Order::find($order_id);

        

        if($order){

            $products = json_decode($order->order_items);

            

            if(count($products)>0){

                foreach($products as $product){                    

                    

                    $store_product = Store_products::where('product_id',$product->item_id)->where('store_id',$order->store_id)->first();

                    if($store_product){                      

                        updateProductStockByData($store_product->product_id, $store_product->store_id, $product->quantity, 2, 3, $order->id, Auth::id(), $order->order_note);                                

                        

                        // item combos

                        if(!empty($product->item_combos)){

                            $item_combos = json_decode($product->item_combos);

                            if(count($item_combos)>0){

                                foreach($item_combos as $item_combo){

                                    $store_product = Store_products::where('product_id',$item_combo->id)->where('store_id',$order->store_id)->first();

                                    if($store_product){                      

                                        updateProductStockByData($store_product->product_id, $store_product->store_id, 1, 2, 3, $order->id, Auth::id(), $order->order_note);                                

                                    }

                                }                                                        

                            }                        

                        }

                        

                        // item modifiers

                        if(!empty($product->item_modifiers)){

                            $item_modifiers = json_decode($product->item_modifiers);

                            if(count($item_modifiers)>0){

                                foreach($item_modifiers as $item_modifier){

                                    $store_product = Store_products::where('product_id',$item_modifier->id)->where('store_id',$order->store_id)->first();

                                    if($store_product){                      

                                        updateProductStockByData($store_product->product_id, $store_product->store_id, 1, 2, 3, $order->id, Auth::id(), $order->order_note);                                

                                    }

                                }                                                        

                            }                        

                        }

                    

                }

                }

            }

      

        }

    }



}



if (! function_exists('updateProductStockByData')) {

    

    function updateProductStockByData($product_id, $store_id, $quantity, $stock_type, $origin, $order_id = 0, $user_id = 0, $note = NULL)

    {                                  

        $store_data['order_id'] = $order_id;              

        $store_data['product_id'] = $product_id;              

        $store_data['store_id'] = $store_id;                 

        $store_data['user_id'] = $user_id;              

        $store_data['quantity'] = $quantity;              

        $store_data['stock_type'] = $stock_type;              

        $store_data['origin'] = $origin;              

        $store_data['note'] = $note;              



        $stock = Stock::create($store_data);

        if($stock)

            updateProductStock($product_id, $store_id);

      

    } 



}



if (! function_exists('find_key_value')) {

    

    function find_key_value($array, $key, $val)

    {

        foreach ($array as $item)

        {

            if (is_array($item) && find_key_value($item, $key, $val)) return true;



            if (isset($item[$key]) && $item[$key] == $val) return true;

        }



        return false;

    }



}



if (! function_exists('getProductTagline')) {

    

    function getProductTagline($product_id, $modifiers="", $combos="")

    {    

        $tagline = '';

        $product = Product::with(['product_variants.product_attribute.variant'])->find($product_id);

       

        if($product->product_id>0){

            foreach($product->product_variants as $key => $product_variant){

                if($key==0)

                    $tagline .= $product_variant->name .' '.$product_variant->product_attribute->variant->name;

                else

                    $tagline .= ', '.$product_variant->name .' '.$product_variant->product_attribute->variant->name;

                

            }

        }

        

        if(!empty($modifiers)){

            $modifiers = json_decode($modifiers);

            foreach($modifiers as $key => $modifier){

                if($key==0)

                    $tagline .= ' with '.$modifier->name;

                else

                    $tagline .= ', '.$modifier->name;

            }            

        }

        

        if(!empty($tagline))

            $tagline = '<p>'.$tagline.'</p>';

        

        if(!empty($combos)){

            $tagline .= '<ul>';

            $combos = json_decode($combos);

            foreach($combos as $combo){

                $tagline .= '<li>'.$combo->name.'     <span><b>Code</b>: &nbsp;&nbsp;&nbsp;'. $combo->code .'&nbsp;&nbsp; <b>SKU</b>: &nbsp;&nbsp;&nbsp;'. $combo->sku .'</span></li>';

            }            

        }

        

        return $tagline;

        

        

        

    }



}



if (! function_exists('sendOrderEmail')) {

    

    function sendOrderEmail($order_id)

    {   

        

        $order = Order::find($order_id);

        

        if($order){

            

            $email_data = Email_template::where('key','sale')->first();

            

            $customer = Customer::find($order->customer);

            

            if($customer){



                $email_to = $customer->email;

                $email_body = $email_data->content;



                $email_body = str_replace('{name}',$customer->first_name.' '.$customer->last_name,$email_body);

                $email_body = str_replace('{company}',$customer->company_name,$email_body);

                $email_body = str_replace('{reference_number}',$order->reference,$email_body);           

                $email_body = str_replace('{site_name}',settingValue('site_title'),$email_body);

                $body = $email_body;

                Email_template::sendEmail($email_to,$email_data,$body);

            }

            

            if(companySettingValue('sales_notifications')==1){

                

                $email_to = companySettingValue('email');

                $email_body = $email_data->content;



                $email_body = str_replace('{name}',$customer->first_name.' '.$customer->last_name,$email_body);

                $email_body = str_replace('{company}',$customer->company_name,$email_body);

                $email_body = str_replace('{reference_number}',$order->reference,$email_body);           

                $email_body = str_replace('{site_name}',settingValue('site_title'),$email_body);

                $body = $email_body;

                Email_template::sendEmail($email_to,$email_data,$body);

            }



            

      

        }

    }



}



if (! function_exists('convertNumberToWord')) {



    function convertNumberToWord($num = false)

    {

        $num = str_replace(array(',', ' '), '' , trim($num));

        if(! $num) {

            return false;

        }

        $num = (int) $num;

        $words = array();

        $list1 = array('', 'one', 'two', 'three', 'four', 'five', 'six', 'seven', 'eight', 'nine', 'ten', 'eleven',

            'twelve', 'thirteen', 'fourteen', 'fifteen', 'sixteen', 'seventeen', 'eighteen', 'nineteen'

        );

        $list2 = array('', 'ten', 'twenty', 'thirty', 'forty', 'fifty', 'sixty', 'seventy', 'eighty', 'ninety', 'hundred');

        $list3 = array('', 'thousand', 'million', 'billion', 'trillion', 'quadrillion', 'quintillion', 'sextillion', 'septillion',

            'octillion', 'nonillion', 'decillion', 'undecillion', 'duodecillion', 'tredecillion', 'quattuordecillion',

            'quindecillion', 'sexdecillion', 'septendecillion', 'octodecillion', 'novemdecillion', 'vigintillion'

        );

        $num_length = strlen($num);

        $levels = (int) (($num_length + 2) / 3);

        $max_length = $levels * 3;

        $num = substr('00' . $num, -$max_length);

        $num_levels = str_split($num, 3);

        for ($i = 0; $i < count($num_levels); $i++) {

            $levels--;

            $hundreds = (int) ($num_levels[$i] / 100);

            $hundreds = ($hundreds ? ' ' . $list1[$hundreds] . ' hundred' . ' ' : '');

            $tens = (int) ($num_levels[$i] % 100);

            $singles = '';

            if ( $tens < 20 ) {

                $tens = ($tens ? ' ' . $list1[$tens] . ' ' : '' );

            } else {

                $tens = (int)($tens / 10);

                $tens = ' ' . $list2[$tens] . ' ';

                $singles = (int) ($num_levels[$i] % 10);

                $singles = ' ' . $list1[$singles] . ' ';

            }

            $words[] = $hundreds . $tens . $singles . ( ( $levels && ( int ) ( $num_levels[$i] ) ) ? ' ' . $list3[$levels] . ' ' : '' );

        } //end for loop

        $commas = count($words);

        if ($commas > 1) {

            $commas = $commas - 1;

        }



        $words = implode(' ', $words) . ' only';



        return $words;

    }

}

if (! function_exists('calculateDistance')) {
    function calculateDistance($lat1, $lon1, $lat2, $lon2)
    {
        $url = "https://maps.googleapis.com/maps/api/distancematrix/json?units=imperial&origins=".$lat1.",".$lon1."&destinations=".$lat2.",".$lon2."&departure_time=now&key=AIzaSyCw3JxzgjSushvBkUbe-aB5p4lijEkJR-4";
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_URL, $url);

        $result = curl_exec($ch);
        $address = json_decode($result);
        if(@$address->status=="OK"){
            $duration_in_traffic = 0;
            $distance = @$address->rows[0]->elements[0]->distance->text;
            if($distance!=""){
                $distance = explode(' ', $distance);
                $distance = (double) $distance[0];
                $duration_in_traffic = ceil($address->rows[0]->elements[0]->duration_in_traffic->value/60);
            }
            return ['distance' => $distance, 'duration_in_traffic' => $duration_in_traffic];
        }
    }
}