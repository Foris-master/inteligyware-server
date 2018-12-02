<?php

namespace App;

use App\Traits\RestTrait;
use Illuminate\Database\Eloquent\Model;

class PaymentMethod extends Model
{
    //
    use RestTrait;

    public static $Sourceable = [PhoneNumber::class, CreditCard::class,BankAccount::class];

    protected $fillable = ['type','patner_id','source_type','source_id'];

    protected $dates = ['created_at','updated_at'];

    protected $appends=['all_types'];

    public static $Types = ['bank', 'credit', 'phone', 'crypto_wallet','paypal'];

    public function getAllTypesAttribute(){
        return self::$Types;
    }



    public function getLabel()
    {
        return $this->type ;
    }

    public function paid_with_offers(){
        return $this->hasMany(Offer::class,'beneficiary_payment_method_id');
    }

    public function setSourceTypeAttribute($val)
    {
        if ($val=='phone_number') {
            $this->attributes['source_type']=PhoneNumber::class;
        }elseif($val=='credit_card'){
            $this->attributes['source_type']=CreditCard::class;
        }elseif($val=='bank_account'){
            $this->attributes['source_type']=BankAccount::class;
        }else{
            $this->attributes['source_type']=$val;
        }
    }

    public function patner(){
        return $this->belongsTo(Patner::class);
    }

    public function payments(){
        return $this->hasMany(Payment::class);
    }

    public function subscription(){
        return $this->hasOne(SubscriptionUser::class);
    }


}
