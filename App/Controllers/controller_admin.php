<?php
class Controller_Admin extends Controller {
    public function __construct(){
        if(!Module_Auth::instance()->hasRole("admin")) throw new Exception("not found",404);
    }

    public function action_index(){
        $v = new View("admin/one");
        $v->videos = Module_Database::instance()->video->getAll();
        $v->auth = Module_Auth::instance()->isAuth();
        $v->users = Module_Database::instance()->users->getAll();
        $v->title = "Admin";
        echo $v->renderGZ();
    }



}