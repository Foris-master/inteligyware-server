<?php

namespace App;

use App\Traits\RestTrait;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    //
    use RestTrait;


    protected $fillable = ['name','user_id','town_id'];

    protected $dates = ['created_at','updated_at'];



    public function getLabel()
    {
        return $this->name ;
    }

    public function user(){
        return $this->belongsTo(User::class);
    }
    public function town(){
        return $this->belongsTo(Town::class);
    }

}
