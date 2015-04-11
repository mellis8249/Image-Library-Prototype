<?php
require_once 'includes/classes/Db.class.php';
require_once 'includes/classes/shoppingbasket.class.php';
require_once 'config/init.php';

$db = new DB();
$cart = new ShoppingBasket($db);
if (isset($_SESSION['cart'])){
unset($_SESSION['cart']);
header("Location: images.php");
}

?>