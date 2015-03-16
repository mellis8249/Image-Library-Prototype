<h2> You selected: </h2>
<?php  

$selected = $_GET['ImageID'];

$db = new Db();

$result = $db->query("SELECT * FROM images WHERE ImageID = $selected", null, PDO::FETCH_ASSOC);

foreach ($result as $row) {
    	$address = $row['ImageJPEG'];
		$address2= $row['ImagePNG'];
		$address3= $row['Original'];
		$thumbnail = substr($address, 52,80);
		$watermark = substr($address2, 52, 80);
		$original = substr($address3, 52, 80);

        echo "<table>";
        echo "<tr>";
        echo "<td>";
        echo '<a href='. $watermark. '><img src="' . $watermark. '" width="250" height="250" alt="ImageWatermarked" ></a>'; 
        echo "</td>";
        echo "</tr>";
        echo "</table>";

    }
?>