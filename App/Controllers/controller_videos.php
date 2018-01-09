<?php

class Controller_Videos extends Controller
{
    public function action_index()
    {
        $v = new View("videos/show");
        $v->auth = Module_Auth::instance()->isAuth();
        $v->user = Module_Auth::instance()->getUser();
        $page = empty(Router::getURIParam(2)) ? 1 : (int)Router::getURIParam(2);
        $allcount = Model_Videos::instance()->getCount();
        $count_per_page = 6;
        $page_count = ceil($allcount/$count_per_page);
        if($page>$page_count || $page<1) throw new Exception("Not found",404);
        $v->videos = Model_Videos::instance()->getPage($page,$count_per_page);
        $v->setTemplate();
        $v->addStyle("bootstrap");
        $v->pag = Helper_HTML::pagination($page_count,$page,URLROOT."videos/index");
        echo $v->renderGZ();
    }
    public function action_add(){
        $v = new View("videos/add");
        $v->auth = Module_Auth::instance()->isAuth();
        $v->user = Module_Auth::instance()->getUser();
        $v->setTemplate();
        $v->addStyle("bootstrap");
        echo $v->renderGZ();
    }
    public function action_myvideo(){
        if(!Module_Auth::instance()->isAuth()) throw new Exception("Not found",404);
        $v = new View ("videos/myvideo");
        $v->auth = Module_Auth::instance()->isAuth();
        $v->user = Module_Auth::instance()->getUser();
        $page = empty(Router::getURIParam(2)) ? 1 : (int)Router::getURIParam(2);
        $allcount = Model_Videos::instance()->getMyVideoCount(Module_Auth::instance()->getUser()["id"]);
        $count_per_page = 6;
        $page_count = ceil($allcount/$count_per_page);
        if(($page>$page_count || $page<1)&&$page!=1 ) throw new Exception("Not found",404);
        if($page_count>0)$v->videos = Model_Videos::instance()->getMyVideo(Module_Auth::instance()->getUser()["id"],$page,$count_per_page);
        $v->setTemplate();
        $v->addStyle("bootstrap");
        if($page_count>0)$v->pag = Helper_HTML::pagination($page_count,$page,URLROOT."videos/myvideo");
        else $v->pag="";
        echo $v->renderGZ();
    }



    

}