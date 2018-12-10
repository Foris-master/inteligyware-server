<?php

namespace App;

use App\Traits\RestTrait;
use Illuminate\Database\Eloquent\Model;

class PointOfSaleService extends Model
{
    //
    use RestTrait;


    protected $fillable = ['service_id','point_of_sale_id'];

    protected $dates = ['created_at','updated_at'];



    public function getLabel()
    {
        return $this->service_id.'-'.$this->point_of_sale_id ;
    }

    public function service(){
        return $this->belongsTo(Service::class);
    }
    public function point_of_sale(){
        return $this->belongsTo(PointOfSale::class);
    }
}
