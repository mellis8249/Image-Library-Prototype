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
<!--Used with Pure CSS for forms/buttons-->
<style>
 .button-addStudent,
        .button-secondary {
            color: white;
            text-shadow: 0 0px 0px rgba(0, 0, 0, 0.2);
        }

        .button-addStudent {
            background: #23353e; /* this is a green */
        }

</style>
<!--Add Student Form-->
<h2>Add Student</h2>
<form class="pure-form" action="" method="POST" id="addStudent">
	<fieldset>
	<?php $user->display_errors(); ?>
	<?php $user->display_info(); ?>
	<label for="email">E-mail:</label>
	<input type="email" id="email" name="email" placeholder="email" />
	<label for="username">Username:</label>
	<input type="text" id="username" name="username" placeholder="username" />
	<button id="button-addStudent" type="submit" name="addStudent" value="Add Student" class="button-addStudent pure-button">Add Student</button>
</fieldset>
</form>