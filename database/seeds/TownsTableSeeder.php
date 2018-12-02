<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Config;

class TownsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
//        factory(\App\Town::class,2)->create();
        $cities = Config::get('towns');
        if (!$cities) {
            throw new Exception("Cities config file doesn't exists or empty, did you run: php artisan vendor:publish?");
        }
        foreach ($cities as $city){
            $c = $city["country_code"]=="CMR";
            if($c){
                $c = \App\Country::where("iso_3166_3","=",$city["country_code"])->first();
                $n = strlen($city["name"]);
                $city["country_id"]=$c->id;
                $city["code"]=substr(str_slug($city["name"]),0,5);
                $city["code"]=$city["code"].$city["id"]."-".$city["country_code"];
                $city["code"]= utf8_encode(strtolower($city["code"]));
                unset($city["country_code"]);
                unset($city["population"]);
                \App\Town::create($city);
            }
        }
    }
}
