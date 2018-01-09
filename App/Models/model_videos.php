<?php

class Model_Videos extends Model{
    use Singletone;
    private function __construct(){}

    public function getAll(){
        return Module::load("Database")->video->getAll();
        //return Module_Database::instance()->video->getAll();
    }
    public function  getLast(){
        return Module::load("Database")->video->getAll("1  ORDER BY `id` DESC LIMIT 5");

    }
    
    public function getPage($page,$count_per_page){
        $offset = $count_per_page * ($page-1);
        return Module::load("database")->video->getAll("1 ORDER BY `id` DESC LIMIT {$count_per_page} OFFSET {$offset}");
    }
    public function getCount(){
        return Module::load("database")->video->getCount();
    }

    public function add($name,$url){
        return Module_Database::instance()->video->insert([
            "name"=>$name,
            "url"=>$url,
            "users_id"=>(int)(Module_Auth::instance()->getUser()["id"]),
        ]);
    }
    public function myVideo($id){
        $res =Module::load("database")->query("SELECT `name`,`url`,`login`,`video`.`id` FROM `video` 
            INNER JOIN `users` ON (`video`.`users_id`=`users`.`id`) WHERE `video`.`users_id`=?",
            [$id]);
        if(!$res) return false;
        return $res;

    }
    public function getMyVideo($id,$page,$count_per_page){
        $offset = $count_per_page * ($page-1);
        $res =Module::load("database")->query("SELECT `name`,`url`,`login`,`video`.`id` FROM `video` 
            INNER JOIN `users` ON (`video`.`users_id`=`users`.`id`) WHERE `video`.`users_id`=?
            ORDER BY `video`.`id` DESC LIMIT {$count_per_page} OFFSET {$offset}",
            [$id] );
        if(!$res) return false;
        return $res;

    }
    public function getMyVideoCount($id){
        return Module::load("Database")->video->getCount("`video`.`users_id`=?",[$id]);
    }
   public function getById($id){
        $res = Module::load("database")->video->getAll("`id`=?",[(int)$id]);
        if(!$res) return false;
        return $res[0];
    }
    public function delete($id){
       $del= Module_Database::instance()->video->delete($id);
       return $del;
    }
    public function getUserId($id){
       $res= Module_Database::instance()->users->delete($id);
            return $res;
    }
  /*  public function edit($id){
        $res =
    }*/
    /*public function getSearchResult($q,$page=0,$count_per_page=0){
        $offset = $count_per_page * ($page-1);
        return Module::load("database")->query("
                SELECT `p`.`id`,`p`.`name`,CONCAT(SUBSTRING(`p`.`text`,1,220),\"...\") as `text`, `p`.`time`,`c`.`name` AS `cat`,`c`.`urlname`, `i`.`url` AS `img`
                FROM `posts` AS `p` 
                INNER JOIN `img` AS `i` ON (`i`.`id` = `p`.`img_id`)
                INNER JOIN `categories` AS `c` ON (`p`.`categories_id` = `c`.`id`)
                WHERE `p`.`name` LIKE ?
                ORDER BY `p`.`id` DESC LIMIT {$count_per_page} OFFSET {$offset}
         ",["%".$q."%"]);
    }*/

    /*public function getCountResult($q){
        return (int)(Module::load("database")->querySingleCell("
            SELECT COUNT(*) FROM `posts` AS `p` 
                INNER JOIN `img` AS `i` ON (`i`.`id` = `p`.`img_id`)
                INNER JOIN `categories` AS `c` ON (`p`.`categories_id` = `c`.`id`)
                WHERE `p`.`name` LIKE ?
         ",["%".$q."%"]));
    }*/
}