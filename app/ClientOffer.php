<?php

namespace App;

use App\Traits\RestTrait;
use Illuminate\Database\Eloquent\Model;

class ClientOffer extends Model
{
    //
    use RestTrait;


    protected $fillable = ['client_id','offer_id'];

    protected $dates = ['created_at','updated_at'];



    public function getLabel()
    {
        return $this->name ;
    }

    public function client(){
        return $this->belongsTo(Client::class);
    }
    public function offer(){
        return $this->belongsTo(Offer::class);
    }
}
