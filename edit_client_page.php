<?php
$subTitle = "edit_client_page";
require_once('head.php');
$id = $_GET["id"];
$sql = "SELECT * FROM client WHERE clientId = '$id'";
$cl = TCommon::getOne($sql);
//print_r($cl);
?>

<form class="form-ajax-post"
      data-action="./main/control.php?act=edit_client"
      data-url="list_client_page.php">
    <h3 class="title">Edit <?php echo $cl['clientName']?>'s Profile </h3>
    <input style="display:none" value="<?php echo $id?>" name="id"/>
    <div class="form-group">
        <label>Client name:</label>
        <input name="clientName" type="text" value="<?php echo $cl['clientName']?>" class="form-control"/>
    </div>
    <div class="form-group">
        <label>Address 1:</label>
        <input name="clientAddress1" type="text" value="<?php echo $cl['clientAddress1']?>" class="form-control"/>
    </div>
    <div class="form-group">
        <label>Address 2:</label>
        <input name="clientAddress2" type="text" value="<?php echo $cl['clientAddress2']?>" class="form-control"/>
    </div>
    <div class="form-group">
        <label>City:</label>
        <input name="clientCity" type="text" value="<?php echo $cl['clientCity']?>" class="form-control"/>
    </div>
    <div class="form-group">
        <label>Province:</label>
        <input name="clientProv" type="text" value="<?php echo $cl['clientProv']?>" class="form-control"/>
    </div>
    <div class="form-group">
         <label>Postal:</label>
         <input name="clientPostal" type="text" value="<?php echo $cl['clientPostal']?>" class="form-control"/>
    </div>
    <div class="form-group">
        <label>Phone number 1:</label>
        <input name="clientPhone1" type="text" value="<?php echo $cl['clientPhone1']?>" class="form-control">
    </div>
    <div class="form-group">
        <label>Phone number 2:</label>
        <input name="clientPhone2" type="text" value="<?php echo $cl['clientPhone2']?>" class="form-control">
    </div>
    <div class="form-group">
        <label>Email: </label>
        <input name="clientEmail" type="text" value="<?php echo $cl['clientEmail']?>" class="form-control">
    </div>
    <div class="form-group">
        <label>Details: </label>
        <input name="clientDetails" type="text" value="<?php echo $cl['clientDetails']?>" class="form-control">
    </div>

    <div class="form-group tT010 ">
        <button class="form-ajax-btn" type="submit">Submit</button>
    </div>
    <div>
</form>

<?php require_once('foot.php'); ?>