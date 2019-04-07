<?php
session_start();

require_once('TCommon.php');
if (isset($_GET['act'])) {
    switch ($_GET['act']) {
        case 'user_register':
            userRegister();
            break;
        case 'user_login':
            userLogin(); //TCommon::$TYPE_USER
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
        case 'edit_appointment':
            edit_appointment();
            break;

        case 'list_clients':
            list_clients();
            break;
        case 'create_client':
            create_client();
            break;
        case 'del_client':
            del_client();
            break;
        case 'edit_client':
            edit_client();
            break;

        case 'list_items':
            list_items();
            break;
        case 'create_item':
            create_item();
            break;
        case 'edit_item':
            edit_item();
            break;
        case 'del_item':
            del_item();
            break;

        case 'list_properties':
            list_properties();
            break;

        case 'view_package':
            view_package();
            break;

        default:
            break;
    }
}

//--registration--
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
        $sqlSearch = "SELECT userPass FROM user WHERE userName='$name'";
        if ($pwd_ === TCommon::getOneColumn($sqlSearch)) {
            //get UserID begin
            $sqlSearch = "SELECT * FROM user WHERE userName = '$name'";
            $user = TCommon::getOne($sqlSearch);
            TCommon::setSession('ID', $user["userId"]);
            //get userID end
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

    if(TCommon::isEmpty($clientName) || TCommon::isEmpty($phone1)){
        $r["error"] = "client name and phone number 1 cannot left blank";
    }
    else if(!preg_match("/\(? (\d{3})? \)? (?(1) [\-\s])\d{3}-\d{4}/x", $phone1)){
        $r["error"] = "phone number entered not in valid format";
    }
    else{
        $sql = "SELECT count(*) FROM client WHERE clientName ='$clientName'";
        if(0 == TCommon::getOneColumn($sql)){
            $sqlInsert = "INSERT INTO client (clientName,clientAddress1,clientAddress2,clientCity,clientProv,clientPostal,clientPhone1,clientPhone2,clientEmail,clientDetails)
                    VALUES ('$clientName','$address1','$address2','$city','$province','$postal','$phone1','$phone2','$email','$details')";
            if(TCommon::execSql($sqlInsert)){
                 $r['success'] = true;
                 $r['info'] = "$clientName create success";
            }
        }
        else{
            $r["error"] = "$clientName exist already";
        }
    }

    echo json_encode($r);
}

function edit_client(){
    $r["success"] = false;
    $id = $_POST["clientId"];
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

    //$sqlQuery = "SELECT * FROM client WHERE client.clientName = '$clientName'";

    $sql = "UPDATE client SET clientName = '$clientName',
            clientAddress1 = '$address1',
            clientAddress2 = '$address2',
            clientCity = '$city',
            clientProv = '$province',
            clientPostal = '$postal',
            clientPhone1 = '$phone1',
            clientPhone2 = '$phone2',
            clientEmail = '$email',
            clientDetails = '$details'
            WHERE clientId = $id";

    TCommon::execSql($sql);
    $r['success'] = true;
    $r['info'] = "Client info updated success";

    echo json_encode($r);
}

function del_client(){
    $clientName = $_GET["clientName"];
    $sqlExec = "DELETE FROM client WHERE client.clientName = '$clientName'";

    print_r($sqlExec);
    if(TCommon::execSql($sqlExec)){

    }
    TCommon::headerTo("../list_client_page.php");
}

//--item--
function create_item(){
    $r["success"] = false;
    $itemName = $_POST["itemName"];
    $itemDescription = $_POST["itemDescription"];
    $itemStandard = $_POST["itemStandard"];
    $itemType = $_POST["itemType"];
    $itemManufacturer = $_POST["itemManufacturer"];

    if(TCommon::isEmpty($itemName)){
        $r["error"] = "item name cannot left blank";
    }
    else{

        $sqlInsert = "INSERT INTO item (itemName, itemDescription, itemStandard, itemType_typeId, itemManufacturer_manuId)
                    VALUES ('$itemName', '$itemDescription', '$itemStandard', $itemType, $itemManufacturer)";
        TCommon::execSql($sqlInsert);
            $r['success'] = true;
            $r['info'] = "Item created success";
    }

    echo json_encode($r);
}

