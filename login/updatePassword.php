<?php
require_once 'includes/classes/Db.class.php';
require_once 'includes/classes/User.class.php';
//Create an instance of Db
$db = new DB();
//Create an instance of User
$user = new User($db);
//Stores $_SESSION variable in $username
$username = $_SESSION['username'];
//Calls user updatePassword() method
$user->updatePassword($username);
?>
<!--Update password form-->
<h2>Update Password</h2>
<form method="POST" action="" id="updatePassword">
	<?php $user->display_info(); ?>
	<?php $user->display_errors(); ?>
	<label for="password">Old password:</label>
	<input type="password" id="password" name="password" placeholder="old password" />
	<label for="newpassword1">New password:</label>
	<input type="password" id="newpassword1" name="newpassword1" placeholder="new password" />
	<label for="newpassword2">New password, again:</label>
	<input type="password" id="newpassword2" name="newpassword2" placeholder="new password, again" />
	<input type="submit" id="button-updatePassword" name="updatePassword" value="update">
</form>