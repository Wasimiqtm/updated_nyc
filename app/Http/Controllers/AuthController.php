<?php



namespace App\Http\Controllers;



use App\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Session, Auth;

class AuthController extends Controller

{

   

    /**

     * Create a new controller instance.

     *

     * @return void

     */

    public function __construct()

    {

       // $this->middleware('guest');

    }



    /**

     * Get a validator for an incoming registration request.

     *

     * @param  array  $data

     * @return \Illuminate\Contracts\Validation\Validator

     */

    public function register(Request $request)

    {

        $this->validate($request, [ 
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'phone_number' => 'required|string|max:255|unique:users',
            'country_code' => 'required',
            'password' => 'required|string|min:8|confirmed',
            'user_type' => 'required|string|in:driver,rider'        
        ]);   


        $requestData = $request->all();  
        $phone_number = '+'.$request->country_code.$request->phone_number;

        $user = User::where('phone_number',$phone_number)->first();
        if($user){
             Session::flash('error', 'The phone number has already been taken.');
            return redirect()->back()->withInput()->withErrors(['phone_number', 'The phone number has already been taken.']);
        }
        $requestData['status'] = 1;
        
        if($request->user_type=="driver")
            $requestData['status'] = 0;

        $requestData['name'] = $request->first_name .' '. $request->last_name;
        $requestData['password'] = Hash::make($request->password);
        $requestData['phone_number'] = $phone_number;
        $requestData['is_verified'] = 1; //verified on for current time 

        $user = User::create($requestData);

        if($request->user_type=="driver")
            Session::flash('success', 'Your account is successfully created! Login after activate account.');        
        else    
            Session::flash('success', 'Your account is successfully created! Please login.');        

        return redirect('/'); 

    }


    public function login(Request $request)

    {

        $this->validate($request, [ 
            'email' => 'required|max:100',
            'password' => 'required'      
        ]);   


        $input = $request->all();

        $crediantals = ['email' => $input['email'], 'password' => $input['password']];
        if(Auth::attempt($crediantals)){                   

            $user = Auth::user();            

            if($user->status==0){
                Session::flash('error', 'You account is not active. Please activate your account.');
                return redirect()->back()->withErrors(['email', 'You account is not active. Please activate your account.']);
            }

            Auth::loginUsingId($user->id, true);
            return redirect('/profile'); 
        }
         
         Session::flash('error', "You have entered an invalid email or password");                      
         return redirect()->back()->withErrors(['email', "You have entered an invalid email or password"]);

            

    }

    public function logout()
    {
        
        if (Auth::check())
            Auth::logout();
        
        Session::flash('success', 'You have successfully logout.');        

        return redirect('/');
    }
}

