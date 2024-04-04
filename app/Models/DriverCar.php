<?php



namespace App\Models;



use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;


class DriverCar extends Model

{

	protected $table = 'driver_car';

	
    public function category_model()
    {
        return $this->belongsTo(CategoryModels::class,'category_model_id');
    }

    public function driver()
    {
        return $this->belongsTo(\App\User::class,'user_id');
    }

    /**
     * Scope a query to only include popular users.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query and $company_id
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeOnline (Builder $query) {
        
        return $query->whereHas('driver', function ($q) {
                $q->where('online_status', 1);
        });
        
    }


    public function driver_rides()
    {
        return $this->hasMany(Ride::class,'driver_id','user_id');
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['user_id','category_model_id','registration_number','year','driver_license','tlc_license','car_registration','tlc_insurance'];

    protected $hidden = ['created_at','updated_at'];
    
    

}

