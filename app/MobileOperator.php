<?php

namespace App;

use App\Traits\RestTrait;
use Illuminate\Database\Eloquent\Model;

class MobileOperator extends Model
{
    //
    use RestTrait;


    protected $fillable = ['name', 'code', 'logo', 'country_id'];

    protected $dates = ['created_at','updated_at'];


    public function  __construct(array $attributes = [])
    {
        $this->files = ['logo'];
        parent::__construct($attributes);
    }

    public function getLabel()
    {
        return $this->name ;
    }

    public function getLogoAttribute($val)
    {
        if($val==null){
            $val='default/img/mobile_operator_logo.jpg';
        }
        return env('APP_URL').$val;
    }

    public function stations(){
        return $this->hasMany(Station::class);
    }
    public function patners(){
        return $this->belongsToMany(Patner::class,'stations');
    }

}
