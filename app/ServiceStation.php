<?php

namespace App;

use App\Traits\RestTrait;
use Illuminate\Database\Eloquent\Model;

class ServiceStation extends Model
{
    //
    use RestTrait;


    protected $fillable = ['service_id','station_id'];

    protected $dates = ['created_at','updated_at'];



    public function getLabel()
    {
        return $this->service_id.'-'.$this->station_id ;
    }

    public function service(){
        return $this->belongsTo(Service::class);
    }
    public function station(){
        return $this->belongsTo(Station::class);
    }
}
