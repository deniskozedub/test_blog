<?php

abstract class Model{
    public static function load($name){
        //return ("Model_".$name)::instance();
         return call_user_func("Model_".$name."::instance");
    }
}
