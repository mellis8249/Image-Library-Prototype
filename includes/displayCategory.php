<h2> Categories </h2>
<?php
//Create an instance of Db
$db = new DB();
//Create an instance of Blog
$Image = new Image($db);
//Calls Blog displayBlog() method
$Image->displayCategory();

?>