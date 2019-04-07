<?php
session_start();

require_once('TCommon.php');
if (isset($_GET['act'])) {
    switch ($_GET['act']) {
        case 'user_register':
            userRegister();
            break;
        case 'user_login':
            userLogin(TCommon::$TYPE_USER);
            break;
        case 'out':
            logOut();
            break;
        case 'create_appointment':
            create_appointment();
            break;
        case 'list_appointments':
            list_appointments();
            break;
        case 'del_appointment':
            del_appointment();
            break;
        case 'list_clients':
            list_client();
            break;
        case 'create_client':
            create_client();
            break;
        case 'list_items':
            list_items();
            break;
        case 'list_properties':
            list_properties();
            break;
        default:
            break;
    }
}

//registration
function userRegister()
{
    $r["success"] = false;
    $name = $_POST["name"];
    $pwd = trim($_POST["pwd"]);
    $pwd1 = trim($_POST["pwd_a"]);
    $email = $_POST["email"];
    $tel = $_POST["tel"];

    if (!TCommon::isEmpty($name)
        && !TCommon::isEmpty($pwd)
    ) {
        if ($pwd1 !== $pwd) {
            $r["error"] = "password are not match";
        } else {
            //check user exist
            $sql = "select count(*) from " . TCommon::$userTbl . " where userName='$name'";
            if (0 == TCommon::getOneColumn($sql)) {
                $pwd_ = md5($pwd);
                $sqlInsert = "insert into " . TCommon::$userTbl . " (userName,userPass,userEmail,userPhone)
                values('$name','$pwd_','$email','$tel')";
                if (TCommon::execSql($sqlInsert)) {
                    $r['success'] = true;
                    $r['info'] = "$name register success";
                }
            } else {
                $r["error"] = "$name name taken";
            }
        }
    } else {
        $r["error"] = "cannot left empty";
    }
    echo json_encode($r);
}


function userLogin()
{
    $r["success"] = false;
    $name = $_POST["name"];
    $pwd = trim($_POST["pwd"]);
    if (!TCommon::isEmpty($name) && !TCommon::isEmpty($pwd)) {
        $pwd_ = md5($pwd);
        $tbl = TCommon::$userTbl;
        $sqlSearch = "select userPass from " . $tbl . " where userName='$name'";
        if ($pwd_ === TCommon::getOneColumn($sqlSearch)) {
            $r['success'] = true;
            $r['info'] = "$name login success";
            TCommon::setSession('NAME', $name);
        } else {
            $r["error"] = "password wrong";
        }
    } else {
        $r["error"] = "null exception";
    }
    echo json_encode($r);
}

function logOut()
{
    $url = "../index.php";
    unset($_SESSION["NAME"]);
    TCommon::headerTo($url);
}


function getLoginUserName()
{
    if (TCommon::sessionExisted("NAME")) {
        return $_SESSION["NAME"];
    } else {
        return FALSE;
    }
}

//--client--
function list_clients(){
    $query = "select * from client ";
    return TCommon::getAll($query);
}

function create_client(){
    $r["success"] = false;
    $clientName = $_POST["clientName"];
    $address1 = $_POST["clientAddress1"];
    $address2 = $_POST["clientAddress2"];
    $city = $_POST["clientCity"];
    $province = $_POST["clientProv"];
    $postal =


        $r["success"] = false;
        $name = $_POST["name"];
        $price = trim($_POST["price"]);
        $address = trim($_POST["address"]);
        $sqlInsert = "insert into `property` (name,address,price) values('$name','$address',$price)";
        if (TCommon::execSql($sqlInsert)) {
            $r['success'] = true;
            $r['info'] = "$name create success";
        }
        echo json_encode($r);
}

//--item--
function list_items(){
    //$query = "SELECT * FROM item";
    $query = "SELECT item.itemName, item.itemDescription, item.itemStandard, itemtype.typeName, itemmanufacturer.manuName FROM item
    JOIN itemtype ON item.ItemType_typeId=itemtype.typeId
    JOIN itemmanufacturer ON item.ItemManufacturer_manuId=itemmanufacturer.manuId";
    return TCommon::getAll($query);
}

//--property--
function create_property()
{
    $r["success"] = false;
    $name = $_POST["name"];
    $price = trim($_POST["price"]);
    $address = trim($_POST["address"]);
    $sqlInsert = "insert into `property` (name,address,price) values('$name','$address',$price)";
    if (TCommon::execSql($sqlInsert)) {
        $r['success'] = true;
        $r['info'] = "$name create success";
    }
    echo json_encode($r);
}

function list_properties(){
    $query = "SELECT * FROM property";
    return TCommon::getAll($query);

}

function del_property(){
    $id=$_GET["id"];
    $sqlExec = "delete from `property` where id = ".$id;
    print_r($sqlExec);
    if (TCommon::execSql($sqlExec)) {
        
    }
    TCommon::headerTo("../index.php");
}

function create_appointment(){
    $r["success"] = false;
    $name = $_POST["client_name"];
    $appointment_time = $_POST["appointment_time"];
    $sqlInsert = "INSERT INTO appointment (apptDate,Client_clientId,User_userId) values('','','')"; //!!!!!!!!!!!!!!!!
    if(TCommon::execSql($sqlInsert)){
        $r['success'] = true;
        $r['info'] = "Appointment created success";
    }
    echo json_encode($r);
}

function list_appointments(){
    $query = "SELECT appointment.apptDate, client.clientName FROM appointment INNER JOIN client ON appointment.Client_clientId=client.clientId";
    return TCommon::getAll($query);
}

function del_appointment(){
    $id=$_GET["apptDate"];
    $sqlExec = "DELETE FROM appointment WHERE apptDate = ".$apptDate;
    print_r($sqlExec);
    if(TCommon::execSql($sqlExec)){

    }
    TCommon::headerTo("../index.php");
}