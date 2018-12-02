<?php

namespace App;

use App\Traits\RestTrait;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    //
    use RestTrait;


    protected $fillable = ['body','chat_id','chat_user_id','status','type'];

    protected $dates = ['created_at','updated_at'];

    public static $Status = ['new', 'sended', 'readed'];

    public static $Types = ['original', 'updated'];


    public $appends=['all_status','all_types'];


    public function getLabel()
    {
        return $this->chat->title ;
    }

    public function getAllStatusAttribute(){
        return self::$Status;
    }

    public function getAllTypesAttribute(){
        return self::$Types;
    }

    public function chat(){
        return $this->chat_user->chat();
    }

    public function sender(){
        return $this->chat_user->user();
    }

    public function recipients(){
        return $this->chat->users()->where("user_id","!=",$this->user->id);
    }
    public function chat_user(){
        return $this->belongsTo(ChatUser::class);
    }

    public function files(){
        return $this->hasMany(MessageFile::class);
    }

    public function asset()
    {
        return $this->morphOne(MessageAsset::class, 'concern');
    }
}
