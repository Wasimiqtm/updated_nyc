<?php



namespace App\Models;



use Illuminate\Database\Eloquent\Model;



class CancelationReason extends Model

{


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['reason'];

    protected $hidden = ['created_at','updated_at'];
    
    

}

