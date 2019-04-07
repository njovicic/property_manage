<?php
require_once('./main/control.php');
$u_name = FALSE;
if (isset($_SESSION["NAME"])) {
    $u_name = FALSE == $_SESSION["NAME"] ? FALSE : $_SESSION["NAME"];
}

?>
<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="content-type" content="text/html;charset=utf-8"/>
    <script src="assets/jquery.min.js"></script>
    <script src="assets/common.js"></script>
    <title><?php echo TCommon::$mainTitle; ?></title>
    <link rel="stylesheet" href="style.css" />
</head>

<body>
<div id="head" >
    <div>
        <?php if ($u_name === FALSE) { ?>
            <span>Property Management</span>
             <a href="user_login.php">login</a>
            <a href="user_register.php">register</a>
        <?php } else { ?>
           <span> welcome , <?php echo $u_name ?></span>
            <a href="./main/control.php?act=out">logout</a>
        <?php } ?>
        <a href="index.php">Home</a>
        <a href="list_property_page.php">Property</a>
        <a href="list_item_page.php">Item</a>
        <a href="list_client_page.php">Client</a>
    </div>
</div>

<div id="body">

<style>
    body{
        margin:80px 0 60px 0;
    }
    #head{
        border-bottom:1px solid #cccccc;
        width:100%;
        display: table;
        position:absolute;
        top:0px;
    }
    #head span{
        padding-left:100px;
        width:100px;
        height:60px;
        line-height:60px;
        text-decoration: none;
    }
    #head a{
        width:100px;
        height:60px;
        line-height:60px;
        padding-right:10px;
        text-decoration: none;
        float:right;
    }

    .title{
        padding-left: 108px;
    }
    .form-group{
        width:100%;
        margin:5px;
    }
    .form-group label{
        display: inline-block;
        width:200px;
        margin-right:3px;
        text-align: right;
    }

    .form-group input{
        width:290px!important;
        margin-right:3px;
    }
    .form-group button{
        width:150px!important;
        margin-right:3px;
        text-align: center;
        margin-left: 208px;
    }

     #foot{
        border-top:1px solid #CCCCCC;
        width:100%;
        height:50px;
        position:absolute;
        bottom:0;left:0
    }
    #foot p{
        text-align: center;
    }
    .table{
        margin-left: 100px;
        border-collapse: collapse;
        cellpadding:3px;
    }
</style>
