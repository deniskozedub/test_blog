<?php

trait Singletone
{
    private static $instance=NULL;
    public static function instance(){
        return self::$instance === NULL ? self::$instance= new self() : self::$instance;
    }
}