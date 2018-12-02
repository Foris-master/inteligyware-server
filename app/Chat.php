<?php

namespace App;

use App\Traits\RestTrait;
use Illuminate\Database\Eloquent\Model;

class Chat extends Model
{
    //
    use RestTrait;


    protected $fillable = ['title','concern_type','concern_id'];

    protected $dates = ['created_at','updated_at'];

    public static $Corncerns = [Community::class, Offer::class,Match::class];



    public function getLabel()
    {
        return $this->title ;
    }

    public function concern()
    {
        return $this->morphTo('concern');
    }

    public function setConernTypeAttribute($val)
    {
        if ($val=='offer') {
            $this->attributes['concern_type']=Offer::class;
        }elseif($val=='community'){
            $this->attributes['concern_type']=Community::class;
        }elseif($val=='match'){
            $this->attributes['concern_type']=Match::class;
        }else{
            $this->attributes['source_type']=$val;
        }
    }

    public function chat_users(){
        return $this->hasMany(ChatUser::class);
    }
    public function messages(){
        return $this->hasManyThrough(Message::class,ChatUser::class);
    }

    public function users(){
        return $this->belongsToMany(User::class,'chat_users')->withPivot('is_admin');
    }

}
