<?php
/*
SHOPPING BASKET CLASS

USAGE:
------

$cart = new ShoppingBasket; Initialize class
$cart->SaveCookie(TRUE); Set option to save items ina cookie or not. Cookie valid for 1 day.
$cart->AddToBasket('ITEM_ID', QTY); Add an item to the basket 
$cart->RemoveFromBasket('ITEM_ID', QTY); Remove item form basket
$cart->DeleteFromBasket('ITEM_ID'); Removes all of item selected
$cart->EmptyBasket('ITEM_ID' QTY); Clear the basket
$cart->GetBasketQty(); Get qty of items in the basket
$cart->GetBasket(); Returns basket items as an array ITEM_ID => QTY

*/

/**
 * ShoppingBasket
 *
 * A simple shopping basket class used to add and delete items from a session based shopping cart
 * @package ShoppingBasket
 * @author Dave Nicholson <dave@davenicholson.co.uk>
 * @link http://davenicholson.co.uk
 * @copyright 2008
 * @version 0.1
 * @access public
 */
class ShoppingBasket {

    private $_db;
    public $cookieName = 'ckBasket';
    public $cookieExpire = 86400; // One day
    public $saveCookie = TRUE;

    /**
     * ShoppingBasket::__construct()
     *
     * Construct function. Parses cookie if set.
     * @return
     */
    function __construct(DB $db) {
             $this->_db = $db;
       // session_start();

        if (!isset($_SESSION['cart']) && (isset($_COOKIE[$this->cookieName]))) {
            $_SESSION['cart'] = unserialize(base64_decode($_COOKIE[$this->cookieName]));
            $_SESSION['cart'] = array();
          //  $_SESSION['cart']['test'] = 'hi';
        }

    }

    /**
     * ShoppingBasket::AddToBasket()
     *
     * Adds item to basket. If $id already exists in array then qty updated
     * @param mixed $id - ID of item
     * @param integer $qty - Qty of items to be added to cart
     * @return bool
     */
    function AddToBasket($id, $qty = 1) {

        if (isset($_SESSION['cart'][$id])) {
           $_SESSION['cart'][$id] = $_SESSION['cart'][$id] + $qty;
           
        } else {
            $_SESSION['cart'][$id] = $qty;
        }
        $this->SetCookie();
        return true;
    }
    
   function AddMoreToBasket($id, $qty = 1) {
        if (isset($_GET['Add'])){
        if ($_GET['Add'] = 1){
        if (isset($_SESSION['cart'][$id])) {
           $_SESSION['cart'][$id] = $_SESSION['cart'][$id] + $qty;
           
        } else {
            $_SESSION['cart'][$id] = $qty;
        }

        if($_SESSION['cart'][$id] == 1){
           // echo '<meta http-equiv="refresh" content= "0;URL=?r=1" />';
        }
        $this->SetCookie();
        return true;
    }
}
}

    /**
     * ShoppingBasket::RemoveFromBasket()
     *
     * Removes item from basket. If final qty less than 1 then item deleted.
     * @param mixed $id - Id of item
     * @param integer $qty - Qty of items to be removed to cart
     * @see DeleteFromBasket()
     * @return bool
     */
    /*function RemoveFromBasket($id, $qty = 1) {

        if (isset($_SESSION['cart'][$id])) {
            $_SESSION['cart'][$id] = $_SESSION['cart'][$id] - $qty;
        }

        if ($_SESSION['cart'][$id] <= 0) {
            $this->DeleteFromBasket($id);
        }
        
		$this->SetCookie();
        return true;
     //   exit();
    }*/
    
    function RemoveFromBasket($id, $qty = 1) {

        if (isset($_SESSION['cart'][$id])) {
        if (isset($_GET['Remove'])){
        if ($_GET['Remove'] = 1){
            $_SESSION['cart'][$id] = $_SESSION['cart'][$id] - $qty;
        
        if ($_SESSION['cart'][$id] <= 0) {
            $this->DeleteFromBasket($id);
        }
		$this->SetCookie();
        return true;
     //   exit();
    }
    }
    }
}

