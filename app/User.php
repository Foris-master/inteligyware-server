<?php

namespace App;

use App\Traits\RestTrait;
use Ghanem\Rating\Traits\Ratingable;
use Hash;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laratrust\Traits\LaratrustUserTrait;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements JWTSubject
{
    use RestTrait;
    use LaratrustUserTrait;
    use Notifiable;
    use Ratingable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'email', 'phone_number','failed_password_attemps','is_active','status',
        'password','patner_id','last_device_id','last_login','remember_token'
    ];

    public $appends=['ratings','full_name','all_status'];
//    public $appends=['ratingPercent'];

    protected $dates = ['created_at','updated_at'];


    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public static $Status = ['inactive', 'active', 'insolvable', 'banned'];



    public function getLabel()
    {
        return $this->email ;
    }

    public function getAllStatusAttribute(){
        return self::$Status;
    }

    /**
     * Automatically creates hash for the user password.
     *
     * @param  string  $value
     * @return void
     */
    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = Hash::make($value);
    }



    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }

    public function chats(){
        return $this->belongsToMany(Chat::class,'chat_users')->withPivot('is_admin');
    }
    public function chat_users(){
        return $this->hasMany(ChatUser::class);
    }


    public  function devices(){
        return $this->hasMany(Device::class);
    }

    public function messages(){
        return $this->hasManyThrough(Message::class,ChatUser::class);
    }

    public  function memos(){
        return $this->hasMany(Memo::class);
    }

    public  function offers(){
        return $this->hasMany(Offer::class);
    }

    public function partner(){
        return $this->belongsTo(Patner::class);
    }


    public function subscription_users(){
        return $this->hasOne(SubscriptionUser::class);
    }
    public function subscriptions(){
        return $this->belongsToMany(Subscription::class);
    }


    public function transactions(){
        return $this->hasMany(Transaction::class);
    }

    /*public function getSettingsAttribute(){
        return Setting::all($this->id);
    }*/

    public function getRatingsAttribute($val)
    {
        $n1=$this->ratings()->where('rating','<=',1)->count();
        $n2=$this->ratings()->where('rating','>',1)
            ->where('rating','<=',2)->count();
        $n3=$this->ratings()->where('rating','>',2)
            ->where('rating','<=',3)->count();
        $n4=$this->ratings()->where('rating','>',3)
            ->where('rating','<=',4)->count();
        $n5=$this->ratings()->where('rating','>',4)->count();
        $r = [
            1 =>  $n1,
            2 =>  $n2,
            3 =>  $n3,
            4 =>  $n4,
            5 =>  $n5
        ];
        $res= [
            'total'=>($n1+$n2+$n3+$n4+$n5),
            'avg'=>$this->avgRating,
            'stats'=>$r
        ];
        return $res;
    }

    public function getFullNameAttribute(){

            return $this->first_name.' '.$this->last_name;
    }

    public function routeNotificationForTwilio()
    {
        return $this->phone_number;
    }

    public function routeNotificationForOneSignal()
    {
        return $this->devices()
            ->where(["is_notifiable" => true, "is_confirmed" => true])
            ->pluck("token");

    }
}
