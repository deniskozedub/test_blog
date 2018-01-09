<?php


class Controller_main extends Controller
{

    public function action_index(){

        $view = new View("videos/show");
        $view->setTemplate();
        $view->title = "Main";
        $view->auth = Module_Auth::instance()->isAuth();
        $view->user = Module_Auth::instance()->getUser();
        $view->videos = Model_Videos::instance()->getLast();
        $view->pag =NULL;
        $view->addStyle("default");
        echo $view->renderGZ();
    }
    public function action_register(){
        $v = new View("register");
        $v->title = "Register";
        $v->auth = Module_Auth::instance()->isAuth();
        $v->user = Module_Auth::instance()->getUser();
        $v->setTemplate();
        echo $v->renderGZ();
    }
    public function action_login(){
        $v = new View("login");
        $v->title = "Login";
        $v->auth = Module_Auth::instance()->isAuth();
        $v->user = Module_Auth::instance()->getUser();
        $v->setTemplate();
        echo $v->renderGZ();
    }

}