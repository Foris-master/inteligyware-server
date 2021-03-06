<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class PatnersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $path =base_path("database/seeds/json/patners.json");
        $items = json_decode(file_get_contents($path),true);
        foreach ($items as $item){

            $address =isset($item["address"])?$item["address"]:null;
            unset($item["address"]);

            if(isset($item['logo'])){
                $fop =base_path("database/seeds/json/images/patners/logo/".$item['logo']);
                if (Storage::has($fop))
                    Storage::delete($fop);
                $fpath = "img/patner/logo/" . uniqid() . '.png' ;
                $item['logo'] = $fpath;
                Storage::put($fpath,  File::get($fop));
            }

            if($address){
                $t = \App\Address::where('name','like',$address)->first();
                if($t)
                    $item['address_id']=$t->id;
            }
            \App\Patner::create($item);


        }
    }
}
