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
<!--Used with Pure CSS for forms/buttons-->
<style>
 .button-login,
        .button-secondary {
            color: white;
            text-shadow: 0 0px 0px rgba(0, 0, 0, 0.2);
        }

        .button-login {
            background: #23353e; /* this is a green */
        }

</style>
<!--Login form-->
<h2>Login Form</h2>
<form class="pure-form" id="login" method="POST" action="">
	<fieldset>
	<?php $user->display_errors(); ?>
	<?php $user->display_info(); ?>
	<label for="username">Username:</label>
	<input type="text" id="username" name="username" placeholder="username" />
	<label for="password">Password:</label>
	<input type="password" id="password" name="password" placeholder="password" />
	<button id="button-login" type="submit" name="login" value="Log in" class="button-login pure-button">Login</button>
	</fieldset>
</form>