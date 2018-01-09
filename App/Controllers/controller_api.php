<?php

/**
 * Created by PhpStorm.
 * User: virus
 * Date: 26.07.17
 * Time: 19:12
 */
class Controller_Api extends Controller
{

    public function action_index(){}
    public function action_register(){
        try{
            if(empty($_POST["login"])
                || empty($_POST["pass"])
                || empty($_POST["pass2"] )
                || empty($_POST["mail"])
            ) throw new Exception("Вы заполнили не все поля.");

            if($_POST["pass"]!=$_POST["pass2"]) throw new Exception("Пароли не совпадают.");
            $pattern = "/^[a-z0-9\.\_]+@[a-z]+\.[a-z\.]{2,}$/i";
            if(!preg_match($pattern,$_POST["mail"])) throw new Exception("Email не валиден.");

            if(!(Module_Auth::instance()->register($_POST["login"],$_POST["pass"],$_POST["mail"])))
                throw new Exception("Логин уже занят.");

            $v = new View("auth/registerok");
            $v->title="Регистрация успешна";
            $v->login = (new View("login"))->render();
            $v->setTemplate();
            echo $v->renderGZ();
        }catch(Exception $e){

            $v = new View("auth/registererr");
            $v->title="Регистрация провалена";
            $v->setTemplate();
            $v->msg = $e->getMessage();
            echo $v->renderGZ();
        }


    }
    public function action_login(){
        try{
            if(empty($_POST["login"]) || empty($_POST["pass"]))
                throw new Exception("Вы заполнили не все поля.");


            if(!(Module_Auth::instance()->login($_POST["login"],$_POST["pass"])))
                throw new Exception("Логин или пароль не верен.");

            Router::redirect("");
        }catch(Exception $e){

            $v = new View("auth/loginerr");
            $v->title="Ошибка входа";
            $v->setTemplate();
            $v->msg = $e->getMessage();
            echo $v->renderGZ();
        }
    }
    public function action_logout(){
        Module_Auth::instance()->logout();
        Router::redirect("");
    }
    public function action_addvideo(){
        try{
            if(!(Module_Auth::instance()->isAuth()))
                throw new Exception("Для добавления видео нужно авторизоватся.");
            if(empty($_POST["name"]) || empty($_POST["url"]))
                throw new Exception("Вы заполнили не все поля.");

            //сохранить картинку
           /* $ext_tmp = explode("/",$_FILES["img"]["type"]);
            $img_ext = end($ext_tmp);
            $image_name = "posts/BLOG_IMG_".time()."_".rand(10000,99999).".".$img_ext;
            $image_path = DOCROOT."Media/img/".$image_name;
            if(!move_uploaded_file($_FILES["img"]["tmp_name"],$image_path))
                throw new Exception("Извините, произошла ошибка загрузки файла изображения.");
            //добавить ее в базу (необходимо получить id вставки (dbh->lastInsertId))
            $img_id = Module_Database::instance()->img->insert([
                "url"=>$image_name
            ]);*/
            $url = $_POST["url"];
            $rexp = "/watch\?v\=(.+)/i";
            if(!preg_match($rexp,$url,$u))
                throw new Exception("Неверная ссылка.");
            $url="http://youtube.com/embed/".$u[1];

            //вызвать метод добаления видео
            Model_Videos::instance()->add($_POST["name"],$url);

                Router::redirect("");

            }catch(Exception $e){
            $v = new View("auth/loginerr");
            $v->title="Ошибка входа";
            $v->setTemplate();
            $v->msg = $e->getMessage();
            echo $v->renderGZ();
        }
    }
    public function action_delMyVideo(){
        if(!Module_Auth::instance()->isAuth()) throw new Exception("Not found",404);
       try{
           if(empty($_POST["id"])) throw new Exception("Error");
           $vid =Model_Videos::instance()->getById((int)$_POST["id"]);
           if(!$vid) throw new Exception("Error",404);
            if(Module_Auth::instance()->getUser()["id"]!=$vid["users_id"]) throw new Exception("Error",404);
            Module_Database::instance()->video->delete((int)$_POST["id"]);
       }catch (Exception $e){
           echo $e->getMessage();
       };

    }
    public function action_AdminDelVideo(){
        if(!Module_Auth::instance()->isAuth()) throw new Exception("Not found",404);
        try{
            if(!Module_Auth::instance()->hasRole("admin")) throw new Exception("not found",404);
             if(empty($_POST["id"]))throw new Exception("bay",404);
                Model_Videos::instance()->delete($_POST["id"]);
                echo $_POST["id"];
        }catch (Exception $e){
            echo $e->getMessage();
        };

    }
   public  function action_GetId(){
        if(!Module_Auth::instance()->isAuth()) throw new Exception("Not found",404);
        try{
            if(!Module_Auth::instance()->hasRole("admin")) throw new Exception("not found",404);
            if(empty($_POST["id"]))throw new Exception("bay",404);
            $video = Model_Videos::instance()->getById($_POST["id"]);
            echo json_encode($video);
        }catch (Exception $e){
            echo $e->getMessage();
        };
    }
    public function action_Save(){
        if(!Module_Auth::instance()->isAuth()) throw new Exception("Not found",404);
        try{
            if(!Module_Auth::instance()->hasRole("admin")) throw new Exception("not found",404);
            if(empty($_POST["id"])|| empty($_POST["name"])||empty($_POST["url"]))throw new Exception("bay",404);
            Module_Database::instance()->video->update($_POST["id"],[
                "name"=>$_POST["name"],
                "url"=>$_POST["url"]
            ]);
        }catch (Exception $e){
            echo $e->getMessage();
        };

    }
/*    public function action_EditVideo(){
        if(!Module_Auth::instance()->isAuth()) throw new Exception("Not found",404);
        try{
            if(Module_Auth::instance()->hasRole("admin")) throw new Exception("not found",404);
            if(empty($_POST["id"]))throw new Exception("bay",404);
            Model_Videos::instance()->getById($_POST["id"]);
        }catch (Exception $e){
            echo $e->getMessage();
        };
    }*/
    public function action_Admin(){
        if(empty($_POST["id"])) throw new Exception("error");
        $id = $_POST["id"];
        $videos = Model_Videos::instance()->myVideo($id);
        //sleep(1);
        echo json_encode($videos);

    }
    public function action_Del_User(){
        if(!Module_Auth::instance()->isAuth()) throw new Exception("Not found",404);
        try{
            if(!Module_Auth::instance()->hasRole("admin")) throw new Exception("not found",404);
            if(empty($_POST["id"]))throw new Exception("bay bay",404);
            Model_Videos::instance()->getUserId($_POST["id"]);
        }catch (Exception $e){
            echo $e->getMessage();
        }
    }
}