<?php



namespace App\Models;



use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;


class RideStatus extends Model

{
    protected $table = 'ride_status';

	public function ride()
    {
        return $this->belongsTo(Ride::class,'ride_id');
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['ride_id','status'];

    //protected $hidden = ['created_at','updated_at'];
    
    

}

