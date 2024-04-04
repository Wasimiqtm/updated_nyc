<?php



namespace App\Models;



use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;


class UserCardInfo extends Model

{

	protected $table = 'user_card_info';

	
    public function user()
    {
        return $this->belongsTo(\App\User::class,'user_id');
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['user_id','card_number','expiry_month','expiry_year','cv_code'];

    protected $hidden = ['created_at','updated_at'];
    
    

}

