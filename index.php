<?php

define("URLROOT","/video/");
define("INTO_DEGREE",count(explode('/',URLROOT))-1);
define("DOCROOT",$_SERVER["DOCUMENT_ROOT"].URLROOT);
define("APP_PATH",DOCROOT."App/");
define("CORE_PATH",DOCROOT."Core/");
define("MODULES_PATH",DOCROOT."Modules/");
define("CONFIG_PATH",DOCROOT."Config/");
define("CONTROLLERS_PATH",APP_PATH."Controllers/");
define("VIEWS_PATH",APP_PATH."Views/");
define("MODELS_PATH",APP_PATH."Models/");
define("TEMPLATES_PATH",APP_PATH."Templates/");
define("HELPERS_PATH",DOCROOT."Helpers/");

setlocale(LC_ALL,"RU_ru");
error_reporting(E_ALL);

require_once CORE_PATH."bootstrap.php";

