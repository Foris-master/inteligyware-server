<?php

namespace App;

use App\Traits\RestTrait;
use Illuminate\Database\Eloquent\Model;

class PointOfSale extends Model
{
    //
    use RestTrait;
    protected $fillable = ['name','picture','patner_id','address_id'];

    protected $dates = ['created_at','updated_at'];

    public function  __construct(array $attributes = [])
    {
        $this->files = ['picture'];
        parent::__construct($attributes);
    }

    public function getLabel()
    {
        return $this->name ;
    }

    public function getLogoAttribute($val)
    {
        if($val==null){
            $val='default/img/point_of_sale_picture.jpg';
        }
        return env('APP_URL').$val;
    }

    public function address(){
        return $this->belongsTo(Address::class);
    }
    public function patner(){
        return $this->belongsTo(Patner::class);
    }
    public function stations(){
        return $this->hasMany(Station::class);
    }

    public  function transactions(){
        return $this->hasManyThrough(Transaction::class,PointOfSaleService::class);
    }
}
