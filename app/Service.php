<?php

namespace App;

use App\Traits\RestTrait;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    //

    use RestTrait;


    protected $fillable = ['name','code','logo','description'];

    protected $dates = ['created_at','updated_at'];

    public function  __construct(array $attributes = [])
    {
        $this->files = ['logo'];
        parent::__construct($attributes);
    }

    public function getLogoAttribute($val)
    {
        if($val==null){
            $val='default/img/patner_logo.jpg';
        }
        return env('APP_URL').$val;
    }

    public function getLabel()
    {
        return $this->name ;
    }
    public function offers(){
        return $this->hasMany(Offer::class);
    }

    public function service_stations(){
        return $this->hasMany(ServiceStation::class);
    }

    public function stations(){
        return $this->belongsToMany(Station::class,'service_stations');
    }
}
