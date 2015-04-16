<h2> Basket </h2>
<?php
//Require classes
require_once 'classes/Db.class.php';
require_once 'classes/Shoppingbasket.class.php';
//Checks if $_SESSION['cart'] is set
if (isset($_SESSION['cart'])){
    //Create an instance of Db
    $db = new DB();
    //Create an instance of ShoppingBasket
    $cart = new ShoppingBasket($db);
    //Calls ShoppingBasket DisplayBasket() method
    $cart->DisplayBasket();
}
else {
    //Display
	echo 'Basket Empty';
}
?>