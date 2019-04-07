<?php
/*
common functions,as a class
*/
require_once('dbHelper.php');

Class TCommon
{
    //database setting
    static public $dbConfig = array(
        "host" => "localhost",
        "dbName" => "propertymanagement",
        "user" => "root",
        "pwd" => ""
    );
    //session  type admin
    public static $TYPE_ADMIN=0;
    //session type user
    public static $TYPE_USER=1;
    //website title
    static public $mainTitle = "Property Management";
    //website author
    static public $mainAuthor = "Team NNR";
    //user table name
    static public $userTbl = 'user';

    //header to the url as $url
    static public function headerTo($url)
    {
        header("Location:" . $url);
        exit();
    }
    // determine input string($item) is empty or not
    static public function isEmpty($item)
    {
        if (null != $item && "" != $item && '' != $item && FALSE != $item) {
            return false;
        } else {
            return true;
        }
    }

    //set session
    static public function setSession($name, $value)
    {
        $_SESSION[$name]=$value;
    }
    //determine the session is existed or not
    static public function sessionExisted($name){
        if(!isset($_SESSION[$name])||$_SESSION[$name]==NULL||$_SESSION[$name]==''||$_SESSION[$name]==FALSE){
            return false;
        }
        else{
            return true;
        }
    }

    //return SQL exec result such as count, or one field only
    static public function getOneColumn($sql)
    {
        $db = new DbHelper(TCommon::$dbConfig);
        $item = $db->querySql($sql);
        return $item->fetchColumn();
    }
    //select * from #tableName multi rows,multi fields
    static public function getAll($sql){
        $db = new DbHelper(TCommon::$dbConfig);
        $item = $db->querySql($sql);
        return $item->fetchAll();
    }
    //select one row multi fields
    static public function getOne($sql){
        $db = new DbHelper(TCommon::$dbConfig);
        $item = $db->querySql($sql);
        return $item->fetch();
    }
    //insert,delete,update SQL row
    static public function execSql($sql){
        $db = new DbHelper(TCommon::$dbConfig);
        $item = $db->execSql($sql);
        return $item;
    }

}

?>