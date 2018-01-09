<?php
class Module_Config{
    public static function load($cfg_name)
    {
        return include CONFIG_PATH.$cfg_name.".php";
    }
}