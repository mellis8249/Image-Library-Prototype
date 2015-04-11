<?php
    
    if (isset($_SESSION['id'])){
        
        if($_SESSION['type'] !=1 && $_SESSION['type'] != 2){
            //echo "<p>Welcome: ".$_SESSION['username']."</p>";
            echo '<ul>';
            echo '<li><a href=checkout.php><img src="assets/images/cart.png" alt=Checkout/></a></li>';
            echo '<li><a href=user_account.php><img src="assets/images/user.png"/></a></li>';
            echo '<li><a href=logout.php><img src="assets/images/logout.png"/></a></li>';
            echo '</ul>';
        }
        else if ($_SESSION['type'] != 0 && $_SESSION['type'] !=2){
            echo '<ul>';
            //echo "<p>Welcome: Admin</p>";
            echo '<li><a href=admin_account.php><img src="assets/images/user.png"/></a></li>';
            echo '<li><a href=logout.php><img src="assets/images/logout.png"/></a></li>';
            echo '</ul>';
        }
        else if ($_SESSION['type'] != 1 && $_SESSION['type'] != 0) {
           // echo "<p>Welcome: Student</p>";
            echo '<ul>';
            echo '<li><a href=student_account.php><img src="assets/images/user.png"/></a></li>';
            echo '<li><a href=student_upload.php><img src="assets/images/upload.png"/></a></li>';
            echo '<li><a href=logout.php><img src="assets/images/logout.png"/></a></li>';
            echo '</ul>';
        }
    }

    else{
         echo '<ul>';
         if (isset($_SESSION['cart'])){
            echo '<li><a href=checkout.php><img src="assets/images/cartItem.png" alt="Checkout"/></a></li>';
         }
         else {
         echo '<li><a href=checkout.php><img src="assets/images/cart.png" alt="Checkout"/></a></li>';
         }
         echo '<li><a href=login_register.php><img src="assets/images/login.png"/></a></li>';
         echo '</ul>';


    }

?>