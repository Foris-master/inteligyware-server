<?php

namespace App;

use App\Traits\RestTrait;
use Illuminate\Database\Eloquent\Model;

class Station extends Model
{
    //
    use RestTrait;


    protected $fillable = ['point_of_sale_id','mobile_operator_id','identifier','name','bail'];

    protected $dates = ['created_at','updated_at'];



    public function getLabel()
    {
        return $this->name ;
    }

    public function point_of_sale(){
        return $this->belongsTo(PointOfSale::class);
    }

    public function mobile_operator(){
        return $this->belongsTo(MobileOperator::class);
    }

    public function point_of_sale_service_stations(){
        return $this->hasMany(PointOfSaleServiceStation::class);
    }

    public function point_of_sale_services(){
        return $this->belongsToMany(Service::class,'point_of_sale_service_stations');
    }

    public  function transactions(){
        return $this->morphMany(Transaction::class,'target');
    }
}
