<?php
class Module_Database
{
    private $_tables,$_dbh,$_activeTable=NULL;
    use Singletone;
    private function __construct()
    {
        $opt = Module_Config::load("db");
        $this->_dbh = new PDO("mysql:host={$opt["host"]};dbname={$opt["dbname"]};charset={$opt["charset"]}",
            $opt["user"],
            $opt["pass"],
            [
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
            ]
        );
        $sth = $this->_dbh->query("SHOW TABLES");
        $this->_tables = $sth->fetchAll(PDO::FETCH_COLUMN);
    }


    public function __get($name){
        if(!in_array($name,$this->_tables)) return NULL;
        $this->_activeTable = $name;
        return $this;
    }
    public function query($query,$params=[]){
        $sth = $this->_dbh->prepare($query);
        $sth->execute($params);
        return $sth->fetchAll();
    }
    public function querySingleCell($query,$params=[]){
        $sth = $this->_dbh->prepare($query);
        $sth->execute($params);
        return $sth->fetchColumn();
    }
    public function exec($query){
        $this->_dbh->exec($query);
    }

    public function getAll($where = "1",$params=[]){
        $sth = $this->_dbh->prepare("SELECT * FROM {$this->_activeTable} WHERE {$where}");
        $sth->execute($params);
        return $sth->fetchAll();
    }
    public function getCount($where = "1",$params=[]){
        $sth = $this->_dbh->prepare("SELECT COUNT(*) FROM {$this->_activeTable} WHERE {$where}");
        $sth->execute($params);
        return (int)$sth->fetchColumn();
    }
    public function insert(array $data){
        $fields = array_keys($data);
        $query = "INSERT INTO `{$this->_activeTable}`(`";
        $query.=implode("`,`",$fields)."`) VALUES ( :".implode(", :",$fields).")";
        $sth = $this->_dbh->prepare($query);
        $sth->execute($data);
        return $this->_dbh->lastInsertId();
    }
    public function delete($id){
        $sth = $this->_dbh->prepare("DELETE FROM `{$this->_activeTable}` WHERE `id`=:id");
        $sth->bindValue("id",$id,PDO::PARAM_INT);
        $sth->execute();
    }
    public function update($id,array $data){
        $fields = array_keys($data);
        $values = [];
        foreach($fields as $field) $values[] = "`".$field."`=:".$field;
        $query = "UPDATE {$this->_activeTable} SET ".implode(",",$values)." WHERE `id`=:id";
        $data["id"]=(int)$id;
        $sth = $this->_dbh->prepare($query);
        $sth->execute($data);
    }

    public function updateWhere($where='0',array $params=[],array $data){
        $values = [];
        foreach($data as $field=>$value) {
            $values[] = "`".$field."`=:param_db_".$field;
            $data["param_db_".$field] = $value;
            unset($data[$field]);
        }
        $data = array_merge($data,$params);
        $query = "UPDATE {$this->_activeTable} SET ".implode(",",$values)." WHERE {$where}";
        $sth = $this->_dbh->prepare($query);
        $sth->execute($data);
    }

    public function deleteWhere($where='0',array $params=[])
    {
        $sth = $this->_dbh->prepare("DELETE FROM `{$this->_activeTable}` WHERE {$where}");
        $sth->execute($params);
    }
    public function getById($id){

        $sth =$this->_dbh->prepare("SELECT * FROM `{$this->_activeTable}` WHERE `id`=:id");
        $sth->bindValue("id",$id,PDO::PARAM_INT);
        $sth->execute();
        return $sth->fetch();
    }
    
    public function getColumn($columnname,$where='1',$params=[]){
        $sth = $this->_dbh->prepare("SELECT `{$columnname}` FROM {$this->_activeTable} WHERE {$where}");
        $sth->execute($params);
        return $sth->fetchAll(PDO::FETCH_COLUMN);
    }
    public function getColumns($columns,$where='1',$params=[]){
        $sth = $this->_dbh->prepare("SELECT `".implode("`,`",$columns)."` FROM {$this->_activeTable} WHERE {$where}");
        $sth->execute($params);
        return $sth->fetchAll();
    }

}

