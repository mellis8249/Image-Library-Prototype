<?php
require_once 'classes/Db.class.php';
require_once 'classes/shoppingbasket.class.php';
if (isset($_SESSION['cart'])){
$db = new DB();
$cart = new ShoppingBasket($db);
$cart->reviewBasket();
//unset($_SESSION['cart']);
}
else {
	echo 'Basket Empty';
}
?>