<?php

namespace App;

use App\Traits\RestTrait;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    //
    use RestTrait;


    protected $fillable = ['amount','amount_paid','reference','proof','payment_method_id','currency_id','bill_id','pdf'];

    protected $dates = ['created_at','updated_at','payment_date'];

    public $appends=['all_status'];

    public static $Status = ['new', 'pending', 'paid', 'failled'];

    public function  __construct(array $attributes = [])
    {
        $this->files = ['proof','pdf'];
        parent::__construct($attributes);
    }


    public function getLabel()
    {
        return $this->amount.'-'.$this->bill_id;
    }

    public function getAllStatusAttribute(){
        return self::$Status;
    }

    public function  bill(){
        return $this->belongsTo(Bill::class);
    }
    public function  currency(){
        return $this->belongsTo(Currency::class);
    }
    public function  payment_method(){
        return $this->belongsTo(PaymentMethod::class);
    }
}
