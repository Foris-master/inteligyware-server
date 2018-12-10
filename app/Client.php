<?php

namespace App;

use App\Traits\RestTrait;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    //
    use RestTrait;


    private static $Types=['standard','vip'];
    protected $fillable = ['name','phone_number','email','patner_id','type'];

    protected $dates = ['created_at','updated_at'];



    public function getLabel()
    {
        return $this->name ;
    }

    public  function client_offers(){
        return $this->hasMany(ClientOffer::class);
    }

    public function offers(){
        return $this->belongsToMany(Offer::class,'client_offers');
    }

    public function patner(){
        return $this->belongsTo(Patner::class);
    }

    public  function transactions(){
        return $this->morphMany(Transaction::class,'target');
    }
}
