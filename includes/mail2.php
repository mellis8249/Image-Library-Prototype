<?php

$db = new Db();

$itemstogo = $_SESSION['paypal_products'];
$firstname = "test";
$lastname = "frankie";

foreach($itemstogo['items'] as $key=>$p_item){
    $id = $p_item['itm_code'];
    
    $result = $db->query("SELECT Original FROM images WHERE ImageID = $id", null, PDO::FETCH_ASSOC);
    
    foreach ($result as $row){
        $address = $row['ImageJPEG'];
        $address2= $row['ImagePNG'];
        $address3= $row['Original'];
        $thumbnail = substr($address, 52,80);
        $watermark = substr($address2, 52, 80);
        $original = substr($address3, 52, 80);
    }
    
        $from = "m.ellis@valadan.co.uk";
        $to = "m.ellis8249@student.leedsbeckett.ac.uk";
        $subject = "Image request";
        $subject2 = "Copy of Image request";
        $message1 = $firstname . " " . $lastname . "\n\n" . "Thank you for selecting the following image:" . "\n\n" .  "www.valadan.co.uk/prototype/$original";
        $message2 = $firstname . " " . $lastname . "\n\n" . "Selected the following image:" . "\n\n" .  "www.valadan.co.uk/prototype/$original";
        $headers = "From:" . $to;
        $headers = "From:" . $from;
        
        mail($to, $subject, $message1, $headers);
        mail($from, $subject2, $message2, $headers2);

}
        echo "Mail Sent. Thank you " . $firstname . ", check your email for the Original image."; 
        
        unset($_SESSION['cart']);
?>