<?php
require_once 'includes/classes/Db.class.php';
require_once 'includes/classes/User.class.php';
//Create an instance of Db
$db = new DB();
//Create an instance of User
$user = new User($db);
//Calls user registerUser() method
$user->registerUser();
?>
<!--Register form-->
<h2>Register Form</h2>
<form action="" method="POST" id="registerUser">
	<?php  $user->display_errors(); ?>
	<?php $user->display_info(); ?>
	<label for="email">E-mail:</label>
	<input type="email" id="email" name="email" placeholder="email" />
	<label for="username">Username:</label>
	<input type="text" id="username" name="username" placeholder="username" />
	<label for="password">Password:</label>
	<input type="password" id="password" name="password" placeholder="password" />
	<label for="confirm">Password:</label>
	<input type="password" id="confirm" name="confirm" placeholder="repeat password" />
	<input id="button-register" type="submit" name="register" value="Register">
</form>