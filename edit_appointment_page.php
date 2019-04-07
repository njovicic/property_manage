<?php
$subTitle = "edit_appointment_page";
require_once('head.php');
$id = $_GET["id"];
$sql = "SELECT a.* ,c.clientName FROM appointment a left join client c ON a.Client_clientId = c.clientId where a.apptId = '$id'";
$app = TCommon::getOne($sql);
?>


<form class="form-ajax-post"
data-action="./main/control.php?act=edit_appointment"
    data-url="index.php">
    <h3 class="title">Edit Appointment</h3>
    <input style="display:none" value="<?php echo $id?>" name="id" />
	<div class="form-group">
		<label>Client name:</label>
		<input name="clientName" type="text" value="<?php echo $app['clientName']?>" class="form-control"/>
	</div>
	<div class="form-group">
		<label>Date and Time:</label>
		<input name="apptDate" type="text" value="<?php echo $app['apptDate']?>" placeholder="YYYY-MM-DD HH:MM:SS" data-clear-btn="true" class="form-control"/>
	</div>
	<div class="form-group ">
		<button class="form-ajax-btn " type="submit">Submit</button>
	</div>
</form>



<?php require_once('foot.php'); ?>