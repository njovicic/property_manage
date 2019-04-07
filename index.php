<?php
$subTitle = "login";
require_once('head.php');
?>

<?php if($u_name) {?>
<form class="form-ajax-post"
data-action="./main/control.php?act=create_appointment"
    data-url="index.php">
    <h3 class="title">Create New Appointment</h3>
	<div class="form-group">
		<label>Client name:</label>
		<input name="clientName" type="text" class="form-control"/>
	</div>
	<div class="form-group">
		<label>Date and Time:</label>
		<input name="apptDate" type="text" placeholder="YYYY-MM-DD HH:MM:SS" data-clear-btn="true" class="form-control"/>
	</div>
	<div class="form-group ">
		<button class="form-ajax-btn " type="submit">Submit</button>
	</div>
</form>

    <hr>
    <h3 class="title">My Appointment list</h3>

    <?php $arr = list_appointments(); ?>
    <table class="table" border="2" cellpadding="5" cellspacing="3">

        <thead>
        <tr>
            <td>Client name</td>
            <td>Appointment time</td>
            <td></td>
            <td></td>
        </tr>
        </thead>
        <tbody>

        <?php foreach($arr as $k => $v){ ?>
            <tr>
                <td><?php echo $v["clientName"] ;?></td>
                <td><?php echo $v["apptDate"] ;?></td>
                <td><a href="./edit_appointment_page.php?id=<?php echo $v['apptId']?>">Edit</a></td>
                <td><a href="./main/control.php?act=del_appointment&apptDate=<?php echo $v["apptDate"]?>">Delete</a></td>
            </tr>
        <?php  } ?>
        </tbody>
    </table>
<?php }else{?>
    <h3 class="title">Please login/register first</h3>
<?php }?>

<?php require_once('foot.php'); ?>