    /**
     * ShoppingBasket::DeleteFromBasket()
     *
     * Completely removes item from basket
     * @param mixed $id
     * @return bool
     */
 /*   function DeleteFromBasket($id) {
        unset($_SESSION['cart'][$id]);
        $this->SetCookie();
        return true;
      //  exit();
    } */
    
    
        function DeleteFromBasket($id) {
        unset($_SESSION['cart'][$id]);
        if (empty($_SESSION['cart'])){
            unset($_SESSION['cart']);
        }
        $this->SetCookie();
        return true;
       // exit();
    }

    /**
     * ShoppingBasket::GetBasket()
     *
     * Returns the basket session as an array of item => qty
     * @return array $itemArray
     */
    function GetBasket() {
        if (isset($_SESSION['cart'])) {
            foreach ($_SESSION['cart'] as $k => $v) {
              $itemArray[$k] = $v;
            }
            return $itemArray;
            exit();
        } else {
            return false;
        }
    }

    function DisplayBasket2(){
        if(isset($_SESSION['cart'])){
         foreach($_SESSION['cart'] AS $key => $value) {
            $result = $this->_db->query("SELECT * FROM images WHERE ImageID = $key");
            // print_r($result);  
           // echo "</br>"; 
          //  echo "ImageID = $key";
           // echo "</br>";
           // echo "Quantity = $value";
           // echo "</br>";
            foreach($result as $row) {
            echo "<ul>";
            echo "<li>";
            echo "Name: ".$row['ImageName'];
            echo "</li>";
            echo "<li>";
            echo "Quantity: ".$value;
            echo "</li>";
            echo "<li>";
            echo "Author: ".$row['Author'];
            echo "</li>";
            echo "<li>";
            echo "Price: &pound;".$row['Price'];
            echo "</li>";
            echo "</ul>";
             }    
         }
        

        
        echo '<a href="emptyCart.php"><img src = "assets/images/empty.png" id="icon"</a>';
        echo '<a href="checkout.php"><img src = "assets/images/reviewCheckout.png" id="icon"</a>';
  
        //echo '<a href="checkout.php"<img src = "assets/images/reviewCheckout.png"</a>';
    }
}

     function ReviewBasket(){
        if(isset($_SESSION['cart'])){
            echo "<table>";
            echo "<tr>";
            echo "<th> ImageID </th>";
            echo "<th> Quantity </th>";
            echo "<th> Name </th>";
            echo "<th> Description </th>";
            echo "<th> Author </th>";
            echo "<th> Category </th>";
            echo "<th> Size </th>";
            echo "<th> Price </th>";
            echo "<th> Total </th>";
            echo "<th> Remove</th>";
            echo "<th> Add</th>";
            echo "</tr>";
        echo '<form class="pure-form" method="post" action="process.php">';
        foreach($_SESSION['cart'] AS $key => $value) {
        $result = $this->_db->query("SELECT * FROM images WHERE ImageID = $key");
        foreach($result as $row) {
            $total = $row['Price'] * $value;
            $_SESSION['total'] = $total;
            echo "<tbody>";
            echo "<tr>";
            echo "<td>";
            echo $key;
            echo "</td>";
            echo "<td>";
            echo $value;
            echo "</td>";
            echo "<td>";
            echo $row['ImageName'];
            echo "</td>";
            echo "<td>";
            echo $row['ImageDescription'];
            echo "</td>";
            echo "<td>";
            echo $row['Author'];
            echo "</td>";
            echo "<td>";
            echo $row['Category'];
            echo "</td>";
            echo "<td>";
            echo $row['ImageWidth'].' X '.$row['ImageHeight'];
            echo "</td>";
            echo "<td>";
            echo "&pound;".$row['Price'];
            echo "</td>";
            echo "<td>";
            echo "&pound;".$total;
            echo "</td>";
            echo "<td>";
            echo '<a href="checkout.php?Remove=1&ImageID='.$row['ImageID'].'"><img src = "assets/images/remove.png" id="icon"</a>';
            echo "</td>";
            echo "<td>";
            echo '<a href="checkout.php?Add=1&ImageID='.$row['ImageID'].'"><img src = "assets/images/add.png" id="icon"</a>';
            echo "</td>";
            echo "</tr>";
            echo '<input type="hidden" name="item_name['.$cart_items.']" value="'.$row['ImageName'].'" />';
            echo '<input type="hidden" name="item_code['.$cart_items.']" value="'.$key.'" />';
            echo '<input type="hidden" name="item_desc['.$cart_items.']" value="'.$row['ImageDescription'].'" />';
            echo '<input type="hidden" name="item_qty['.$cart_items.']" value="'.$value.'" />';
        //Table etc etc
        }
        }
        echo "</table>";

        $this->TotalPrice();
        
        echo '<input type="hidden" name="total['.$cart_items.']" value="'.$_SESSION['testtotal'].'" />';
        
        echo '<input type="submit" value="Pay Now" />';
        echo '</form>';

        //CHECKOUT GOES HERE
        }
    }
    
