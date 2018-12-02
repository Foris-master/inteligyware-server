<?php

namespace App\Providers;

use App\Chat;
use App\Community;
use App\CommunityUser;
use App\Match;
use App\Message;
use App\Notifications\ChatNotification;
use App\Offer;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\ServiceProvider;

class ChatServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
        Community::created(function (Community $c){
            $ch = Chat::create([
                'title'=>$c->name.' chat room',
                'concern_type'=>Community::class,
                'concern_id'=>$c->id,
            ]);
        });
        Offer::created(function (Offer $o){
            $ch = Chat::create([
                'title'=>'chat room for your offer '
                    .$o->from_currency->code
                    .' -> '
                    .$o->to_currency->code
                    ." "
                    .$o->amount
                    .$o->from_currency->symbol,
                'concern_type'=>Offer::class,
                'concern_id'=>$o->id,
            ]);
        });
        Match::created(function (Match $m){
            $ch = Chat::create([
                'title'=>'chat room for match between'
                    .$m->offer->from_currency->code
                    .' -> '
                    .$m->offer->to_currency->code
                    ." "
                    .$m->offer->amount
                    .$m->offer->from_currency->symbol,
                'concern_type'=>Match::class,
                'concern_id'=>$m->id,
            ]);
        });

        Chat::created(function(Chat $c){
            Notification::send($c->users,new ChatNotification('new_chat',["chat"=>$c]));
        });

        CommunityUser::created(function(CommunityUser $cu){
            Notification::send($cu->user,new ChatNotification('new_community_user',["community_user"=>$cu]));
        });

        Message::created(function(Message $m){
            Notification::send($m->recipients,new ChatNotification('new_message',["message"=>$m]));
        });

        Message::updated(function(Message $m){
            Notification::send($m->recipients,new ChatNotification('updated_message',["message"=>$m]));
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
