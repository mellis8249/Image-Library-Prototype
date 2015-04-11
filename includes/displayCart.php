<h2> Basket </h2>
<?php
if (isset($_SESSION['cart'])){
$db = new DB();
$cart = new ShoppingBasket($db);
$cart->DisplayBasket2();
}
else {
	echo 'Basket Empty';
}
?>