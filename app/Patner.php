<?php

namespace App;

use App\Traits\RestTrait;
use Ghanem\Rating\Traits\Ratingable;
use Illuminate\Database\Eloquent\Model;

class Patner extends Model
{
    //
    use RestTrait,Ratingable;


    protected $fillable = ['name','email','logo','phone_number','address','town_id','is_active','status'];

    protected $dates = ['created_at','updated_at'];

    public $appends=['all_status'];

    public static $Status = ['inactive', 'active', 'insolvable', 'banned'];


    public function  __construct(array $attributes = [])
    {
        $this->files = ['logo'];
        parent::__construct($attributes);
    }

    public function getLabel()
    {
        return $this->name ;
    }

    public function getLogoAttribute($val)
    {
        if($val==null){
            $val='default/img/patner_logo.jpg';
        }
        return env('APP_URL').$val;
    }

    public function getAllStatusAttribute(){
        return self::$Status;
    }

    public function clients(){
        return $this->hasMany(Client::class);
    }

    public function town(){
        return $this->belongsTo(Town::class);
    }

    public function stations(){
        return $this->hasMany(Station::class);
    }
    public function mobile_operators(){
        return $this->belongsToMany(MobileOperator::class,'stations');
    }

    public function users(){
        return $this->hasMany(User::class);
    }

    public function transactions(){
        return $this->hasManyThrough(Transaction::class,User::class);
    }
}
