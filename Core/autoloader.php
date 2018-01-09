<?php
class Autoloader{

    private static $path =[
        "module"    => MODULES_PATH,
        "model"     => MODELS_PATH,
        "helper"    => HELPERS_PATH
    ];

    private static function getClassType($name,&$type){
        $name = strtolower($name);//Module_Database -> module_database
        $rexp = "/(\w+)\_(\w+)/i";//......_.......
        if(!preg_match($rexp,$name,$res)) return false;
        //res = ["module_database","module","database"]
        $type = $res[1];
        return true;
    }

    public static function classLoad($name)
    {
        if(!self::getClassType($name,$type)) return;
        if(empty(self::$path[$type])) return;
        include self::$path[$type].strtolower($name.".php");
    }
}