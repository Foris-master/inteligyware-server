<?php

namespace App;

use App\Traits\RestTrait;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    //
    use RestTrait;


    protected $fillable = ['amount','target_id','target_type','offer_id','point_of_sale_service_id','status','user_id'];

    protected $dates = ['created_at','updated_at'];

    public static $Status = ['new', 'pending', 'paid', 'cancel'];

    public static $Targets = [Station::class,Client::class];

    public $appends=['all_status'];



    public function getLabel()
    {
        return $this->amount ;
    }

    public function getAllStatusAttribute(){
        return self::$Status;
    }

    public function offer(){
        return $this->belongsTo(Offer::class);
    }
    public function target(){
        return $this->morphTo();
    }
    public function point_of_sale_service(){
        return $this->belongsTo(PointOfSaleService::class);
    }
    public function user(){
        return $this->belongsTo(User::class);
    }
}
