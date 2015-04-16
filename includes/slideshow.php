<?php
//Create an instance of Db
$db = new Db();
//$result stores query
$result = $db->query("SELECT * FROM thumbnails");
//Foreach to get results from $result as $row
foreach ($result as $row) {
	$address = $row['ImageJPEG'];
	$thumbnail = substr($address, 55,80);
	echo '<li>';
	echo '<img src="' . $thumbnail . '" alt="ImageJPEG" />';
	echo '</li>';
}
?>
