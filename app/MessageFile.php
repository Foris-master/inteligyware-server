<?php

namespace App;

use App\Traits\RestTrait;
use Illuminate\Database\Eloquent\Model;

class MessageFile extends Model
{
    //

    use RestTrait;


    protected $fillable = ['file','mime_type','size','message_id'];

    protected $dates = ['created_at','updated_at'];


    public function  __construct(array $attributes = [])
    {
        $this->files = ['file'];
        parent::__construct($attributes);
    }

    public function getLabel()
    {
        return $this->type.'-'.$this->size ;
    }

    public function message(){
        return $this->belongsTo(Message::class);
    }
}
