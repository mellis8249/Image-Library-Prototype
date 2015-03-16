<?php
require_once 'includes/classes/Db.class.php';
require_once 'includes/classes/User.class.php';
//Create an instance of Db
$db = new DB();
//Create an instance of User
$user = new User($db);
//Calls user userLogin method
$user->userLogin();
?>
<!--Login form-->
<h2>Login Form</h2>
<form id="login" method="POST" action="">
	<?php $user->display_errors(); ?>
	<?php $user->display_info(); ?>
	<label for="username">Username:</label>
	<input type="text" id="username" name="username" placeholder="user" />
	<label for="password">Password:</label>
	<input type="password" id="password" name="password" placeholder="password" />
	<input id="button-login" type="submit" name="login" value="Log in">
</form>