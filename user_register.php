<?php
$subTitle="registration";
require_once('head.php');
?>
<form class="form-ajax-post"
    data-action="./main/control.php?act=user_register"
    data-url="user_login.php">
	<div class="form-group">
		<label>username:</label>
		<input name="name" type="text" class="form-control"/>
	</div>
	<div class="form-group">
		<label>password:</label>
		<input name="pwd" type="password" class="form-control"/>
	</div>
	<div class="form-group">
		<label>password:</label>
		<input name="pwd_a" type="password" class="form-control"/>
	</div>
    <div class="form-group">
        <label>tel-phone:</label>
        <input name="tel" type="text" class="form-control"/>
    </div>
    <div class="form-group">
        <label>email:</label>
        <input name="email" type="text" class="form-control"/>
    </div>
	<div class="form-group tT010 ">
		<button class="form-ajax-btn" type="submit">Register</button>
	</div>
</form>



<?php require_once('foot.php'); ?>