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
	<input type="email" id="email" name="email" placeholder="email" required />
	<label for="username">Username:</label>
	<input type="text" id="username" name="username" placeholder="username" pattern=".{5,20}" required title="5 to 20 characters" />
	<label for="password">Password:</label>
	<input type="password" id="password" name="password" placeholder="password" pattern=".{4,12}" required title="4 to 12 characters" />
	<label for="confirm">Password:</label>
	<input type="password" id="confirm" name="confirm" placeholder="repeat password"  pattern=".{4,10}" required title ="4 to 10 characters" />
	<label for="username">Firstname:</label>
	<input type="text" id="firstname" name="firstname" placeholder="firstname" required />
	<label for="username">Lastname:</label>
	<input type="text" id="lastname" name="lastname" placeholder="lastname" required />
	<button id="button-register" type="submit" name="register" value="Register" class="button-register pure-button">Register</button>
</fieldset>
</form>