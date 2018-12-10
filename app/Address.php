<?php

namespace App;

use App\Traits\RestTrait;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    //
    use RestTrait;


    protected $fillable = ['name','town_id'];

    protected $dates = ['created_at','updated_at'];



    public function getLabel()
    {
        return $this->name ;
    }

    public function user(){
        return $this->hasMany(User::class);
    }
    public function point_of_sales(){
        return $this->hasMany(PointOfSale::class);
    }

    public function town(){
        return $this->belongsTo(Town::class);
    }

}
