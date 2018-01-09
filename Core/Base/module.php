<?php

class Module
{
    public static function load($name){
        //return ("Module_".$name)::instance(); только в php 7
        return call_user_func("Module_".$name."::instance");
    }
}