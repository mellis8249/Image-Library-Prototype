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
<style>
 .button-register,
        .button-secondary {
            color: white;
            text-shadow: 0 0px 0px rgba(0, 0, 0, 0.2);
        }

        .button-register {
            background: #23353e; /* this is a green */
        }

</style>
<!--Register form-->
<h2>Register Form</h2>
<form class="pure-form" action="" method="POST" id="registerUser">
	<fieldset>
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
	<button id="button-register" type="submit" name="register" value="Register" class="button-register pure-button">Register</button>
</fieldset>
</form>