<?php

abstract class Controller{
    abstract public function action_index();
    public function get($param){
        return @$_GET[$param];
    }
    public function post($param){
        return @$_POST[$param];
    }
}