function edit_item(){
    $r["success"] = false;
    $id = $_POST["id"];
    $itemName = $_POST["itemName"];
    $itemDescription = $_POST["itemDescription"];
    $itemStandard = $_POST["itemStandard"];
    $itemType = $_POST["itemType"];
    $itemManufacturer = $_POST["itemManufacturer"];


    //$sql = "SELECT count(*) FROM item WHERE itemName ='$itemName'";
        //if(0 == TCommon::getOneColumn($sql)){
            $sql = "UPDATE item SET itemName='$itemName',
                    itemDescription='$itemDescription',
                    itemStandard='$itemStandard',
                    itemType_typeId='$itemType',
                    itemManufacturer_manuId='$itemManufacturer'
                    WHERE itemId=$id";
            TCommon::execSql($sql);

            $r['success'] = true;
            $r['info'] = "$itemName edited success";

        //}
        //else{
        //    $r["error"] = "cannot locate itemId by $itemName";
        //}
    echo json_encode($r);
}

function list_items(){
    $query = "SELECT * FROM item
    JOIN itemtype ON item.ItemType_typeId=itemtype.typeId
    JOIN itemmanufacturer ON item.ItemManufacturer_manuId=itemmanufacturer.manuId";
    return TCommon::getAll($query);
}

function del_item(){
    $itemName = $_GET["itemName"];
    $sqlExec = "DELETE FROM item WHERE item.itemName = '$itemName'";
    print_r($sqlExec);
    if(TCommon::execSql($sqlExec)){

    }
    TCommon::headerTo("../list_item_page.php");
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
    $sqlInsert = "INSERT INTO property (propStatus, Lot_lotId) VALUES('$status','$lotId')";
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
    $propId =$_GET["propId"];
    $sqlExec = "DELETE FROM property WHERE property.propId = '$propId'";
    print_r($sqlExec);
    if(TCommon::execSql($sqlExec)){

    }
    TCommon::headerTo("../list_item_page.php");
}

function edit_property(){
}


//--appointment--
function create_appointment(){
    $r["success"] = false;

    $uid = $_SESSION['ID'];
    $clientName = $_POST["clientName"];
    $apptDate = $_POST["apptDate"];

    $clientId = false;
    $sqlQuery = "SELECT * FROM client WHERE client.clientName='$clientName'";
    $client = TCommon::getOne($sqlQuery);
    if($client){
        $clientId = $client["clientId"];
    }
    if($clientId){

        $sqlInsert = "INSERT INTO appointment (apptDate,Client_clientId,User_userId) VALUES('$apptDate',$clientId,$uid)";
        if(TCommon::execSql($sqlInsert)){
            $r['success'] = true;
            $r['info'] = "Appointment created success";
        }
    }else{
       $r['info'] = "cannot locate clientId by name $clientName";
    }
    echo json_encode($r);
}

function list_appointments(){
    $uid = $_SESSION['ID'];
    $query = "SELECT  appointment.apptId, appointment.apptDate, client.clientName, client.clientPhone1, client.clientEmail FROM appointment
        JOIN client ON appointment.Client_clientId=client.clientId WHERE appointment.User_userId=$uid";
    return TCommon::getAll($query);
}

function del_appointment(){
    $apptDate=$_GET["apptDate"];
    $sqlExec = "DELETE FROM appointment WHERE appointment.apptDate='$apptDate'";
    print_r($sqlExec);
    if(TCommon::execSql($sqlExec)){

    }
    TCommon::headerTo("../index.php");
}

function edit_appointment(){
    $r["success"] = false;
    $id = $_POST["id"];
    $clientName = $_POST["clientName"];
    $apptDate = $_POST["apptDate"];

    $sqlQuery = "SELECT * FROM client WHERE client.clientName='$clientName'";
    $client = TCommon::getOne($sqlQuery);
    if($client){
        $clientId = $client["clientId"];
    }
   if($clientId){
        $sql = "UPDATE appointment SET apptDate='$apptDate', Client_clientId=$clientId WHERE apptId=$id";
        TCommon::execSql($sql);
        $r['success'] = true;
        $r['info'] = "Appointment updated success";
   }else{
        $r['info'] = "cannot locate clientId by name $clientName";
   }
   echo json_encode($r);

}

//--package--
function view_package(){
    TCommon::headerTo("../view_package_page.php");
}

function create_package(){
    TCommon::headerTo("../new_package_page.php");
}

//--listbox get value--
function listTypes(){
    $sql = "SELECT * FROM itemType";
    return TCommon::getAll($sql);
}

function listManus(){
    $sql = "SELECT * FROM itemManufacturer";
    return TCommon::getAll($sql);
}

function listLocations(){
    $sql = "SELECT * FROM itemLocation";
    return TCommon::getAll($sql);
}

function listItems(){
    $sql = "SELECT * FROM item";
    return TCommon::getAll($sql);
}