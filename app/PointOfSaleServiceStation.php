<?php

namespace App;

use App\Traits\RestTrait;
use Illuminate\Database\Eloquent\Model;

class PointOfSaleServiceStation extends Model
{
    //
    use RestTrait;


    protected $fillable = ['point_of_sale_service_id','station_id'];

    protected $dates = ['created_at','updated_at'];



    public function getLabel()
    {
        return $this->point_of_sale_service_id.'-'.$this->station_id ;
    }

    public function point_of_sale_service(){
        return $this->belongsTo(PointOfSaleService::class);
    }
    public function station(){
        return $this->belongsTo(Station::class);
    }
}
