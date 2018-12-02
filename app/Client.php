<?php

namespace App;

use App\Traits\RestTrait;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    //
    use RestTrait;


    protected $fillable = ['name','phone','email','patner_id','type'];

    protected $dates = ['created_at','updated_at'];



    public function getLabel()
    {
        return $this->name ;
    }

    public function offers(){
        return $this->belongsToMany(Offer::class,'client_offers');
    }

    public function patner(){
        return $this->belongsTo(Patner::class);
    }
}
