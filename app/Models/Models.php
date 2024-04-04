<?php



namespace App\Models;



use Illuminate\Database\Eloquent\Model;



class Models extends Model

{


	/**
     * belongsTo relation Stock
     */
    public function make()
    {
        return $this->belongsTo(Make::class,'make_id');
    }

    public function category()
    {
        return $this->hasOne(Categories::class,'model_id');
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['make_id','name'];

    protected $hidden = ['created_at','updated_at'];

}

