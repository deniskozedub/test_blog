<?php

class Model_Posts extends Model
{
    use Singletone;
    private function __construct(){}

    public function add($title,$name){
        return Module_Database::instance()->posts->insert([
            "title"=>$title,
            "authors_name"=>$name,
        ]);
    }

    public function show()
    {
       return Module::load("Database")->posts->getAll();
    }
    public function show_posts()
    {
        return Module::load("Database")->posts->getAll("1  ORDER BY `id` DESC LIMIT 50");
    }


    public function  getLast(){
        return Module_Database::instance()->posts->getAll("1  ORDER BY `id` DESC LIMIT 5");

    }

    public function getById($id){
        $res = Module_Database::instance()->posts->getAll("`id`=?",[(int)$id]);
        return $res;
    }


    public function addComment($id_post,$title)
    {
        return Module_Database::instance()->coments->insert([
           'com' => $title,
           'post_id' => $id_post
        ]);
    }


    public function showComment()
    {
        $res = Module::load("database")->query("SELECT *  FROM `coments` 
            INNER JOIN `posts` ON (`coments`.`post_id`=`posts`.`id`) WHERE `coments`.`post_id`=`posts`.`id`");
        if(!$res) return false;
        return $res;
    }

    public function count_comments()
    {
        $res = Module_Database::instance()->query("SELECT count(`post_id`),`posts`.`id`  from `coments` inner join `posts` 
                                            on `coments`.`post_id` = `posts`.`id` group by `posts`.`id`");
        if(!$res) return false;
        return $res;
    }

}
