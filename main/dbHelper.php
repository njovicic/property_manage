<?php
/*database helper*/
Class DbHelper{
    private $pdo=null;
    public $msg="success";
    public $sql="init";
    public $putErrorInfo=TRUE;
    public function __construct($dbConfig){
        try{
            $this->pdo = new PDO('mysql:host='.$dbConfig["host"].';dbname='.$dbConfig["dbName"], $dbConfig["user"],$dbConfig["pwd"]);
            //
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            //
            $this->pdo->exec('set names utf8');
        }
        catch(PDOException $e){
            $this->$msg=$e->getMassage();
        }

    }


    public function execSql($sql){
        try{
            $this->sql=$sql;
            $this->pdo->prepare($this->sql);
            //connect sql
            return $this->pdo->exec($this->sql);
        }
        catch(PDOException $e){
            //error execute
            $this->msg= $e->getMessage();
            if($this->putErrorInfo){
                echo $this->msg."<br>".$this->sql;
            }
            return false;
        }
    }

    public function querySql($sql){
        try{
            $this->sql=$sql;
            $this->pdo->exec('set names utf8');
            return $this->pdo->query($this->sql);
        }
        catch(PDOException $e){
            $this->msg= $e->getMessage();
            if($this->putErrorInfo){
                echo $this->msg."<br>".$this->sql;
            }
            return false;
        }
    }
}
?>
