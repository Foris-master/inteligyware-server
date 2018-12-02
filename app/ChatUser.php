<?php

namespace App;

use App\Traits\RestTrait;
use Illuminate\Database\Eloquent\Model;

class ChatUser extends Model
{
    //
    use RestTrait;


    protected $fillable = ['is_admin','chat_id','user_id'];

    protected $dates = ['created_at','updated_at'];



    public function getLabel()
    {
        return $this->user->full_name.' '.$this->chat->title ;
    }

    public function chat()
    {
        return $this->belongsTo(Chat::class);
    }

    public function messages(){
        return $this->hasMany(Message::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
