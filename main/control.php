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
    $postal = $_POST["clientPostal"];
    $phone1 = $_POST["clientPhone1"];
    $phone2 = $_POST["clientPhone2"];
    $email = $_POST["clientEmail"];
    $details = $_POST["clientDetails"];
    $sqlInsert = "insert into client (clientName,clientAddress1,clientAddress2, clientCity, clientProv, clientPostal,
        clientPhone1, clientPhone2, clientEmail, clientDetails) 
        values('$clientName','$address1','$address2','$city','$province','$postal','$phone1','$phone2','$email','$details')";
    if (TCommon::execSql($sqlInsert)) {
        $r['success'] = true;
        $r['info'] = "$clientName create success";
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
    $status = $_POST["propStatus"];
    $subdivId = TCommon::getOneColumn("SELECT subdivId FROM subdivision WHERE subdivName=".$_POST["subdivName"]);
    $blockId = TCommon::getOneColumn("SELECT blockId FROM block WHERE blockName=".$_POST["blockName"]);
    $lotId = TCommon::getOneColumn("SELECT lotId FROM lot JOIN block ON lot.Block_blockId=$blockId".
        " JOIN subdivision ON Block.Subdivision_subdivId=$subdivId WHERE lotNumber=".$_POST["lotNumber"]);
    $sqlInsert = "insert into property (propStatus, Lot_lotId) values('$status','$lotId')";
    if (TCommon::execSql($sqlInsert)) {
        $r['success'] = true;
        $r['info'] = "property create success";
    }
    echo json_encode($r);
}

function list_properties(){
    $query = "SELECT * FROM property JOIN lot ON property.Lot_lotId=lot.lotId 
        JOIN block ON lot.Block_blockId=block.blockId 
        JOIN subdivision ON block.Subdivision_subdivId=subdivision.subdivId";
    return TCommon::getAll($query);
}

function del_property(){
    $id=$_GET["propId"];
    $sqlExec = "delete from property where propId = ".$id;
    print_r($sqlExec);
    if (TCommon::execSql($sqlExec)) {
        
    }
    TCommon::headerTo("../index.php");
}

function create_appointment(){
    $r["success"] = false;
    $clientid = TCommon::getOneColumn("SELECT clientId FROM client WHERE clientName=".$_POST["client_name"]);
    $userid = TCommon::getOneColumn("SELECT userId FROM user WHERE userName=".$_SESSION["NAME"]);
    $appointment_time = $_POST["appointment_time"];
    $sqlInsert = "INSERT INTO appointment (apptDate,Client_clientId,User_userId) VALUES('$appointment_time','$clientid','$userid')";
    if(TCommon::execSql($sqlInsert)){
        $r['success'] = true;
        $r['info'] = "Appointment created success";
    }
    echo json_encode($r);
}

function list_appointments(){
    $query = "SELECT appointment.apptDate, client.clientName, user.userName FROM appointment 
        JOIN client ON appointment.Client_clientId=client.clientId 
        JOIN user ON appointment.User_userId=user.userId";
    return TCommon::getAll($query);
}

function del_appointment(){
    $sqlExec = "DELETE FROM appointment WHERE apptDate = ".$_GET["apptDate"];
    print_r($sqlExec);
    if(TCommon::execSql($sqlExec)){

    }
    TCommon::headerTo("../index.php");
}