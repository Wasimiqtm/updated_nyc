<?php



namespace App\Models;



use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;


class Rating extends Model

{
    protected $table = 'rating';

	public function ride()
    {
        return $this->belongsTo(Ride::class,'ride_id');
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['ride_id','user_id','rating','review'];

    protected $hidden = ['created_at','updated_at'];
    
    

}

