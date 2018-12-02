<?php

namespace App;

use App\Traits\RestTrait;
use Illuminate\Database\Eloquent\Model;

class SubscriptionUser extends Model
{
    //
    use RestTrait;


    protected $fillable = ['is_valid','auto_renew','remaining_amount',
        'remaining_transaction','user_id','subscription_id'];

    protected $dates = ['created_at','updated_at','subscription_date','expiration_date'];



    public function getLabel()
    {
        return $this->remaining_amount.'-'.$this->remaining_transaction;
    }

    public function user(){
        return $this->belongsTo(User::class);
    }
    public function subscription(){
        return $this->belongsTo(Subscription::class);
    }

    public function payment_method(){
        return $this->belongsTo(PaymentMethod::class);
    }

}
