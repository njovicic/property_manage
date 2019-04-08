<?php
$subTitle="login";
require_once('head.php');
?>
<!-- welcome message -->
<div id="welcome">
    <div class="form_container">
        <div class="row">
            <div class="col-md-12">
                <div id="heading">
                    <h2>Welcome to Property Management for Freure Homes</h2>
                    <img src="/images/icons/under-heading.png" alt="" >
                </div>
            </div>
        </div>
    </div>
</div>
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