    function TotalPrice(){
        if (isset($_SESSION['cart'])){
            $sum = 0;
            $totalup = array();
            foreach($_SESSION['cart'] AS $key => $value) {

                //$result = $this->_db->query("SELECT SUM(Price) as value_sum FROM Images WHERE ImageID=$key", null, PDO::FETCH_ASSOC);
                $result = $this->_db->query("SELECT SUM(Price) as total FROM images WHERE ImageID=$key");
                foreach ($result as $row){
                   $totalup[] = $row['total'] * $value;
                   $_SESSION['grandTotal'][] = $totalup;
                }
            } 
                foreach($_SESSION['grandTotal'] as $grandTotal){
                    $grandTotal = array_sum($totalup);
                    $_SESSION['testtotal'] = $grandTotal;
                }

                echo "<table align='right'>";
                echo "<tr>";
                echo "<th>Grand Total</th>";
                echo "<th>Empty</th>";
                echo "</tr>";
                echo "<tr>";
                echo "<td>";
                echo "&pound;".$grandTotal;
                echo "</td>";
                echo "<td>";
                echo '<a href="emptyCart.php"><img src = "assets/images/empty.png" id="icon"</a>';
                echo "</td>";
                echo "</tr>";
                echo "</table>";       
        }
    }
    /**
     * ShoppingBasket::UpdateBasket()
     *
     * Updates a basket item with a specific qty
     * @param mixed $id - ID of item
     * @param mixed $qty - Qty of items in basket
     * @return bool
     */
    function UpdateBasket($id, $qty) {

        $qty = ($qty == '') ? 0 : $qty;

        if (isset($_SESSION['cart'][$id])) {
            $_SESSION['cart'][$id] = $qty;

            if ($_SESSION['cart'][$id] <= 0) {
                $this->DeleteItem($id);
                return true;
                exit();
            }
			$this->SetCookie();
            return true;
            exit();

        } else {
            return false;
        }

    }
    /**
     * ShoppingBasket::GetBasketQty()
     *
     * Returns the total amount of items in the basket
     * @return int quantity of items in basket
     */
    function GetBasketQty() {
        if (isset($_SESSION['cart'])) {
            $qty = 0;
            foreach ($_SESSION['cart'] as $item) {
                $qty = $qty + $item;
            }
            return $qty;
        } else {
            return 0;
        }
    }
    /**
     * ShoppingBasket::EmptyBasket()
     *
     * Completely removes the basket session
     * @return
     */
    function EmptyBasket() {
        unset($_SESSION['cart']);
        $this->SetCookie();
        return true;
    }
  /**
   * ShoppingBasket::SetCookie()
   *
   * Creates cookie of basket items
   * @return bool
   */
    function SetCookie() {
        if ($this->saveCookie) {
            if (isset($_SESSION['cart'])){
            $string = base64_encode(serialize($_SESSION['cart']));
            setcookie($this->cookieName, $string, time() + $this->cookieExpire, '/');
            return true;
        }
    }
        return false;
    }
    
  /**
   * ShoppingBasket::SaveCookie()
   *
   * Sets save cookie option
   * @param bool $bool
   * @return bool
   */
    function SaveCookie($bool = TRUE) {
		$this->saveCookie = $bool;
		return true;
	}

}

?>