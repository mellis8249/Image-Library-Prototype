<?php
require_once 'classes/Db.class.php';
require_once 'classes/Shoppingbasket.class.php';
if (isset($_SESSION['cart'])){
$db = new DB();
$cart = new ShoppingBasket($db);
$cart->reviewBasket();
}
else {
	echo 'Basket Empty';
}
?>