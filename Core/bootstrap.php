<?php
require_once CORE_PATH."Base/singletone.php";
require_once CORE_PATH."Base/module.php";
require_once CORE_PATH."Base/controller.php";
require_once CORE_PATH."Base/model.php";
require_once CORE_PATH."Base/view.php";
require_once CORE_PATH."Router.php";
require_once CORE_PATH."autoloader.php";

//устанавливаем функцию автозагрузки классов
spl_autoload_register("Autoloader::classLoad");

try{
    Router::Run();
}catch(Exception $e){
    echo $e->getMessage();
  //  Router::Load(404);
}
