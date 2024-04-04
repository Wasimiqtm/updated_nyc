<?php



namespace App\Models;



use Illuminate\Database\Eloquent\Model;



class DriverLocations extends Model

{

    public function scopeIsWithinMaxDistance($query, $latitude, $longitude, $radius = 10) {

        $haversine = "(6371 * acos(cos(radians(" . $latitude . ")) 
                        * cos(radians(lat)) 
                        * cos(radians(lon) 
                        - radians(" . $longitude . ")) 
                        + sin(radians(" . $latitude . ")) 
                        * sin(radians(lat))))";

        return $query->selectRaw("{$haversine} AS distance")
                     ->whereRaw("{$haversine} < ?", [$radius]);
    }

	/**
     * belongsTo relation User
     */
    public function user()
    {
        return $this->belongsTo(\App\User::class);
    }

    /**
     * belongsTo relation User
     */
    public function driver()
    {
        return $this->belongsTo(\App\User::class,'user_id');
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['user_id','lat','lon','heading','route'];

    protected $hidden = ['created_at','updated_at'];

}

