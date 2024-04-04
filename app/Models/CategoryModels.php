<?php



namespace App\Models;



use Illuminate\Database\Eloquent\Model;



class CategoryModels extends Model

{


    /**
     * belongsTo Models
     */
    public function category()
    {
        return $this->belongsTo(Categories::class,'category_id');
    }

	/**
     * belongsTo Models
     */
    public function model()
    {
        return $this->belongsTo(Models::class,'model_id');
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['category_id','model_id'];

    protected $hidden = ['created_at','updated_at'];

}

