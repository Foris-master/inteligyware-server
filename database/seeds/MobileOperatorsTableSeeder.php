<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class MobileOperatorsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        // factory(\App\Category::class,20)->create();
        $path =base_path("database/seeds/json/mobile_operators.json");
        $items = json_decode(file_get_contents($path),true);
        foreach ($items as $item){
            if(isset($item['logo'])){
                $fop =base_path("database/seeds/json/images/mobile_operators/logo/".$item['logo']);
                if (Storage::has($fop))
                    Storage::delete($fop);
                $fpath = "img/mobile_operators/logo/" . uniqid() . '.png' ;
                $item['logo'] = $fpath;
                Storage::put($fpath, File::get($fop));
            }
            $mo= \App\MobileOperator::create($item);

        }
    }
}
