<?php
    
    if (isset($_SESSION['id'])){
        
        if($_SESSION['type'] !=1 && $_SESSION['type'] != 2){
            //echo "<p>Welcome: ".$_SESSION['username']."</p>";
            echo '<ul>';
            echo '<li><a href=checkout.php><img src="assets/images/cart.png" title="Cart"/></a></li>';
            echo '<li><a href=user_account.php><img src="assets/images/user.png" title="My Account"/></a></li>';
            echo '<li><a href=logout.php><img src="assets/images/logout.png" title="Logout"/></a></li>';
            echo '</ul>';
        }
        else if ($_SESSION['type'] != 0 && $_SESSION['type'] !=2){
            echo '<ul>';
            //echo "<p>Welcome: Admin</p>";
            echo '<li><a href=admin_account.php><img src="assets/images/user.png" title="My Account"/></a></li>';
            echo '<li><a href=logout.php><img src="assets/images/logout.png" title="Logout"/></a></li>';
            echo '</ul>';
        }
        else if ($_SESSION['type'] != 1 && $_SESSION['type'] != 0) {
           // echo "<p>Welcome: Student</p>";
            echo '<ul>';
            echo '<li><a href=student_account.php><img src="assets/images/user.png" title="My Account"/></a></li>';
            echo '<li><a href=student_upload.php><img src="assets/images/upload.png" title="Upload"/></a></li>';
            echo '<li><a href=logout.php><img src="assets/images/logout.png" title="Logout"/></a></li>';
            echo '</ul>';
        }
    }

    else{
         echo '<ul>';
         if (isset($_SESSION['cart'])){
            echo '<li><a href=checkout.php><img src="assets/images/cartItem.png" title="Cart Populated"/></a></li>';
         }
         else {
         echo '<li><a href=checkout.php><img src="assets/images/cart.png" title="Cart"/></a></li>';
         }
         echo '<li><a href=login_register.php><img src="assets/images/login.png" title="Login/Register"/></a></li>';
         echo '</ul>';


    }

?>