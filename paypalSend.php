<?php
//Require classes
require("config/init.php");
require("config/paypalConfiguration.php");
require("includes/classes/paypal.class.php");
require("includes/classes/Db.class.php");
require("includes/classes/Shoppingbasket.class.php");

//Create an instance of Db
$db = new DB();
//Create an instance of ShoppingBasket
$cart = new ShoppingBasket($db);

$paypalmode = ($PayPalMode=='sandbox') ? '.sandbox' : '';

//Other important variables like tax, shipping cost
$TotalTaxAmount 	= 2.58;  //Sum of tax for all items in this order. 
$HandalingCost 		= 2.00;  //Handling cost for this order.
$InsuranceCost 		= 1.00;  //shipping insurance cost for this order.
$ShippinDiscount 	= -3.00; //Shipping discount for this order. Specify this as negative number.
$ShippinCost 		= 3.00; //Although you may change the value later, try to pass in a shipping amount that is reasonably accurate.

//we need 4 variables from product page Item Name, Item Price, Item Number and Item Quantity.
//Please Note : People can manipulate hidden field amounts in form,
//In practical world you must fetch actual price from database using item id. 
//eg : $ItemPrice = $mysqli->query("SELECT item_price FROM products WHERE id = Product_Number");
 $paypal_data ='';
$ItemTotalPrice = 0;

if($_POST) //Post Data received from product list page.
{
    foreach($_POST['item_name'] as $key=>$itemname){
        $product_code 	= filter_var($_POST['item_code'][$key], FILTER_SANITIZE_STRING); 
        // print_r($product_code);
        //echo "</br>";
         
        $result = $db->query("SELECT ImageName, ImageDescription, Price FROM images WHERE ImageID='$product_code' LIMIT 1");
        //$result = $db->query("SELECT SUM(Price) as total FROM images WHERE ImageID=$product_code");
        //$result = $this->_db->query("SELECT SUM(Price) as total FROM images WHERE ImageID=$key");
    
        foreach ($result as $row){
            $price = $row['Price'];
            $paypal_data .= '&L_PAYMENTREQUEST_0_NAME'.$key.'='.urlencode($row['ImageName']);
            $paypal_data .= '&L_PAYMENTREQUEST_0_NUMBER'.$key.'='.urlencode($_POST['item_code'][$key]);
            $paypal_data .= '&L_PAYMENTREQUEST_0_AMT'.$key.'='.urlencode($price);	
		    $paypal_data .= '&L_PAYMENTREQUEST_0_QTY'.$key.'='. urlencode($_POST['item_qty'][$key]);
		
	    	$subtotal = ($price*$_POST['item_qty'][$key]);
		
	    	$ItemTotalPrice = $ItemTotalPrice + $subtotal;
		
			$paypal_product['items'][] = array('itm_name'=>$row['ImageName'],
											'itm_price'=>$row['Price'],
											'itm_code'=>$_POST['item_code'][$key], 
											'itm_qty'=>$_POST['item_qty'][$key]
											);
											
			$paypal_products['items'][] = array('itm_name'=>$row['ImageName'],
											'itm_price'=>$row['Price'],
											'itm_code'=>$_POST['item_code'][$key], 
											'itm_qty'=>$_POST['item_qty'][$key]
											);
        }
    }
     
    $total = array_sum($_POST['total']);
    // $ItemTotalPrice = $ItemTotalPrice + $total;
    // echo $total;
     
    $GrandTotal = ($total + $TotalTaxAmount + $HandalingCost + $InsuranceCost + $ShippinCost + $ShippinDiscount);
     // echo $GrandTotal;
     // echo $ItemTotalPrice;
      
    $paypal_product['assets'] = array('tax_total'=>$TotalTaxAmount, 
								'handaling_cost'=>$HandalingCost, 
								'insurance_cost'=>$InsuranceCost,
								'shippin_discount'=>$ShippinDiscount,
								'shippin_cost'=>$ShippinCost,
								'grand_total'=>$GrandTotal);
								
	$_SESSION["paypal_products"] = $paypal_product;
	
	
	$padata = 	'&METHOD=SetExpressCheckout'.
				'&RETURNURL='.urlencode($PayPalReturnURL ).
				'&CANCELURL='.urlencode($PayPalCancelURL).
				'&PAYMENTREQUEST_0_PAYMENTACTION='.urlencode("SALE").
				$paypal_data.				
				'&NOSHIPPING=0'. //set 1 to hide buyer's shipping address, in-case products that does not require shipping
				'&PAYMENTREQUEST_0_ITEMAMT='.urlencode($ItemTotalPrice).
				'&PAYMENTREQUEST_0_TAXAMT='.urlencode($TotalTaxAmount).
				'&PAYMENTREQUEST_0_SHIPPINGAMT='.urlencode($ShippinCost).
				'&PAYMENTREQUEST_0_HANDLINGAMT='.urlencode($HandalingCost).
				'&PAYMENTREQUEST_0_SHIPDISCAMT='.urlencode($ShippinDiscount).
				'&PAYMENTREQUEST_0_INSURANCEAMT='.urlencode($InsuranceCost).
				'&PAYMENTREQUEST_0_AMT='.urlencode($GrandTotal).
				'&PAYMENTREQUEST_0_CURRENCYCODE='.urlencode($PayPalCurrencyCode).
				'&LOCALECODE=GB'. //PayPal pages to match the language on your website.
				'&LOGOIMG=http://www.sanwebe.com/wp-content/themes/sanwebe/img/logo.png'. //site logo
				'&CARTBORDERCOLOR=FFFFFF'. //border color of cart
				'&ALLOWNOTE=1';
		
	//We need to execute the "SetExpressCheckOut" method to obtain paypal token
	$paypal= new MyPayPal();
	$httpParsedResponseAr = $paypal->PPHttpPost('SetExpressCheckout', $padata, $PayPalApiUsername, $PayPalApiPassword, $PayPalApiSignature, $PayPalMode);
		
	//Respond according to message we receive from Paypal
	if("SUCCESS" == strtoupper($httpParsedResponseAr["ACK"]) || "SUCCESSWITHWARNING" == strtoupper($httpParsedResponseAr["ACK"]))
	{
		//Redirect user to PayPal store with Token received.
		$paypalurl ='https://www'.$paypalmode.'.paypal.com/cgi-bin/webscr?cmd=_express-checkout&token='.$httpParsedResponseAr["TOKEN"].'';
		header('Location: '.$paypalurl);
	}
	else
	{
		//Show error message
		echo '<div style="color:red"><b>Error : </b>'.urldecode($httpParsedResponseAr["L_LONGMESSAGE0"]).'</div>';
		echo '<pre>';
		print_r($httpParsedResponseAr);
		echo '<
		/pre>';
		}
}

if(isset($_GET["token"]) && isset($_GET["PayerID"]))
{
    $token = $_GET["token"];
	$payer_id = $_GET["PayerID"];
    echo '<meta http-equiv="refresh" content= "0;URL=http://www.valadan.co.uk/ImageLibrary/final.php?token='.$token.'&payer_id='.$payer_id.'" />';
}
?>