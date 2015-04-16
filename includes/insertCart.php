<?php
//Require classes
require_once 'classes/Db.class.php';
require_once 'classes/Shoppingbasket.class.php';
//Checks if $_GET['ImageID'] is set
if(isset($_GET['ImageID'])){
    //Stores $_GET in $id
    $id = $_GET['ImageID'];
    //Create an instance of Db
    $db = new DB();
    //Create an instance of ShoppingBasket
    $cart = new ShoppingBasket($db);
    //Do not save a cookie
    $cart->SaveCookie(FALSE);
    //Calls the ShoppingBasket AddToBasket() method
    $cart->AddToBasket($id, 1);
}
?>