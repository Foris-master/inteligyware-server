<?php

namespace App\Providers;

use App\Bill;
use App\Jobs\GenerateBill;
use App\Match;
use App\Offer;
use App\Rating;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Auth;

class OfferServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {

        Offer::created(function(Offer $o){
            if($o->status=='new'){

            }elseif ($o->status=='cancel'){

            }
        });

        // captured changes that concern offer status
        Offer::updating(function(Offer $o){
            $old_o = Offer::find($o->id);
            if($o->status=='matched'&&$old_o!='matched'){
                // offer newly matched

            }elseif ($o->status=='cancel'&&$old_o!='cancel'){
                // apply penalties here
                $rate = new Rating;
                $rate->ratingable_type = 'App\User';
                $rate->ratingable_id = Auth::id();
                $rate->rating = 1;
                $rate->save();

                //find if offer was already matched
                $m = Match::where('offer_id', $o->id)
                    ->orWhere('matching_offer_id', $o->id)
                    ->first();
                if ($m){
                    $m->status = 'cancel';
                    $m->save();
                }
            }
        });
        Offer::updated(function(Offer $o){
            if($o->status=='new'){

            }elseif ($o->status=='cancel'){

            }elseif ($o->status=='close'){
                //create bill
            }
        });

        Bill::created(function(Bill $b){
            dispatch(new GenerateBill($b));
        });

        //set offer rate at creation
        Offer::creating(function(Offer $o){
            $o->rate_at_creation= ($o->to_currency->rate/$o->from_currency->rate);

            $o->tag = $o->create_tag();
        });

        //set offer rate at match
        Match::creating(function(Match $m){

            $m->tag = $m->create_tag();

            $o =$m->offer;
            $mo =$m->matching_offer;
            $o->rate_at_match=$o->to_currency->rate/$o->from_currency->rate;
            $mo->rate_at_match=$mo->to_currency->rate/$mo->from_currency->rate;
            $o->save();
            $mo->save();
        });

        //set offer status at match
        Match::created(function(Match $m){
            $o =$m->offer;
            $mo =$m->matching_offer;
            $o->status= 'matched';
            $mo->status= 'matched';
            $o->save();
            $mo->save();

            //let define payment sequence
            $r1 = $o->user->ratings;
            $r2 = $mo->user->ratings;
            if ($r1['avg'] > $r2['avg'])
                $m->sequence = true;
            else
                $m->sequence = false;
        });

        //set offer status when match one's get changed
        Match::updated(function(Match $m){
            if($m->status=='close'){
                $o =$m->offer;
                $mo =$m->matching_offer;
                $o->status= 'close';
                $mo->status= 'close';
                $o->save();
                $mo->save();
            }elseif ($m->status=='cancel'){
                $o =$m->offer;
                $mo =$m->matching_offer;
                $o->status= 'new';
                $mo->status= 'new';
                $o->save();
                $mo->save();
            }
        });
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }


}
