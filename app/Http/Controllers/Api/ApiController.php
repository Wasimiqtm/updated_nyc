<?php



namespace App\Http\Controllers\api;



use App\Models\RideRequest;
use Faker\Provider\Uuid;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Helpers\LogActivity;
use App\User;
use App\Country;
use Response;
use Carbon\Carbon;
use DB, Image, File, Log;
use App\Models\UserDevice;
use App\Models\UserCardInfo;
use App\OauthAccessToken;
use Square\Environment;
use Square\SquareClient;
class ApiController extends Controller
{

    public $successStatus = 200;
    public $badRequestStatus = 400;
    public $errorStatus = 401;
    public $notFoundStatus = 404;
    

    public function __construct()
    {
        //Log::useFiles(public_path().'/logs/'.date('d-m-Y').'/info.log', 'info');
        //Log::useFiles(storage_path('logs/laravel-'.date('d-m-Y').'.log'), 'info');
    }

    /**
     * Register api
     *
     * @return \Illuminate\Http\Response
     */

    public function register(Request $request)
    {
        $response['status'] = false;

        $validator = Validator::make($request->all(), [  
            'name' => 'required|string',          
            'email' => 'required|string|email|max:255|unique:users',
            'phone_number' => 'required|max:100|unique:users',
            'password' => 'required|string|min:6',
            'user_type' => 'required|string|in:driver,rider',
        ]);

        $input = $request->all();        

        if ($validator->fails()) {            
            $response['error'] = $validator->errors()->first();
            return response()->json($response, 200);                 
        }
        

        $input['status'] = 1;
        $input['is_verified'] = 1; //verified on for current time 
        
        if($request->user_type=="driver")
            $input['status'] = 0;
        
        $input['password'] = bcrypt($input['password']);
        $user = User::create($input);        

        if($request->user_type=="rider"){
            $user->online_status = '1';
            $user->save();     
        }   

        if($request->filled('device_token')){
            $device_token['user_id'] = $user->id;                            
            $user_device = UserDevice::firstOrNew($device_token);
            $user_device->user_device = @$request->user_device;
            $user_device->token = $request->device_token;
            $user_device->save();
        }

        $response['status'] =  true;
        $response['message'] =  'You have successfully register.';

        OauthAccessToken::where('user_id',$user->id)->delete();

        $response['user'] =  $this->getUserMap($user);
        $response['user']['access_token'] =  $user->createToken($user->name)->accessToken;
        
        Log::info('Register Request: ',$input);        
        Log::info('Register Response: ', $response); 

        return response()->json($response, $this->successStatus);

    }

    

    /**

     * login api

     *

     * @return \Illuminate\Http\Response

     */

    public function login(Request $request)

    {  
        $response['status'] = false;


        $validator = Validator::make($request->all(), [            
            'phone_number' => 'required|max:100',
            'password' => 'required',
        ]);

        if ($validator->fails()) {
            $response['error'] = $validator->errors()->first();
            return response()->json($response, 200);            
        }
        

        $input = $request->all();

        $user_email = User::where('phone_number',$request->phone_number)->first();
        
        if($user_email){
            $crediantals = ['email' => $user_email->email, 'password' => $input['password']];
            if(Auth::attempt($crediantals)){                   

                $user = Auth::user();            
                $user = User::with('user_card:id,user_id,card_number')->find($user->id);

                if($user->status==0){

                   $response['error'] = "You account is not active. Please activate your account.";

                   return response()->json($response, 200);     
                }

                $user_email->online_status = '1';
                $user_email->save();

                if($request->filled('device_token')){
                    $device_token['user_id'] = $user->id;                            
                    $user_device = UserDevice::firstOrNew($device_token);
                    $user_device->user_device = @$request->user_device;
                    $user_device->token = $request->device_token;
                    $user_device->save();
                }

                $response['status'] =  true;
                $response['message'] =  'You have successfully login.';
                $response['user'] =  $this->getUserMap($user);
                if($user->user_card)
                    $response['user']['user_card']['card_number'] = '************'.substr($user->user_card->card_number, -4);

                OauthAccessToken::where('user_id',$user->id)->delete();
                $response['user']['access_token'] =  $user->createToken($user->name)->accessToken;

                //Log::info('Login API:', 'You have successfully login.');                        

                $status = $this->successStatus;            
                return response()->json($response, $status);    
            }
        }
                             
            $response['message'] = "You have entered an invalid phone number or password";
            
            Log::info('Login Request: ',$input);        
            Log::info('Login Response: ', $response);             
            return response()->json($response, 200);    
        
    } 

