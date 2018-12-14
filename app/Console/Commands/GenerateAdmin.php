<?php

namespace App\Console\Commands;

use function Functional\false;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class GenerateAdmin extends Command
{
    private $root_config;
    private $should_overide;
    private $should_verbose;
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'generate:admin 
    {--src-dir= : search for resources definition inside the given directory}
    {--src-file= : create resources definition from the given config file}
    {--overide-exist : overide existings files}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'generate angularjs admin from config file';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle()
    {
        //
        $this->root_config =json_decode(file_get_contents(base_path("ng-admin-config.json")),true);

        if($this->option('overide-exist')){
            $this->should_overide= true;
        }elseif (isset($this->root_config['overide-exist'])){
            $this->should_overide= $this->root_config['overide-exist'];
        }

        $this->should_verbose=isset($this->root_config["verbose"])?$this->root_config["verbose"]:true;

        if($this->option('src-dir')){
            $dir= base_path($this->option('src-dir'));
            $this->proceed_dir($dir);
        }elseif($this->option('src-file')){
            $conf = json_decode(file_get_contents(base_path($this->option('src-file'))),true);
            $this->proceed($conf);
        }elseif($this->root_config["src-dir"]){
            $dir= base_path($this->root_config["src-dir"]);
            $this->proceed_dir($dir);

        } else{
            $this->proceed($this->root_config["group"]);
        }
        $this->info('admin  created successfully.');
    }


    public function proceed_dir($dir){
        foreach (glob("{$dir}/*") as $file){
            if(is_file($file)&& pathinfo($file)['extension']=='json'){
                $conf = json_decode(file_get_contents($file),true);
                $this->proceed($conf);
            }
        }
    }

    private function proceed($conf)
    {
        $root_folder = base_path($this->root_config["dest-path"]).DIRECTORY_SEPARATOR.$conf["folder"];
        if(!is_dir($root_folder)){
            File::makeDirectory($root_folder, '775', true);
        }


        //trees definition
        $tree_name=isset($conf['trees_name'])?$conf['trees_name']:$conf['name'];
        $ttree =$conf["translateroot"].".".$tree_name."_tree";
        $roles= isset($conf['roles'])?"vm.hasAnyRole('".$conf['roles']."')":"true";
        $tree_id = str_slug($tree_name.'-tree');
        $icon= isset($conf['icon'])?$conf['icon']:"fa-building";
        $trees= "<li class=\"treeview\" id='$tree_id' ng-if=\"$roles\">
        <a href=\"javascript:void(0)\">
          <i class=\"fa $icon\"></i> <span translate>$ttree</span> <i class=\"fa fa-angle-left pull-right\"></i>
        </a>
        <ul class=\"treeview-menu\">\r\n\t\t";

        if($conf["resources"]){
            $tmp=$root_folder;
            $resources=$conf["resources"];
            foreach ( $resources as $k=>$item){
                $name = $item['name'];
                $trans_root=$item["translateroot"];


                //state definition
                $has_state=false;
                $state = "\r\n\t\t/*
                 =======================================================================================================================
                                    $name of resource states definition
                 =======================================================================================================================
                
                */\r\n\t\t";
                $f = isset($item["folder"])?$item["folder"]:$item["name"];
                $res_folder=$tmp.DIRECTORY_SEPARATOR.$f;
                if(!is_dir($res_folder)){
                    File::makeDirectory($res_folder, '775', true);
                }
                if(isset($item["locales"])){
                    $locales = $item["locales"];
                    $this->make_locales($locales,$res_folder,$item["translateroot"]);
                    unset($item["locales"]);
                }
                $item = $this->auto_complete_generique($item);
                if(isset($item["list"])){
                    $list_file= $res_folder.DIRECTORY_SEPARATOR.$name.".list.html";
                    $html = file_get_contents(__DIR__.'/Stubs/listing.page.stub.html');
                    $this->make_content($item["list"],$html,$list_file);

                    $tp= $this->root_config["dest-dir"]."/".$conf["folder"]."/".$name."/".$name.".list.html";
                    $sn=$name."_list";
                    $tn ="$trans_root.$name"."_tree";
                    $s = $this->make_state($sn,$tp);
                    $has_state= $has_state || $s != null;
                    $state.=$s;

                    $pem= isset($item['permissions'])?"vm.can('".$item['permissions']."')":"true";
                    $icon= isset($item['icon'])?$item['icon']:"fa-building";

                    $trees.=" <li class='' id='$sn-list' ng-show=\"$pem\">
                    <a ui-sref='app.$sn'>
                      <i class=\"fa $icon\"></i> <span translate>$tn</span>
                    </a>
                  </li>\r\n\t\t";
                }
                if(isset($item["edit"])){
                    $list_file= $res_folder.DIRECTORY_SEPARATOR.$name.".edit.html";
                    $html = file_get_contents(__DIR__.'/Stubs/edit.page.stub.html');
                    $this->make_content($item["edit"],$html,$list_file);
                    $tp= $this->root_config["dest-dir"]."/".$conf["folder"]."/".$name."/".$name.".edit.html";
                    $s = $this->make_state($name."_edit",$tp,true);
                    $has_state= $has_state || $s != null;
                    $state.=$s;
                }
                if(isset($item["detail"])){
                    $list_file= $res_folder.DIRECTORY_SEPARATOR.$name.".detail.html";
                    $html = file_get_contents(__DIR__.'/Stubs/detail.page.stub.html');
                    $this->make_content($item["detail"],$html,$list_file);

                    $tp= $this->root_config["dest-dir"]."/".$conf["folder"]."/".$name."/".$name.".detail.html";
                    $s = $this->make_state($name."_details",$tp,true);
                    $has_state= $has_state || $s != null;

                    $state.=$s;
                }
                $state .= "\r\n\t\t\t/*
                 =======================================================================================================================
                                  End  $name  resource states definition
                 =======================================================================================================================
                
          */\r\n\t\t";


                if($has_state)
                $this->save_state($state,$name);
            }
            $trees.="\r\n\t\t\t</ul>\r\n\t\t</li>\r\n\t\t";
            $this->save_trees($trees,$tree_id);

        }
    }


    public function make_content($data,$stub,$file){
        if(is_file($file)&&$this->should_overide){
            if($this->should_verbose)
            $this->warn('file exists and overide enabled! overiting '.$file.' file.'."\r\n");
            unlink($file);
        }
        if (!is_file($file)){
            $params="";
            foreach ($data as $att=>$value){
                if(is_string($value)){
                    $params.="$att=\"'$value'\"\r\n\t\t";
                }elseif(is_array($value)){
                    /*
                    array_values($value) === $value
                    $t="$att=\"[";
                    foreach ($value as $i=>$v){
                        if($i==count($value)-1){
                            $t.="'$v'";
                        }else{
                            $t.="'$v',";
                        }
                    }
                    $t.="]\"\r\n\t\t";
                    $params.=$t;*/
                    $params.="$att=\"".str_replace("\"","'",json_encode($value))."\"\r\n\t\t";

                }
            }
            $r_html= str_replace('{{params}}',$params,$stub);
            File::put($file, $r_html);
        }else{
            if($this->should_verbose)
                $this->warn('file exists and overide deseabled! skipping '.$file.' file.'."\r\n");

        }
    }

    public function make_state($name,$template,$params=false){

        $un = str_replace("_","-",$name);
        if($params)
            $un.="/{resource_id}";

        return ".state('app.$name', {
        url: '/$un',
        data: {
            auth: true
        },
        params: {
            resource_id: null
        },
        views: {
            'main@app': {
                templateUrl: './views/app/pages/$template'
            }
        }
        })\r\n\t\t";



    }

    public function save_state($new_state,$name){

        $file =base_path($this->root_config["route-config-file"]);
        $routes = file_get_contents($file);
//        $p=count(explode( ".state('app.service_list",$routes));

        if(count(explode( ".state('app.$name",$routes))==1){
            $tab =explode('$stateProvider',$routes);

            $tab[2]=rtrim($tab[2],"}\r\n");


            $tab[2].=$new_state."}";
            $routes = implode('$stateProvider',$tab);

            // $r_html= str_replace('{{params}}',$params,$stub);
            File::put($file, $routes);

        }elseif($this->should_overide){
            if($this->should_verbose)
                $this->warn("state exists and overide enabled! overiting $name state \r\n");

            /**
             * /isU  (i) so that case insentivity (s)so that . match also \r \s (U) so that ungreedy (it get the innest matcht
             *
             */
//            $routes= preg_replace("/\/\*(\s*\r*\n*)====(.*)$name(.*)End(.*)$name(.*)====(.*)*\//is",$new_state,$routes);
            $routes= preg_replace("/\R(\t){2}\/[\*(\s\R]*===(=*)[\s\R\t= ]*$name(.+)End(.+)$name(.+)====(.+)\/\R(\t){2}/isU",$new_state,$routes);

            File::put($file, $routes);


        }else{
            if($this->should_verbose)
            $this->warn("$name state exists and overide deseabled! \r\n");
        }
    }

    public function save_trees($trees,$id){


        $cn=$this->root_config["trees-component"];
        $trees_file =base_path($this->root_config["component-dir"]."/$cn/$cn.component.html");
        $trees_html = file_get_contents($trees_file);
        if(count(explode("id='$id'",$trees_html))==1){
            $tmp = explode("<li class=\"treeview\"",$trees_html);
            $tmp[0].=$trees;
            $trees_html=implode("<li class=\"treeview\"",$tmp);

//            $r= preg_replace("/<li [^>]*id='services-tree(.+?)<ul(.+?)\/ul>(.+?)<\/li>/is",$trees,$trees_html);


            File::put($trees_file, $trees_html);
        }elseif($this->should_overide){
            if($this->should_verbose)
            $this->warn("trees exists and overide enabled! overiting $id trees \r\n");

            /**
             * /is so that . match also \r \s et consol
             */
            $trees_html= preg_replace("/<li [^>]*id='$id(.+?)<ul(.+?)\/ul>(.+?)<\/li>\R(\t){2}/is",$trees,$trees_html);

            File::put($trees_file, $trees_html);


        }else{
            if($this->should_verbose)
            $this->warn("$id trees exists and overide deseabled! \r\n");
        }

    }

    private function auto_complete_generique($item)
    {
        $tmp_gen=[];
        $tmp=[];
        foreach ($item as $key=>$value){
            if(is_string($value)){
                $tmp_gen[$key]=$value;
            }
            $tmp[$key]=$value;
        }
        foreach ($item as $key=>$value){
            if(is_array($value)){
                foreach ($tmp_gen as $k=>$v){
                    $item[$key][$k]= isset($item[$key][$k])?$item[$key][$k]:$tmp_gen[$k];
                }
            }
            $tmp[$key]=$item[$key];

        }
        return $tmp;
    }

    private function make_locales($locales,$folder,$root)
    {
        $folder.=DIRECTORY_SEPARATOR."locales";
        if(!is_dir($folder)){
            File::makeDirectory($folder, '775', true);
        }
        foreach ($locales as $locale=>$trans){
            $file = $folder.DIRECTORY_SEPARATOR.$locale.".json";
            if(is_file($file)&&$this->should_overide){
                if($this->should_verbose)
                $this->warn('file exists and overide enabled! overiting '.$file.' file.'."\r\n");
                unlink($file);
            }
            if (!is_file($file)){
                $trans=json_encode([$root=>$trans]);
                File::put($file, $trans);
            }else{
                if($this->should_verbose)
                $this->warn('file exists and overide deseabled! skipping '.$file.' file.'."\r\n");

            }
        }

    }
}
