<?php
require_once('./main/control.php');
$u_name = FALSE;
if (isset($_SESSION["NAME"])) {
    $u_name = FALSE == $_SESSION["NAME"] ? FALSE : $_SESSION["NAME"];
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="content-type" content="text/html;charset=utf-8"/>
    <meta name="viewport" content="width=device-width">
    <script src="./assets/jquery.min.js"></script>
    <script src="./assets/common.js"></script>
    <title><?php echo TCommon::$mainTitle; ?></title>
    <base href="./" />
    <link rel="stylesheet" href="./css/bootstrap.css" />
    <link rel="stylesheet" href="./css/flexslider.css" />
    <link rel="stylesheet" href="./css/font.css" />
    <link rel="stylesheet" href="./css/style_misc.css" />
    <link rel="stylesheet" href="./css/style_slider.css" />
    <link rel="stylesheet" href="./css/stylesheet.css" />
    <link rel="stylesheet" href="./css/mystyle.css" />
    <script src="./js/vendor/modernizr-2.6.1-respond-1.1.0.min.js"></script>
    <script src="./js/vendor/jquery-1.11.0.min.js"></script>
    <script src="./js/vendor/jquery.gmap3.min.js"></script>
    <script src="./js/plugins.js"></script>
    <script src="./js/main.js"></script>
</head>
<body>
<header>
<div id="top-header">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <div class="home-account">
                    <?php if ($u_name === FALSE) { ?>
                        <span>Property Management</span> |
                        <a href="user_login.php">Login</a> |
                        <a href="user_register.php">Register</a>
                    <?php } else { ?>
                    <span> Welcome, <?php echo $u_name ?></span> |
                    <a href="./main/control.php?act=out">Logout</a>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
</div>
<div id="main-header">
    <div class="container">
        <div class="row">
            <div class="col-md-3">
                <div class="logo">
                    <a href="./"><img src="./images/icons/icon-1.png" alt="Company Icon" ></a>
                </div>
            </div>
            <div class="col-md-6">
                <div class="main-menu">
                    <ul>
                        <li><a href="./index.php">Home</a></li>
                        <li><a href="./list_property_page.php">Property</a></li>
                        <li><a href="./list_item_page.php">Item</a></li>
                        <li><a href="./list_client_page.php">Client</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-md-3">
                <div class="search-box">
                    <form name="search_form" method="get" class="search_form">
                        <input id="search" type="text" />
                        <input type="submit" id="search-button" />
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</header>
<div id="body">
