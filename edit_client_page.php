<?php
$subTitle = "edit_client_page";
require_once('head.php');
// print_r($_SESSION);
?>
<?php if($u_name) {?>
<form class="form-ajax-post"
      data-action="./main/control.php?act=edit_client"
      data-url="edit_client_page.php">
    <h3 class="title">Edit <?php $clientName ?> Profile </h3>
    <div class="form-group">
        <label>Client name:</label>
        <input name="clientName" type="text" class="form-control"/>
    </div>
    <div class="form-group">
        <label>Address 1:</label>
        <input name="clientAddress1" type="text" class="form-control"/>
    </div>
    <div class="form-group">
        <label>Address 2:</label>
        <input name="clientAddress2" type="text" class="form-control"/>
    </div>
    <div class="form-group">
        <label>City:</label>
        <input name="clientCity" type="text" class="form-control"/>
    </div>
    <div class="form-group">
        <label>Province:</label>
        <input name="clientProv" type="text" class="form-control"/>
    </div>
    <div class="form-group">
         <label>Postal:</label>
         <input name="clientPostal" type="text" class="form-control"/>
    </div>
    <div class="form-group">
        <label>Phone number 1:</label>
        <input name="clientPhone1" type="text" class="form-control">
    </div>
    <div class="form-group">
        <label>Phone number 2:</label>
        <input name="clientPhone2" type="text" class="form-control">
    </div>
    <div class="form-group">
        <label>Email: </label>
        <input name="clientEmail" type="text" class="form-control">
    </div>
    <div class="form-group">
        <label>Details: </label>
        <input name="clientDetails" type="text" class="form-control">
    </div>

    <div class="form-group tT010 ">
        <button class="form-ajax-btn" type="submit">Save</button>
    </div>
    <div>
</form>
<hr>

<?php }else{?>
<h3 class="title">Please login/register first</h3>
<?php }?>

<?php require_once('foot.php'); ?>