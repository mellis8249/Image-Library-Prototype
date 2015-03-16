<?php
require_once 'includes/classes/Db.class.php';
require_once 'includes/classes/User.class.php';
//Create an instance of Db
$db = new DB();
//Create an instance of User
$user = new User($db);
//Calls user addStudent() method
$user->addStudent();
?>
<!--Add Student Form-->
<h2>Add Student</h2>
<form action="" method="POST" id="addStudent">
	<?php $user->display_errors(); ?>
	<?php $user->display_info(); ?>
	<label for="email">E-mail:</label>
	<input type="email" id="email" name="email" placeholder="email" />
	<label for="username">Username:</label>
	<input type="text" id="username" name="username" placeholder="username" />
	<input id="button-addStudent" type="submit" name="addStudent" value="Add Student">
</form>