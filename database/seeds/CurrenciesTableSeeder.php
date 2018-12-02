<?php

use Illuminate\Database\Seeder;

class CurrenciesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
//        factory(\App\Currency::class,10)->create();
//        \App\Helpers\FactoryHelper::force_seed(\App\Currency::class,10);
        $path =base_path("database/seeds/json/currencies.json");
        $items = json_decode(file_get_contents($path),true);
        \App\Country::whereIn('currency_code',$items)->update(["is_covered"=>true]);


    }
}
