<?php

namespace App;

use App\Traits\RestTrait;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    //
    use RestTrait;


    protected $fillable = ['amount','concern_type','concern_id','status','user_id'];

    protected $dates = ['created_at','updated_at'];

    public static $Status = ['new', 'pending', 'paid', 'cancel'];

    public $appends=['all_status'];



    public function getLabel()
    {
        return $this->amount ;
    }

    public function getAllStatusAttribute(){
        return self::$Status;
    }

    public function concern()
    {
        return $this->morphTo('concern');
    }

    public function user(){
        return $this->belongsTo(User::class);
    }
}