    public function loginByEmail(Request $request)

    {  
        $response['status'] = false;

        $user_email = User::where('email',@$request->email)->first();
        
        if($user_email){
            Auth::loginUsingId($user_email->id);                 

            $user = Auth::user();            
            $user = User::with('user_card:id,user_id,card_number')->find($user->id);

            $response['status'] =  true;
            $response['message'] =  'You have successfully login.';
            $response['user'] =  $this->getUserMap($user);
            if($user->user_card)
                $response['user']['user_card']['card_number'] = '************'.substr($user->user_card->card_number, -4);

            OauthAccessToken::where('user_id',$user->id)->delete();
            $response['user']['access_token'] =  $user->createToken($user->name)->accessToken;

            $status = $this->successStatus;            
            return response()->json($response, $status);    
            
        }
                             
            $response['message'] = "You have entered an invalid email";         
            return response()->json($response, 200);    
        
    } 

    /**

     * socialLogin api

     *

     * @return \Illuminate\Http\Response

     */

    public function socialLogin(Request $request)

    {  
        $response['status'] = false;


        $rules = [            
            'name' => 'required|string',          
            'email' => 'required|string|email|max:255',
            'user_type' => 'required|string|in:driver,rider',
            'type' => 'required|in:1,2',
        ];

        if($request->type==1){
            $rules['fb_id'] = 'required';
            
        }

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            $response['error'] = $validator->errors()->first();
            return response()->json($response, 200);            
        }
        

        $input = $request->all();

        $user_email = User::where('email',$request->email)->first();
        
        if($user_email){

            Auth::loginUsingId($user_email->id);
                   

            $user = Auth::user();            

            if($user->status==0){

               $response['error'] = "You account is temprary blocked.";

               return response()->json($response, 200);     
            }

            $response['message'] =  'You have successfully login.';   
                    
        }else{

            $input['status'] = 1;
            $input['password'] = null;
            $input['social_type'] = $input['type'];
            $user = User::create($input);        

            $response['message'] =  'You have successfully register.';
        }

        $user->online_status = '1';
        $user->save(); 
            
        if($request->filled('device_token')){
            $device_token['user_id'] = $user->id;                            
            $user_device = UserDevice::firstOrNew($device_token);
            $user_device->user_device = @$request->user_device;
            $user_device->token = $request->device_token;
            $user_device->save();
        }

        $response['status'] =  true;
        $response['user'] =  $this->getUserMap($user);
        OauthAccessToken::where('user_id',$user->id)->delete();
        $response['user']['access_token'] =  $user->createToken($user->name)->accessToken;
    
        Log::info('Social Login Request: ',$input);        
        Log::info('Social Login Response: ', $response);             
            
