<?php



namespace App\Models;



use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;


class UserAddress extends Model

{

	protected $table = 'user_address';

	
    public function rider()
    {
        return $this->belongsTo(\App\User::class,'user_id');
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['user_id','name','type','latitude','longitude'];

    protected $hidden = ['created_at','updated_at'];
    
    

}

