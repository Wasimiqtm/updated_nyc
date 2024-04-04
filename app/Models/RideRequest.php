<?php



namespace App\Models;



use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;


class RideRequest extends Model

{
	
	/**
     * belongsTo relation category
     */
    public function category()
    {
        return $this->belongsTo(Categories::class,'category_id');
    }

    protected $fillable = ['pickup_location', 'round_pickup_location', 'dropoff_location', 'round_dropoff_location', 'pickup_date', 'pickup_time', 'round_trip', 'distance', 'pickup_lat', 'pickup_lng', 'dropoff_lat', 'dropoff_lng', 'no_of_passengers', 'no_of_bags', 'pickup_inst', 'dropoff_inst', 'additional_info', 'name', 'phone_number', 'email', 'additional_info', 'category_id', 'charges', 'round_pickup_time', 'round_pickup_date', 'round_pickup_lat', 'round_pickup_lng', 'round_dropoff_lng', 'round_dropoff_lat', 'hourly', 'number_of_hours', 'unique_id','app_name', 'payment_details'];
}

