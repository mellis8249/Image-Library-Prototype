<?php
require_once 'includes/classes/Db.class.php';
require_once 'includes/classes/User.class.php';
//Create an instance of Db
$db = new DB();
//Create an instance of User
$user = new User($db);
//Stores $_SESSION variable in $username
$username = $_SESSION['username'];
//Calls user updateEmail() method
$user->updateEmail($username);
?>
<!--Updaye email form-->
<h2>Update Email</h2>
<form method="POST" action="" id="updateEmail">
	<?php $user->display_info(); ?>
	<?php $user->display_errors(); ?>
	<input type="hidden" name="old_email" />
	<label for="email">E-mail:</label>
	<input type="email" id="email" name="email" placeholder="email" />
	<input type="submit" id="button-updateEmail" name="updateEmail" value="update">
</form>