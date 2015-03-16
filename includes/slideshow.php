<?php
	$db = new Db();
	$result = $db->query("SELECT * FROM thumbnails");
	foreach ($result as $row) {
		$address = $row['ImageJPEG'];
		$thumbnail = substr($address, 52,80);
		echo '<li>';
		echo '<img src="' . $thumbnail . '" alt="ImageJPEG" />';
		echo '</li>';
	}
	?>
