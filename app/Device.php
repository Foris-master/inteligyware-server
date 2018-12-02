<?php

namespace App;

use App\Traits\RestTrait;
use Illuminate\Database\Eloquent\Model;

class Device extends Model
{
    //
    use RestTrait;


    protected $fillable = ['name', 'tag', 'type', 'description', 'user_id', 'is_notifiable', 'is_confirmed', 'token'];

    protected $dates = ['created_at','updated_at'];

    public static $Types = ['mobile', 'desktop', 'tablet', 'smarthwatch', 'bot'];

    protected $appends=['all_types'];

    public function getAllTypesAttribute(){
        return self::$Types;
    }



    public function getLabel()
    {
        return $this->name;
    }

    public function user(){
        return $this->belongsTo(User::class);
    }
}
