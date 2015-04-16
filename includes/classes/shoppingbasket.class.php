<?php
/**
 * ShoppingBasket Class
 *
 * A simple shopping basket class used to add and delete items from a session based shopping cart
 * @package ShoppingBasket
 * @author Dave Nicholson <dave@davenicholson.co.uk>
 * @link http://davenicholson.co.uk
 * @copyright 2008
 * @version 0.1
 * @access public
 * 
 * Used by - Mark Ellis - c3374267
 * Project - Image Library 
 * Changes - Adapted from original version, added, changed and deleted methods and also changed original methods to suite needs.
 */
class ShoppingBasket {
    
    //Variables
    private $_db;
    public $cookieName = 'ckBasket';
    public $cookieExpire = 86400; // One day
    public $saveCookie = TRUE;

    //Class constructor 
    public
    function __construct(DB $db) {
        //Uses the Db.class
        $this->_db = $db;

        if (!isset($_SESSION['cart']) && (isset($_COOKIE[$this->cookieName]))) {
            $_SESSION['cart'] = unserialize(base64_decode($_COOKIE[$this->cookieName]));
            $_SESSION['cart'] = array();
        }
    }

    //Method to AddToBasket
    public
    function AddToBasket($id, $qty = 1) {

        if (isset($_SESSION['cart'][$id])) {
         if ($qty < 1){
           $_SESSION['cart'][$id] = $_SESSION['cart'][$id] + $qty;
        } 
        }
        else {
            $_SESSION['cart'][$id] = $qty;
        }
        $this->SetCookie();
        return true;
    }
    
    //Method to AddMoreToBasket (unused due to quantity being fixed to 1 for each item)
    public
    function AddMoreToBasket($id, $qty = 1) {
        if (isset($_GET['Add'])){
            if ($_GET['Add'] = 1){
                if (isset($_SESSION['cart'][$id])) {
                    $_SESSION['cart'][$id] = $_SESSION['cart'][$id] + $qty;
           
                } 
                else {
                    $_SESSION['cart'][$id] = $qty;
                }
            }
        }
    } 
    
    //Method to RemoveFromBasket
    public
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
                }
            }
        }
    }

    //Method to DeleteFromBasket
    public
    function DeleteFromBasket($id) {
        unset($_SESSION['cart'][$id]);
        if (empty($_SESSION['cart'])){
            unset($_SESSION['cart']);
        }
        $this->SetCookie();
        return true;
    }
    
    //Method for DisplayBasket
    public
    function DisplayBasket(){
        if(isset($_SESSION['cart'])){
         foreach($_SESSION['cart'] AS $key => $value) {
            $result = $this->_db->query("SELECT * FROM images WHERE ImageID = $key");
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
        
        echo '<a href="emptyCart.php"><img src = "assets/images/empty.png" id="icon" title="Empty Basket"</a>';
        echo '<a href="checkout.php"><img src = "assets/images/reviewCheckout.png" id="icon" title="Review Basket"</a>';
        }
    }
    
    //Method for ReviewBasket
    public
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
            echo "<th> Resolution </th>";
            echo "<th> Print Size (200 DPI) </th>";
            echo "<th> Print Size (300 DPI) </th>";
            echo "<th> Price </th>";
            echo "<th> Total </th>";
            echo "<th> Remove</th>";
            //echo "<th> Add</th>";
            echo "</tr>";
            echo '<form class="pure-form" method="post" action="paypalSend.php">';
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
                            echo $row['DPIWidth200'].' X '.$row['DPIHeight200'];
                            echo "</td>";
                            echo "<td>";
                            echo $row['DPIWidth300'].' X '.$row['DPIHeight300'];
                            echo "</td>";
                            echo "<td>";
                            echo "&pound;".$row['Price'];
                            echo "</td>";
                            echo "<td>";
                            echo "&pound;".$total;
                            echo "</td>";
                            echo "<td>";
                            echo '<a href="checkout.php?Remove=1&ImageID='.$row['ImageID'].'"><img src = "assets/images/remove.png" id="icon" title="Remove"</a>';
                            echo "</td>";
                           // echo "<td>";
                         //   echo '<a href="checkout.php?Add=1&ImageID='.$row['ImageID'].'"><img src = "assets/images/add.png" id="icon"</a>';
                          //  echo "</td>";
                            echo "</tr>";
                            echo '<input type="hidden" name="item_name['.$cart_items.']" value="'.$row['ImageName'].'" />';
                            echo '<input type="hidden" name="item_code['.$cart_items.']" value="'.$key.'" />';
                            echo '<input type="hidden" name="item_desc['.$cart_items.']" value="'.$row['ImageDescription'].'" />';
                            echo '<input type="hidden" name="item_qty['.$cart_items.']" value="'.$value.'" />';
                        }
                    }
                    
            echo "</table>";
            $this->TotalPrice();
            echo '<input type="hidden" name="total['.$cart_items.']" value="'.$_SESSION['testtotal'].'" />';
            echo ' <input type="image" src="https://www.paypal.com/en_AU/i/btn/btn_buynow_LG.gif" border="0" width="100" height="50" name="submit" align="right" title="PayPal - The safer, easier way to pay online.">';
            echo '</form>';
        }
    }
    
    //Method for TotalPrice
    public
    function TotalPrice(){
        if (isset($_SESSION['cart'])){
            $sum = 0;
            $totalup = array();
                foreach($_SESSION['cart'] AS $key => $value) {
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
                echo '<a href="emptyCart.php"><img src = "assets/images/empty.png" id="icon" title="Empty Basket"</a>';
                echo "</td>";
                echo "</tr>";
                echo "</table>";       
        }
    }

    
    //Method for EmptyBasket()
    public
    function EmptyBasket() {
        unset($_SESSION['cart']);
        $this->SetCookie();
        return true;
    }

   //Method to SetCookie (unused but can be turned on)
   public
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
    
    //Method to SaveCookie (unused but can turned on)
    public
    function SaveCookie($bool = TRUE) {
		$this->saveCookie = $bool;
		return true;
	}

}

?>