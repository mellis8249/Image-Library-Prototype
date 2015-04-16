<h2> Details </h2>
<?php
//Create an instance of Db
$db = new DB();
//Create an instance of Image
$Image = new Image($db);
//Calls Image pickedImageDetails() method
$Image->pickedImageDetails();
?>