<?php



namespace App\Models;



use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;


class UserDevice extends Model

{

	protected $table = 'user_devices';

	
    public function user()
    {
        return $this->belongsTo(\App\User::class,'user_id');
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['user_id','user_device','token'];

    protected $hidden = ['created_at','updated_at'];
    
    

}

