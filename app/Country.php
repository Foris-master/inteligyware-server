<?php

namespace App;

use App\Traits\RestTrait;
use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    //
    use RestTrait;

    public $timestamps = false;
    protected $fillable =['id','capital','citizenship','country_code','currency','currency_code','currency_sub_unit',
        'currency_symbol','full_name','iso_3166_2','iso_3166_3','name','region_code','sub_region_code','eea','calling_code',
        'flag'];

    public function scopeAllowed($query){
        $allowed_countries = array("CM");
        return $query->whereIn('iso_3166_3', $allowed_countries);
    }
    public function  __construct(array $attributes = [])
    {
        $this->files = ['flag'];
        parent::__construct($attributes);
    }

    public function getFlagAttribute($val)
    {
        if($val==null){
            $val='default/country.png';
        }
        return env('APP_URL')."flags/" . $val;
    }

    public function getLabel()
    {
        return $this->name;
    }

    public function  towns(){
        return $this->hasMany(Town::class);
    }
}
