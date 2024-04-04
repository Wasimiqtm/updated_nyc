<?php



namespace App\Models;



use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;


class ScheduleRide extends Model

{

	protected $table = 'schedule_rides';

	
    public function rider()
    {
        return $this->belongsTo(\App\User::class,'rider_id');
    }

    public function category()
    {
        return $this->belongsTo(Categories::class,'category_id');
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['rider_id','category_id','pickup_lat','pickup_lon','dropoff_lat','dropoff_lon','ride_date','advance_booking_fee','cancelation_fee','status','payment_status','payment_response'];

    //protected $hidden = ['created_at','updated_at'];
    
    

}

