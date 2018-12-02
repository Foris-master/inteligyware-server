<?php

namespace App;

use App\Traits\RestTrait;
use Ghanem\Rating\Models\Rating as PRating;

class Rating extends PRating
{
    //
    use RestTrait;

    protected $fillable = ['ratingable_id','ratingable_type', 'author_id', 'author_type', 'rating'];

    public static $Ratingables = [User::class, Patner::class,];

    protected $appends=['all_ratingables'];


    protected $dates = ['created_at','updated_at'];

    public function getLabel()
    {
        return $this->rating ;
    }

    public function setRatingableTypeAttribute($val)
    {
        if ($val=='user') {
            $this->attributes['ratingable_type']=User::class;
        }elseif($val=='patner'){
            $this->attributes['ratingable_type']=Patner::class;
        }else{
            $this->attributes['ratingable_type']=$val;
        }
    }
    public function setAuthorTypeAttribute($val)
    {
        if ($val=='user') {
            $this->attributes['author_type']=User::class;
        }else{
            $this->attributes['author_type']=$val;
        }
    }

    public function getAllRatingablesAttribute(){
        return self::$Ratingables;
    }
}
