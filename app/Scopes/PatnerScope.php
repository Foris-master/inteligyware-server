<?php
/**
 * Created by PhpStorm.
 * User: evari
 * Date: 12/12/2018
 * Time: 11:50 AM
 */

namespace App\Scopes;


use App\Client;
use App\Patner;
use App\PointOfSale;
use App\Station;
use App\Transaction;
use App\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;
use Illuminate\Support\Facades\Auth;

class PatnerScope implements Scope
{

    /**
     * Apply the scope to a given Eloquent query builder.
     *
     * @param  \Illuminate\Database\Eloquent\Builder $builder
     * @param  \Illuminate\Database\Eloquent\Model $model
     * @return void
     */
    public function apply(Builder $builder, Model $model)
    {
        //
        if(Auth::check()){
            $user = Auth::user();
            if(!$user->hasRole(['super.administrator','administrator'])){
                $c =get_class($model);
                if($c==Transaction::class){
                    $builder->whereHas('point_of_sale_service', function (Builder $query)use($user){
                        $query->whereHas('point_of_sale', function (Builder $query2)use($user){
                            $query2->wherePatnerId($user->patner_id);
                        });
                    });

                }elseif($c==Station::class){
                    $builder->whereHas('point_of_sale', function (Builder $query)use($user){
                        $query->wherePatnerId($user->patner_id);
                    });

                }elseif($c==PointOfSale::class){
                    $builder->wherePatnerId($user->patner_id);

                }elseif($c==Client::class){
                    $builder->wherePatnerId($user->patner_id);

                }elseif($c==Patner::class){
                    $builder->whereId($user->patner_id);
                }
            }
        }

    }
}