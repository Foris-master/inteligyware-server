<?php

use Illuminate\Database\Seeder;

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

            $town =isset($item["town"])?$item["town"]:null;
            unset($item["town"]);

            if($town){
                $t = \App\Town::where('name','like',$town)->first();
                if($t)
                    $item['town_id']=$t->id;
            }
            \App\Patner::create($item);


        }
    }
}
