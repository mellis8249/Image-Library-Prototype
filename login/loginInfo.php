<?php
    
    if (isset($_SESSION['id'])){
        
        if($_SESSION['type'] !=1 && $_SESSION['type'] != 2){
            echo "<p>Welcome: ".$_SESSION['username']."</p>";
            echo "<a href=user_account.php>My Account</a>";
            echo "<a href=logout.php>Logout</a>";
        }
        else if ($_SESSION['type'] != 0 && $_SESSION['type'] !=2){
            echo "<p>Welcome: Admin</p>";
            echo "<a href=admin_account.php>Admin</a>";
            echo "<a href=logout.php>Logout</a>";
        }
        else if ($_SESSION['type'] != 1 && $_SESSION['type'] != 0) {
            echo "<p>Welcome: Student</p>";
            echo "<a href=user_account.php>My Account</a>";
            echo "<a href=student_account.php>Upload</a>";
            echo "<a href=logout.php>Logout</a>";
        }

    }

?>