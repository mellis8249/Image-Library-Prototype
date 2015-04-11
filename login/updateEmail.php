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
<!--Used with Pure CSS for forms/buttons-->
<style>
 .button-updateEmail,
        .button-secondary {
            color: white;
            text-shadow: 0 0px 0px rgba(0, 0, 0, 0.2);
        }

        .button-updateEmail {
            background: #23353e; /* this is a green */
        }

</style>
<!--Updaye email form-->
<h2>Update Email</h2>
<form class="pure-form" method="POST" action="" id="updateEmail">
	<fieldset>
	<?php $user->display_info(); ?>
	<?php $user->display_errors(); ?>
	<input type="hidden" name="old_email" />
	<label for="email">E-mail:</label>
	<input type="email" id="email" name="email" placeholder="email" />
	<button id="button-updateEmail" type="submit" name="updateEmail" value="update" class="button-updateEmail pure-button">Update Email</button>
</fieldset>
</form>