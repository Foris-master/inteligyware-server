<?php

use Illuminate\Database\Seeder;

class OffersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        //factory(\App\Offer::class,20)->create();
        $path =base_path("database/seeds/json/offers.json");
        $items = json_decode(file_get_contents($path),true);
        foreach ($items as $item){
            $service =isset($item["service"])?$item["service"]:null;
            unset($item["service"]);
            if($service){
                $t = \App\Service::where('code','=',$service)->first();
                if($t)
                    $item['service_id']=$t->id;
            }

            \App\Offer::create($item);
        }

    }
}
