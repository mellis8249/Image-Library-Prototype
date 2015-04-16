<?php
if(isset($_GET['ImageID'])){
$id = $_GET['ImageID'];
$db = new DB();
$cart->SaveCookie(FALSE);
$cart->RemoveFromBasket($id, 1);
}
?>