<?php


class Controller_Posts extends Controller
{

    public function action_index()
    {
        $view = new View('posts');
        echo $view->renderGZ();
    }

    public function action_add()
    {
        try{
            if(empty($_POST["title"]) || empty($_POST["name"]))
                throw new Exception("Вы заполнили не все поля.");
            Router::redirect('posts/showtop');
            Model_Posts::instance()->add($_POST['title'],$_POST['name']);

        }catch (Exception $e){
            echo $e->getMessage();
        }
    }

    public function action_showtop()
    {
        $p = new View('show');
        $p->posts = Model_Posts::instance()->getLast();
        $p->addStyle("default");
        echo $p->renderGZ();
    }

    public function action_showall()
    {
        $p = new View('showall');
        $p->posts = Model_Posts::instance()->show();
        $p->coments = Model_Posts::instance()->showComment();
        echo $p->renderGZ();
    }

    public function action_showone()
    {
        $uri = $_SERVER['REQUEST_URI'];
        $res =  substr($uri,21);
        $one = new View('onepost');
        $one->posts = Model_Posts::instance()->getById($res);
        $one->coments = Model_Posts::instance()->showComment();
        $one->addStyle('bootstrap');
        echo $one->renderGZ();
    }


    //----------------------------------COMMENT--------------------------------------

    public function action_addcomment()
    {
        $uri = $_SERVER['REQUEST_URI'];
        try{
            if( empty($_POST["com"]))
                throw new Exception("Вы заполнили не все поля.");
            Router::redirect('posts/showall');
            Model_Posts::instance()->addComment($_POST['id'],$_POST['com']);

        }catch (Exception $e){
            echo $e->getMessage();
        }

    }




}