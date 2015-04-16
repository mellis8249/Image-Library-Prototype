<?php
//Require classes
require_once 'classes/Db.class.php';
require_once 'classes/Image.class.php';
//Create an instance of Db
$db = new DB();
//Create an instance of Image
$Image = new Image($db);
//Calls Image deleteImage() method
$Image->deleteImage();
?>