<?php

class Module_Auth
{
    use Singletone;
    private $db;
    private $is_login = NULL;
    private $user = NULL;
    const HASH_KEY_LEN = 15;
    const HASH_KEY_POS = 30;

    private function generate_hash_key($name){
        $data = $name.time().$_SERVER["HTTP_USER_AGENT"];
        $hash = hash("sha256",$data);
        $hash = md5($hash);
        return substr($hash,3,self::HASH_KEY_LEN);
    }
    private function hash_pass($pass,$key){
        $hash = hash("sha256",$pass.$key.$pass.substr($key,0,5));
        $hash = $hash.sha1($hash);
        $hash = hash("sha256",$hash);
        $hash1 = substr($hash,0,self::HASH_KEY_POS);
        $hash2 = substr($hash,self::HASH_KEY_POS);
        return $hash1.$key.$hash2;
    }
    private function get_key_from_hash($hash){
        return substr($hash,self::HASH_KEY_POS,self::HASH_KEY_LEN);
    }
    private function compare_pass($pass,$hash){
        $key = $this->get_key_from_hash($hash);
        $hash2 = $this->hash_pass($pass,$key);
        return $hash == $hash2;
    }
    private function create_session_key($name,$ip,$agent,$time){
        $key1 = sha1($name.$ip.$time);
        $key2 = hash("sha256",$ip.$time.$agent);
        $key3= sha1($key1.$name.$key2.$time);
        return hash("sha256",$key1.$key2.$key3);
    }
    private function validate_session($token){
        $ip = $_SERVER["REMOTE_ADDR"];
        $agent = $_SERVER["HTTP_USER_AGENT"];
        if($token["user_ip"]!==md5($ip)) return false;
        if($token["user_agent"]!==md5($agent)) return false;
        if($token["expiries"]<time()) return false;
        return true;
    }
    private function create_session($name,$id){
        $ip = $_SERVER["REMOTE_ADDR"];
        $agent = $_SERVER["HTTP_USER_AGENT"];
        $time = time();
        $token = $this->create_session_key($name,$ip,$agent,$time);
        $expiries =$time+3600*24;
        setcookie("token",$token,$expiries,URLROOT);
        $this->db->tokens->insert([
            "token"     =>  $token,
            "user_ip"   =>  md5($ip),
            "user_agent"=>  md5($agent),
            "expiries"  =>  $expiries,
            "users_id"  =>  (int)$id
        ]);
    }

    private function __construct()//pattern singleton (private constructor)
    {
        $this->db = Module_Database::instance();
    }


    public function register($login,$pass,$mail){
        if($this->db->users->getCount("`login`=:login OR `email`=:mail",["login"=>$login,"mail"=>$mail])>0) return false;
        $this->db->users->insert([
            "login"=>$login,
            "pass"=>$this->hash_pass($pass,$this->generate_hash_key($login)),
            "email"=>$mail
        ]);
        return true;
    }
    public function login($login,$pass){
        $user = $this->db->users->getAll("`login`=:l",["l"=>$login]);
        if(empty($user)) return false;
        $user = $user[0];
        if(!$this->compare_pass($pass,$user["pass"])) return false;
        $this->create_session($user["login"],$user["id"]);
        return true;
    }
    public function getUser(){

        return $this->user;
    }

    public function isAuth(){
        if(!is_null($this->is_login)) return $this->is_login;
        if(empty($_COOKIE["token"])) return false;
        $token = $this->db->tokens->getAll("`token`=:t",["t"=>$_COOKIE["token"]]);
        if(!$token) return $this->is_login = false;
        if(!$this->validate_session($token[0])) return $this->is_login = false;
        if($this->user==NULL) $this->user = $this->db->users->getById((int)($token[0]["users_id"]));
        if(time()+3600*12 > $token[0]["expiries"]){
            $this->db->tokens->update($token[0]["id"],["expiries"=>time()+3600*24]);
            setcookie("token",$token,time()+3600*24,URLROOT);
        }
        return $this->is_login = true;
    }
    public function logout(){
        if(empty($_COOKIE["token"])) return;
        $token = $this->db->tokens->getAll("`token`=:t",["t"=>$_COOKIE["token"]]);
        if(!$token) return ;
        $this->db->tokens->deleteWhere("`users_id`=:id AND (`token`=:t OR `expiries` < :time)",[
            "id"    =>  $token[0]["users_id"],
            "t"     =>  $_COOKIE["token"],
            "time"  =>  time()
        ]);
    }
    public function hasRole($role){
        if(!$this->isAuth()) return false;
        $r = Module_Database::instance()->querySingleCell("
            SELECT COUNT(*) FROM roles AS r 
            JOIN user_roles AS ur ON (ur.roles_id = r.id )
            WHERE ur.users_id=? AND r.name=?
        ",[(int)$this->user["id"],$role]);
        return (int)$r;
    }
    public function createDatabase(){
        $query = file_get_contents("auth.sql");
        $this->db->exec($query);
    }
}
