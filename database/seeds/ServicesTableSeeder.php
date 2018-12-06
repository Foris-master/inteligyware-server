<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class ServicesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
//        factory(\App\Service::class,10)->create();
//        \App\Helpers\FactoryHelper::force_seed(\App\Service::class,10);
        $path =base_path("database/seeds/json/services.json");
        $items = json_decode(file_get_contents($path),true);
        foreach ($items as $item){

            if(isset($item['logo'])){
                $fop =base_path("database/seeds/json/images/services/logo/".$item['logo']);
                if (Storage::has($fop))
                    Storage::delete($fop);
                $fpath = "img/service/logo/" . uniqid() . '.png' ;
                $item['logo'] = $fpath;
                Storage::put($fpath,  File::get($fop));
            }
            \App\Service::create($item);
        }
    }
}
