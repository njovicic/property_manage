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
        case 'create_property':
            create_property();
            break;
        case 'edit_property':
            edit_property();
            break;
        case 'del_property':
            del_property();
            break;

        case 'view_package':
            view_package();
            break;
        case 'create_package':
            create_package();
            break;
        case 'edit_package':
            edit_package();
            break;
        case 'del_package':
            del_package();
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
        $sql = "SELECT count(*) FROM item WHERE itemName ='$itemName'";
        if(0 == TCommon::getOneColumn($sql)){
            $sqlInsert = "INSERT INTO item (itemName, itemDescription, itemStandard, itemType_typeId, itemManufacturer_manuId)
                    VALUES ('$itemName', '$itemDescription', '$itemStandard', '$itemType', '$itemManufacturer')";
            if(TCommon::execSql($sqlInsert)){
                $r['success'] = true;
                $r['info'] = "$itemName created success";
            }
        }
        else{
            $r["error"] = "$itemName already exits";
        }

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

//--appointment---------------------------------------------------------------------------------------------------------
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


//--property------------------------------------------------------------------------------------------------------------
function create_property(){
    $r["success"] = false;

    $sub = $_POST["p_sub"];
    $block = $_POST["p_block"];
    $lot = $_POST["p_lotnum"];
    $size = $_POST["p_size"];
    $model = $_POST["p_model"];
    $date = $_POST["p_closingdate"];
    $status = $_POST["p_status"];
    $buyer = $_POST["p_buyer"];

    if(TCommon::isEmpty($lot) || TCommon::isEmpty($sub) || TCommon::isEmpty($block)){
        $r["error"] = "Lot#, sub, block cannot left blank";
    }
    else{
        $sqlCheckLot = "SELECT count(*) FROM property WHERE lotNum = '$lot'";
        if(0==TCommon::getOneColumn($sqlCheckLot)){
            if($status != "available"){
                if(TCommon::isEmpty($buyer)){
                    $r["error"] = "status $status requires a buyer";
                }
                else{
                    $sqlQuery = "SELECT * FROM client WHERE client.clientName = '$buyer'";
                    $client = TCommon::getOne($sqlQuery);
                    if($client){
                        $clientId = $client["clientId"];
                        $sqlInsert = "INSERT INTO property (status, lotNum, lotSize, closingDate, lotModel, sub, block, clientId)
                                VALUES('$status','$lot','$size','$date','$model','$sub','$block',$clientId)";
                        if(TCommon::execSql($sqlInsert)){
                            $r["success"] = true;
                            $r['info'] = "success";
                        }
                    }
                    else{
                        $r["error"] = "Buyer not in file";
                    }
                }
            }
            else{
                $sqlInsert = "INSERT INTO property (status, lotNum, lotSize, closingDate, lotModel, sub, block, clientId)
                                VALUES('$status','$lot','$size','$date','$model','$sub','$block', 'NULL')";
                if(TCommon::execSql($sqlInsert)){
                    $r['success'] = true;
                    $r['info'] = "success";
                }
            }
        }
        else{
            $r["error"] = "$lot exist already";
        }
    }
    echo json_encode($r);
}

function edit_property(){

    $r["success"] = false;
    $id=$_POST["id"];

    $sub = $_POST["p_sub"];
    $block = $_POST["p_block"];
    $lot = $_POST["p_lotnum"];
    $size = $_POST["p_size"];
    $model = $_POST["p_model"];
    $date = $_POST["p_closingdate"];
    $status = $_POST["p_status"];
    $buyer = $_POST["p_buyer"];

    if(TCommon::isEmpty($lot) || TCommon::isEmpty($sub) || TCommon::isEmpty($block)){
        $r["error"] = "Lot#, sub, block cannot left blank";
    }
    else{
        $sqlCheckLot = "SELECT count(*) FROM property WHERE lotNum = '$lot'";
        //if(1==TCommon::getOneColumn($sqlCheckLot)){
            if($status != "available"){
                if(TCommon::isEmpty($buyer)){
                    $r["error"] = "status $status requires a buyer";
                }
                else{
                    $sqlQuery = "SELECT * FROM client WHERE client.clientName = '$buyer'";
                    $client = TCommon::getOne($sqlQuery);
                    if($client){
                        $clientId = $client["clientId"];
                        $sqlUpdate = "UPDATE property SET sub = '$sub',
                                block = '$block',
                                lotNum = '$lot',
                                lotSize = '$size',
                                lotModel = '$model',
                                closingDate = '$date',
                                status = '$status',
                                clientId = '$clientId'
                                WHERE propertyId = $id";
                        if(TCommon::execSql($sqlUpdate)){
                            $r["success"] = true;
                            $r['info'] = "success";
                        }
                    }
                    else{
                        $r["error"] = "Buyer not in file";
                    }
                }
            }
            else{
                $sqlUpdate = "UPDATE property SET sub = '$sub',
                                            block = '$block',
                                            lotNum = '$lot',
                                            lotSize = '$size',
                                            lotModel = '$model',
                                            closingDate = '$date',
                                            status = '$status',
                                            clientId = 'NULL'
                                            WHERE propertyId = $id";

                $sqlInsert = "INSERT INTO property (status, lotNum, lotSize, closingDate, lotModel, sub, block, clientId)
                                VALUES('$status','$lot','$size','$date','$model','$sub','$block', 'NULL')";
                if(TCommon::execSql($sqlUpdate)){
                    $r['success'] = true;
                    $r['info'] = "success";
                }
            }
        //}
        //else{
            //$r["error"] = "$lot exist already";
        //}
    }
    echo json_encode($r);
}

function list_properties(){
    $query = "SELECT property.*, client.clientName FROM property LEFT JOIN client ON property.clientId = client.clientId";
    return TCommon::getAll($query);
}

function del_property(){
    $lot=$_GET["lotNum"];
    $sqlExec = "DELETE FROM property WHERE property.lotNum = '$lot'";
    print_r($sqlExec);
    if(TCommon::execSql($sqlExec)){

    }
    TCommon::headerTo("../list_property_page.php");
}


//--package-------------------------------------------------------------------------------------------------------------
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