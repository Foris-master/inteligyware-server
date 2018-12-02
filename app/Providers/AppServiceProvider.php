<?php

namespace App\Providers;

use App\Country;
use App\Currency;
use App\MessageFile;
use App\PhoneNumber;
use App\Subscription;
use App\SubscriptionUser;
use App\User;
use App\Verification;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
       /* //free subscription plan for newly register user
        User::created(function(User $user){
            $s = Subscription::whereCode('fr')->first();
//            $user->subscriptions()->attach($s->id);
            SubscriptionUser::create([
                'user_id'=>$user->id,
                'subscription_id'=>$s->id,
                'remaining_transaction'=>$s->max_transaction,
                'remaining_amount'=>$s->max_amount,
                'subscription_date'=>Carbon::today(),
                'expiration_date'=>Carbon::today()->addMonth(),
                'is_valid'=>true,
                'auto_renew'=>false

            ]);
        });

        SubscriptionUser::updating(function(SubscriptionUser $su){
            $osu= SubscriptionUser::find($su->id);
            //check plan changing
            if($osu->subscription_id!=$su->subscription_id){
                $su->subscription_date=Carbon::today();
                if($su->subscription->type=='y'){
                    $su->expiration_date=$su->subscription_date->addYear();
                }elseif ($su->subscription->type=='m'){
                    if($su->expiration_date<$osu->expiration_date){
                        $su->expiration_date=$su->subscription_date->addMonth();
                    }
                }
                $su->remaining_transaction+=$su->subscription->max_transaction;
                $su->remaining_amount+=$su->subscription->max_max;
            }
        });
        PhoneNumber::created(function (PhoneNumber $p){
            $verification = new Verification();
            $verification->code = Verification::generatePIN();
            $verification->setVerifiableTypeAttribute("phone_number");
            $verification->status = 'new';
            $verification->save();
            $verification->send_code($p->value);
        });

        MessageFile::creating(function(MessageFile $mf){

                $mf->syncOriginal();
                $f = $mf->getOriginal('file');

                $mf->mime_type = Storage::mimeType($f);
                $mf->size = Storage::size($f)/1024;
        });

        Country::updated(function(Country $c){
            if($c->is_covered&&!Currency::whereCode($c->currency_code)->exists()){
                Currency::create([
                    'code' => $c->currency_code,
                    'symbol'=>$c->currency_symbol,
                ]);
            }
        });
        Country::created(function(Country $c){
            if($c->is_covered&&!Currency::whereCode($c->currency_code)->exists()){
                Currency::create([
                    'code' => $c->currency_code,
                    'symbol'=>$c->currency_symbol,
                ]);
            }
        });*/
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
