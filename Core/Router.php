<?php

class Router
{
    private static $request_param = NULL;
    public static function Load($controller="main",$action="index"){
        $controller="controller_".$controller;
        if(!file_exists(CONTROLLERS_PATH.$controller.".php")) throw new Exception("Controller not found",404);
        include CONTROLLERS_PATH.$controller.".php";
        $ctrl = new $controller();
        $action="action_".$action;
        if(!method_exists($ctrl,$action)) throw new Exception("Action not found",404);
        $ctrl -> $action();

    }

    public static function getURIParam($num){
        if(self::$request_param == NULL){
            $addr = explode("?",$_SERVER["REQUEST_URI"])[0];
            self::$request_param = explode("/",$addr);
        }
        return (!empty(self::$request_param[$num + INTO_DEGREE]))?self::$request_param[$num + INTO_DEGREE]:NULL;
    }
    public static function Run()
    {
        $controller =self::getURIParam(0);
        $action = self::getURIParam(1);
        $controller=$controller?$controller:"main";
        $action=$action?$action:"index";
        self::Load($controller,$action);
    }

    public static function redirect($url){
        header("Location:".URLROOT.$url);
    }
    public static function outRedirect($url){
        header("Location:".$url);
    }
}