        return response()->json($response, $this->successStatus);
                    
    }   

    
    /**

     * verifyUser api

     *

     * @return \Illuminate\Http\Response

     */ 

   

   public function verifyUser(Request $request)

    {
        $response['status'] = false;

        $validator = Validator::make($request->all(), [
            'phone_number' => 'required'            
        ]);

        $input = $request->all();

        if ($validator->fails()){
            $response['error'] = $validator->errors()->first();
            return response()->json($response, 200); 
        }

        $user = User::where('phone_number',$request->phone_number)->first();
        if($user){

            $user->is_verified = 1;
            $user->save();

            OauthAccessToken::where('user_id',$user->id)->delete();
            $token = $user->createToken($user->name)->accessToken;
            $response['status'] = true;
            $response['message'] = 'User successfully updated.';
            $response['user'] = $this->getUserMap($user);  
            $response['user']['access_token'] = $token;             
            $response['status'] = true;

            Log::info('User Verification Request: ',$input);        
            Log::info('User Verification Response: ', $response);             
            return response()->json($response, $this->successStatus);

         

        }else{


            $response['error'] = "We can't find a user with that phone number.";

            return response()->json($response, 200); 


        }

    }

    /**

     * phoneVerificaiton api

     *

     * @return \Illuminate\Http\Response

     */ 

   

   public function phoneVerificaiton(Request $request)

    {
        $response['status'] = false;

        $user = Auth::user();
        
        if($user){

            $user->is_verified = 1;
            $user->save();

            OauthAccessToken::where('user_id',$user->id)->delete();
            $token = $user->createToken($user->name)->accessToken;
            $response['status'] = true;
            $response['message'] = 'User successfully updated.';
            $response['user'] = $this->getUserMap($user);                  
            $response['user']['access_token'] = $token;             

            $response['status'] = true;
            
            Log::info('Phone Verification Response: ', $response);             
            return response()->json($response, $this->successStatus);

         

        }else{


            $response['error'] = "User not found.";

            return response()->json($response, 200); 


        }

    }

    /**

     * getProductsMap function

     *

     * @param  int  $user

     * 

     * @return \Illuminate\Http\Response

     */    

    

    private function getUserMap($user){

        $user['profile_thumbnail'] = null;
        if($user->profile_image){
            $user['profile_thumbnail'] = checkImage('users/thumbs/'. $user->profile_image);
            $user['profile_image'] = checkImage('users/'. $user->profile_image);            
        }

        return $user;

    }

   

    /**

     * profileDetails api

     *

     * @return \Illuminate\Http\Response

     */ 

    public function profileDetails()

    { 

      $user = User::with('user_card:id,user_id,card_number')->find(Auth::id());

      if ($user) {                                            

        $response['user'] =  $this->getUserMap($user);
        if($user->user_card)
            $response['user']['user_card']['card_number'] = '************'.substr($user->user_card->card_number, -4);    
        
            
        $status = $this->successStatus;

        }else{

            $response['error'] = "Profile details not exist against this user";

            $status = 200;

        }

       

       return response()->json($response, $status);

   }

   

   /**

     * updateProfile api

     *

     * @return \Illuminate\Http\Response

     */ 

    public function updateProfile(Request $request)

    {     

        $user = Auth::user();



        $validator = Validator::make($request->all(), [
         //   'name'          => 'required',
            'email'         => "email|unique:users,email,$user->id" ,
          //  'gender'          => 'required',
        ]);

        //validate if user does not have image

        

        if ($validator->fails()) {
            $response['error'] = $validator->errors()->first();
            return response()->json($response, 200);                 
        }


        $input = $request->all();

        $user = User::findOrFail($user->id);
        $user->update($input);

        

        $response['status']    =  true;
        $response['user'] =  $this->getUserMap($user);
        $response['success']    =  'Profile updated successfully';

        return response()->json($response, $this->successStatus);

    }

    /**

     * updateProfileImage api

     *

     * @return \Illuminate\Http\Response

     */ 

    public function updateProfileImage(Request $request)

    {     

        $user = Auth::user();



        $validator = Validator::make($request->all(), [
            'profile_image' => 'image|mimes:jpeg,png,jpg,gif'
        ]);

        //validate if user does not have image

        

        if ($validator->fails()) {
            $response['error'] = $validator->errors()->first();
            return response()->json($response, 200);                 
        }


        $user = User::findOrFail($user->id);



        /*-----image manipulation-----*/

        if ($request->hasFile('profile_image'))

        {

            /*image make process*/

            $image = $request->file('profile_image');
            $image_name   = $user->id.'_'.str_random(10).'.'.$image->getClientOriginalExtension();
            $destinationPath = public_path('/uploads/users/thumbs');
            $img = Image::make($image->getRealPath());

            /*move image to thumbs folder*/
            $img->resize(100, 100, function ($constraint) {
                $constraint->aspectRatio();
            })->save($destinationPath.'/'.$image_name);

            /*move image to folder*/
            $destinationPath = public_path('/uploads/users/');
            $image->move($destinationPath, $image_name);

            /*unlink old image*/

            @unlink(public_path("/uploads/users/$user->profile_image"));
            @unlink(public_path("/uploads/users/thumbs/$user->profile_image"));

            // save image to db

            $user->profile_image = $image_name;
            $user->save(); 

        }

        

        $response['status']    =  true;
        $response['user'] =  $this->getUserMap($user);
        $response['success']    =  'Profile image successfully updated';

        return response()->json($response, $this->successStatus);

    }

    /**

     * updatePhoneNumber api

     *

     * @return \Illuminate\Http\Response

     */ 

    public function updatePhoneNumber(Request $request)

    {     

        $response['status'] = false;
        $user = Auth::user();
        
        $validator = Validator::make($request->all(), [
            'phone_number' => "required|unique:users,phone_number,$user->id" ,
        ]);


        if ($validator->fails()) {
            $response['error'] = $validator->errors()->first();
            return response()->json($response, 200);                 
        }


        $input = $request->all();


        $user = User::where('id',$user->id)->first();
        
        if($user){
            $input['is_verified'] = 0;
            $user->update($input);

            $response['status'] = true;
            $response['success']    =  'Phone number successfully update';
        }else{

            $response['success']    =  'User not found';
    
        }

        Log::info('Update Phone Number Request: ',$input);        
        Log::info('Update Phone Number Response: ', $response);             
        return response()->json($response, $this->successStatus);

        

        
    }

    

   /**

     * changePassword api

     *

     * @return \Illuminate\Http\Response

     */ 

   

   public function changePassword(Request $request)

    {
        $response['status'] = false;

        $validator = Validator::make($request->all(), [
            'password' => 'required|min:6', 
            'new_password' => 'required|min:6'            
        ]);



        if ($validator->fails()){
            $response['error'] = $validator->errors()->first();
            return response()->json($response, 200); 
        }



        $user = Auth::guard('api')->user();



         //checking the old password first

         $check  = Auth::guard('web')->attempt([
             'email' => $user->email,
             'password' => $request->password
         ]);



         if($check) {
             OauthAccessToken::where('user_id',$user->id)->delete();
             $user->password = bcrypt($request->new_password);
             $user->token()->revoke();
             $token = $user->createToken($user->name)->accessToken;

             $user->save();

             $response['status'] = true;
             $response['message'] = 'Password successfully updated';
             $response['user'] = $this->getUserMap($user);
             $response['user']['access_token'] = $token;
        }else{
            $response['error'] = 'Your current password is incorrect, please try again.';
        }

        Log::info('Update Phone Number Request: ',$request->all());        
        Log::info('Update Phone Number Response: ', $response);             
        return response()->json($response, $this->successStatus);

    }

    

    /**

     * logout api

     *

     * @return \Illuminate\Http\Response

     */ 

    public function logout()

    { 

       

      if (Auth::check()) {

            $user = User::find(Auth::id());
            $user->online_status = '0';
            $user->save();  

            UserDevice::where('user_id',Auth::id())->delete();          

            Auth::user()->AauthAcessToken()->delete();



           $response['status'] = true;
           $response['message'] = "You have successfully logout";

           $status = $this->successStatus;            

        }else{             
            $response['status'] = false;
            $response['error'] = "Oops! some error occur not successfully logout. Please try again";

        }

        Log::info('Logout Response: ', $response);                     

       return response()->json($response, 200);

   } 

   

   /**

     * Forget password

     *

     * @param Request $request

     * @return \Symfony\Component\HttpFoundation\Response

     */

    public function forgotPassword(Request $request)

    {

        $validator = Validator::make($request->all(), [
            'phone_number' => 'required|exists:users',
            'password' => 'required|min:6'
        ],[
            'phone_number.exists' => "We can't find a user with that phone number."
        ]);        

        

        if ($validator->fails()) {
            $response['status'] = false;
            $response['error'] = $validator->errors()->first();

            return response()->json($response, 200);                 

        }

        
        $user = User::where('phone_number',$request->phone_number)->first();

         if($user) {
             OauthAccessToken::where('user_id',$user->id)->delete();
             $user->password = bcrypt($request->password);             
             $token = $user->createToken($user->name)->accessToken;
             $user->save();

             $response['status'] = true;
             $response['message'] = 'Password successfully updated';
             $response['user'] = $this->getUserMap($user);
             $response['user']['access_token'] = $token;

             return response()->json($response, $this->successStatus);

        }else{


            $response['error'] = "We can't find a user with that phone number.  ";

            return response()->json($response, 200); 


        }

    }


    

    /**
     * updateOnlineStatus api
     *
     * @return \Illuminate\Http\Response
     */ 

    public function updateOnlineStatus(Request $request)

    {     

        $user = Auth::user();


        $validator = Validator::make($request->all(), [
            'online_status'          => 'required|in:0,1'
        ]);

        //validate if user does not have image

        

        if ($validator->fails()) {
            $response['error'] = $validator->errors()->first();
            return response()->json($response, 200);                 
        }


        $input = $request->all();

        $record = User::findOrFail($user->id);
        $record->update($input);

        

        $response['status']    =  true;
        $response['success']    =  'Online status updated successfully';

        return response()->json($response, $this->successStatus);

    }

    

    public function updateUserDeviceToken(Request $request)
    {
        $response['status'] = false;
        
        $validator = Validator::make($request->all(), [
            'user_device' => 'required|string|in:android,ios', 
            'device_token' => 'required'          
        ]);


        if ($validator->fails()){
            $response['error'] = $validator->errors()->first();
            return response()->json($response, 200); 
        }

        $user_id = Auth::id();

        $device_token['user_id'] = $user_id;                            
        $user_device = UserDevice::updateOrCreate($device_token);
        $user_device->user_device = $request->user_device;
        $user_device->token = $request->device_token;
        $user_device->save();

        $response['status'] =  true;
        $response['message'] =  'User device token successfully updated.';
        
        return response()->json($response, 200);    
    }
    public  function payRideChargesForAirportCarLimo(Request $request)
    {



        $response['status'] = 0;
        $validator = Validator::make($request->all(), [
            'ride_id' => 'required|numeric',

        ]);

        if ($validator->fails()){
            $response['message'] = $validator->errors()->first();
            return response()->json($response, 200);
        }

        $ride_id = $request->ride_id;
        $ride_amount = 0;

        $ride = RideRequest::find($ride_id);

        if($ride){
            if($ride->charges>0 && $ride->payment_status=="pending"){
                $ride_amount = $ride->charges;
            }else{
                $response['message'] = 'Ride is already paid or charges is zero';
                return response()->json($response, 200);
            }
        }else{
            $response['message'] = 'Ride not found';
            return response()->json($response, 200);
        }

           
        if(request()->amount >0){
            $client = new SquareClient([ 
                 'accessToken' => 'EAAAEH1uhXzNG069Kq2EciFtT4D5I1hU45l_vlgoACMvkbVtpjQc0kQKJzO9Cacy', //sandbox
                 'environment' => Environment::SANDBOX,
                //'accessToken' => 'EAAAEEhGrEwD5xHQC9nfgPXzou-ps0Gf9WriT6p7uKwfWAfDdfrw983-nPWbJbPW',
                //'environment' => Environment::PRODUCTION,
            ]);
            $finalAmount = (request()->amount);

            $amount_money = new \Square\Models\Money();
            $amount_money->setAmount($finalAmount);
            $amount_money->setCurrency('USD');
            $userID=  uniqid();
            $body = new \Square\Models\CreatePaymentRequest(
                $request->nonce,
                $userID ,
                $amount_money
            );

            $api_response = $client->getPaymentsApi()->createPayment($body);
           /* echo "<pre>";
            print_r($api_response);exit;*/

            if ($api_response->isSuccess()) {
                $response['status'] = 1;
                $result = $api_response->getResult();
                $ride->payment_status = 'done';
                $ride->payment_response = json_encode($result);
                $ride->save();
            } else {
                $ee = json_decode($api_response->getBody(),true);
                $errors = $ee['errors'][0]['detail']??"Invalid Card Error";
                $response['status'] = 2;
                 $response['message'] =$errors;
                
                return $response;
            }


        }else{
            Log::info('Transaction: Ride Request ID('.$ride->id.') Ride charges is zero');
            $response['status'] = 3;

        }

        if($response['status']!=1)
            $response['message'] = 'Ride payment not successfully paid! Please try later';

        return $response;

    }
}









