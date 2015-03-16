<?php
require_once 'includes/classes/Db.class.php';
require_once 'includes/classes/User.class.php';
//Create an instance of Db
$db = new Db();
//Create an instance of User
$user = new User($db);
//Calls user logout() method
$user->logout();
?>