<?php
$subTitle="login";
require_once('head.php');
?>

<form id="userLogin" class="form-ajax-post"
data-action="./main/control.php?act=user_login"
    data-url="index.php">
	<div class="form-group">
		<label>Username:</label>
		<input name="name" type="text" class="form-control"/>
	</div>
	<div class="form-group">
		<label>Password:</label>
		<input name="pwd" type="password" class="form-control"/>
	</div>
	<div class="form-group ">
		<button class="form-ajax-btn " type="submit">Login</button>
	</div>
</form>

<?php require_once('foot.php'); ?>