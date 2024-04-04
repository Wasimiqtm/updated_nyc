<?php



namespace App\Models;



use Illuminate\Database\Eloquent\Model;



class Categories extends Model

{

	public function getImageUrlAttribute()
    {
        return checkImage('categories/'.$this->image);
    }

    public function getImageThumbAttribute()
    {
        return checkImage('categories/thumbs/'.$this->image);
    }

    public function getCarIconUrlAttribute()
    {
        return checkImage('categories/'.$this->car_icon);
    }

    public function getCarIconThumbAttribute()
    {
        return checkImage('categories/thumbs/'.$this->car_icon);
    }
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['no_of_bags','no_of_passengers', 'name','image','car_icon','base_fare', 'alternate_fare','cost_per_mile','cost_per_minute','advance_booking_fee','cancelation_fee','meet_greet_fee','black_car_finder_fee', 'state_wise_percentage','new_york_city_fee','sr_cancelation_fee','cancel_schedule_ride_min_period','cancel_schedule_ride_max_period','description'];

    protected $hidden = ['created_at','updated_at'];

}

