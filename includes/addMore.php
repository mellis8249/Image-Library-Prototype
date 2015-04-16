<?php
//Require classes
require_once 'classes/Db.class.php';
require_once 'classes/Shoppingbasket.class.php';
//Checks if $_GET[ImageID] is set
if(isset($_GET['ImageID'])){
    //Stores $_GET in variable $id
    $id = $_GET['ImageID'];
    //Create an instance of Db
    $db = new DB();
    //Create an instance of ShoppingBasket
    $cart = new ShoppingBasket($db);
    //Do not set a cookie
    $cart->SaveCookie(FALSE);
    //Calls Shoppingbasket AddMoreToBasket() method
    $cart->AddMoreToBasket($id, 1);
}
?>