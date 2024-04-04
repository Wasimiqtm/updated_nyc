<?php



namespace App\Models;



use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;


class RideBill extends Model

{
    protected $table = 'ride_bill';

	public function ride()
    {
        return $this->belongsTo(Ride::class,'ride_id');
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['ride_id','base_fare','cost_per_mile','cost_per_minute','meet_greet_fee','distance','black_car_finder_fee','new_york_city_fee','tip','duration','other_charges','total_charges','cancelation_charges','payment_status','payment_response'];

    protected $hidden = ['created_at','updated_at'];
    
    

}

