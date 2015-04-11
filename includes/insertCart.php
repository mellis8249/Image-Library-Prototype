<?php
require_once 'classes/Db.class.php';
require_once 'classes/shoppingbasket.class.php';
if(isset($_GET['ImageID'])){
$id = $_GET['ImageID'];
$db = new DB();
$cart = new ShoppingBasket($db);
$cart->SaveCookie(FALSE);
//$cart->AddToBasket($id, 1);
$cart->AddToBasket($id, 1);
}
?>