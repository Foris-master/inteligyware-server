<?php

namespace App;

use App\Traits\RestTrait;
use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{
    //
    use RestTrait;


    protected $fillable = ['code','name','type','price','description','max_amount','max_transaction','currency_id'];

    protected $dates = ['created_at','updated_at'];



    public function getLabel()
    {
        return $this->max_amount ;
    }

    public function currency(){
        return $this->belongsTo(Currency::class);
    }
    public function subscription_users(){
        return $this->hasMany(SubscriptionUser::class);
    }
    public function users(){
        return $this->belongsToMany(User::class);
    }


}
