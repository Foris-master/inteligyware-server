<?php

namespace App;

use App\Traits\RestTrait;
use Illuminate\Database\Eloquent\Model;

class Station extends Model
{
    //
    use RestTrait;


    protected $fillable = ['patner_id','mobile_operator_id','identifier','name','bail'];

    protected $dates = ['created_at','updated_at'];



    public function getLabel()
    {
        return $this->name ;
    }

    public function patner(){
        return $this->belongsTo(Patner::class);
    }

    public function mobile_operator(){
        return $this->belongsTo(MobileOperator::class);
    }

    public function service_stations(){
        return $this->hasMany(ServiceStation::class);
    }

    public function services(){
        return $this->belongsToMany(Service::class,'service_stations');
    }
}
