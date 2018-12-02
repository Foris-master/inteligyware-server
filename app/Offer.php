<?php

namespace App;

use App\Traits\RestTrait;
use Illuminate\Database\Eloquent\Model;

class Offer extends Model
{
    //
    use RestTrait;


    protected $fillable = ['name','amount','service_id'];

    protected $dates = ['created_at','updated_at'];



    public function getLabel()
    {
        return $this->name ;
    }

    public function clients(){
        return $this->belongsToMany(Client::class,'client_offers');
    }

    public function service(){
        return $this->belongsTo(Service::class);
    }
}
