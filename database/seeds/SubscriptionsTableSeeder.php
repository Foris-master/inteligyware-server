<?php

use Illuminate\Database\Seeder;

class SubscriptionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
//        factory(\App\Subscription::class,5)->create();
        $path =base_path("database/seeds/json/subscriptions.json");
        $items = json_decode(file_get_contents($path),true);
        foreach ($items as $item){
//            $item['password']= bcrypt($item['password']);
            $currency =isset($item["currency"])?$item["currency"]:null;
            $c = \App\Currency::whereCode($currency)->first();
            unset($item["currency"]);
            if($c)
                $item['currency_id']=$c->id;
            $u= \App\Subscription::create($item);


        }
    }
}
