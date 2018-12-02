<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //

        $path =base_path("database/seeds/json/users.json");
        $items = json_decode(file_get_contents($path),true);
        foreach ($items as $item){
//            $item['password']= bcrypt($item['password']);
            $roles =isset($item["roles"])?$item["roles"]:null;
            $patner =isset($item["patner"])?$item["patner"]:null;
            unset($item["roles"]);
            unset($item["patner"]);
            if($patner){
                $p = \App\Patner::where('name','like',$patner)->first();
                if($p)
                $item['patner_id']=$p->id;
            }
            $u= \App\User::create($item);


            if(is_array($roles)){
//                $ro = \App\Role::whereIn('name',$roles)->get();
                /*foreach ($ro as $r){
                    $u->attachRole($r);
                }*/
                $u->attachRoles($roles);
            }

        }
//        factory(\App\User::class,5)->create();
    }
}