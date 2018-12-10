<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class PointOfSalesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
//        factory(\App\PointOfSale::class,10)->create();
        $path =base_path("database/seeds/json/point_of_sales.json");
        $items = json_decode(file_get_contents($path),true);
        foreach ($items as $item){

            $address =isset($item["address"])?$item["address"]:null;
            unset($item["address"]);

            $patner =isset($item["patner"])?$item["patner"]:null;
            unset($item["patner"]);

            if(isset($item['picture'])){
                $fop =base_path("database/seeds/json/images/point_of_sales/picture/".$item['picture']);
                if (Storage::has($fop))
                    Storage::delete($fop);
                $fpath = "img/point_of_sale/picture/" . uniqid() . '.png' ;
                $item['picture'] = $fpath;
                Storage::put($fpath,  File::get($fop));
            }

            if($address){
                $a = \App\Address::where('name','like',$address)->first();
                if($a)
                    $item['address_id']=$a->id;
            }
            if($patner){
                $p = \App\Patner::where('name','like',$patner)->first();
                if($p)
                    $item['patner_id']=$p->id;
            }
            \App\PointOfSale::create($item);


        }
    }
}
