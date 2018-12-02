<?php

namespace App;

use App\Traits\RestTrait;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    //

    use RestTrait;


    protected $fillable = ['name','code','description'];

    protected $dates = ['created_at','updated_at'];



    public function getLabel()
    {
        return $this->name ;
    }
    public function offer(){
        return $this->hasMany(Offer::class);
    }

    public function service_stations(){
        return $this->hasMany(ServiceStation::class);
    }

    public function stations(){
        return $this->belongsToMany(Station::class,'service_stations');
    }
}
