<?php



namespace App\Models;



use Illuminate\Database\Eloquent\Model;



class Slider extends Model

{

	public function getImageUrlAttribute()
    {
        return checkImage('sliders/'.$this->image);
    }

    public function getImageThumbAttribute()
    {
        return checkImage('sliders/thumbs/'.$this->image);
    }

    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name','image','ordering'];

    protected $hidden = ['created_at','updated_at'];

}

