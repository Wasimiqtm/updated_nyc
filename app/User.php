<?php



namespace App;



use Laravel\Passport\HasApiTokens;

use Illuminate\Notifications\Notifiable;

use Illuminate\Foundation\Auth\User as Authenticatable;


class User extends Authenticatable

{

    use HasApiTokens, Notifiable;




    // public function getRatingAttribute()
    // {

    //     return number_format($this->ratings->avg('rating'),1)?:0;

    // }

    /**

     * has Many relation OauthAccessToken

    */

    

    public function AauthAcessToken(){ 

        return $this->hasMany('\App\OauthAccessToken');         

    }

    

    public function scopeDriver($query)
    {
        $query->where('user_type', 'driver');
    }

    public function scopeRider($query)
    {
        $query->where('user_type', 'rider');
    }

    /**

     * belong to relation Items

     */

    public function driver_car()

    {

        return $this->hasOne(Models\DriverCar::class,'user_id');

    }

    public function driver_location()

    {

        return $this->hasOne(Models\DriverLocations::class,'user_id');

    }

     public function device()

    {

        return $this->hasOne(Models\UserDevice::class,'user_id');

    }

    public function user_card()

    {

        return $this->hasOne(Models\UserCardInfo::class,'user_id');

    }

    public function ratings()
    {
        return $this->hasMany(Models\Rating::class,'user_id');
    }

    /**

     * belong to relation Items

     */

    public function country()

    {

        return $this->belongsTo(Country::class,'user_country','code');

    }

    

    /**

     * belong to relation Items

     */

    public function store()

    {

        return $this->belongsTo(Store::class,'store_id');

    }

    public function rides()

    {

        return $this->hasMany(Models\Ride::class,'driver_id');

    }

    public function rider_rides()

    {

        return $this->hasMany(Models\Ride::class,'rider_id');

    }

    /**

     * hasMany relation Order

     */

    public function orders()

    {

        return $this->hasMany(Order::class,'biller_id');

    }

    

    /**

     * The attributes that are mass assignable.

     *

     * @var array

     */

    protected $fillable = [

        'name', 'email', 'gender', 'phone_number', 'user_type', 'status', 'profile_image', 'password','is_verified','fb_id','social_type','online_status','nys_driver_license','tlc_license','car_registration','insurance_certificate_of_liability','insurance_declaration_page'

    ];

    

    /**

     * The attributes that should be hidden for arrays.

     *

     * @var array

     */

   protected $hidden = ['status','password','remember_token','created_at','updated_at'];

}

