<?php

namespace App;

use App\Traits\RestTrait;
use Illuminate\Database\Eloquent\Model;

class Bill extends Model
{
    //
    use RestTrait;


    protected $fillable = ['amount','pdf','concern_type','concern_id'];

    protected $dates = ['created_at','updated_at'];

    private $shouldFireEvent=true;

    public static $Corncerns = [Offer::class, SubscriptionUser::class];


    public function  __construct(array $attributes = [])
    {
        $this->foreign =  ['offer'];
        $this->files =  ['pdf'];
        parent::__construct($attributes);
    }


   /* public static function boot ()
    {
        parent::boot();

        self::deleting(function (Bill $bill) {
            $bill->bill_product_saletypes()->delete();

        });
        self::restoring(function (Bill $bill) {
            $bill->bill_product_saletypes()->onlyTrashed()->restore();

        });
    }*/



    public function getLabel()
    {
        return $this->amount ;
    }

    public function setConernTypeAttribute($val)
    {
        if ($val=='offer') {
            $this->attributes['concern_type']=Offer::class;
        }elseif($val=='subscription_user'){
            $this->attributes['concern_type']=SubscriptionUser::class;
        }else{
            $this->attributes['source_type']=$val;
        }
    }


    public function concern()
    {
        return $this->morphTo('concern');
    }

    public function payments(){
        return $this->hasMany(Payment::class);
    }

    public function unique_name()
    {
        $s = strtoupper(md5(uniqid(rand(),true)));
        $guidText =
            substr($s,0,8) . '-' .
            substr($s,8,4) . '-' .
            substr($s,12,4). '-' .
            substr($s,16,4). '-' .
            substr($s,20);
        return $guidText;
    }

    /**
     * @return mixed
     */
    public function getShouldFireEvent()
    {
        return $this->shouldFireEvent;
    }

    /**
     * @param mixed $shouldFireEvent
     */
    public function setShouldFireEvent($shouldFireEvent)
    {
        $this->shouldFireEvent = $shouldFireEvent;
    }
}
