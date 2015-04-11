<?php
require_once 'classes/Db.class.php';
require_once 'classes/Image.class.php';
//Create an instance of Db
$db = new DB();
//Create an instance of Blog
$Image = new Image($db);
//Calls Blog displayBlog() method
$Image->deleteImage();
?>