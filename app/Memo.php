<?php

namespace App;

use App\Traits\RestTrait;
use Illuminate\Database\Eloquent\Model;

class Memo extends Model
{
    //
    use RestTrait;


    protected $fillable = ['content','user_id'];

    protected $dates = ['created_at','updated_at'];



    public function getLabel()
    {
        return explode(" ",$this->content) ;
    }

    public function user(){
        return $this->belongsTo(User::class);
    }
}
