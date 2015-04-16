<?php
/**
 * Image - A Class that handles the display of images for guests, users, students and admin.
 * Provides functionality depending on what type of user is logged in such as add and delete.
 * Using Pagination adapted from http://www.phpeasystep.com/phptu/29.html.
 *
 * @author		Author: Mark Ellis
 * @git 		https://github.com/
 */
Class Image {
    
    //Variables
	private $_db;
    private $msg = array();
    private $error = array();
    private $is_deleted = false;
    private $tbl_test="thumbnails";

    //Class constructor 
  	public
    function __construct(DB $db){
        //Uses the Db.class
        $this->_db = $db;
    }

    //Method to display errors
    public
    function display_errors() {
        //Iterates error 
        foreach ($this->error as $error) {
            //Output errors
            echo '<p class="error">' . $error . '</p>';
        }
    }

    //Method to display info
    public
    function display_info() {
        //Iterates msg
        foreach ($this->msg as $msg) {
            //Output msg
            echo '<p class="msg">' . $msg . '</p>';
        }
    }
    
    //Method to displayImages
    public 
    function displayImages() {
        if (empty($_GET['searchImages'])){
            //Table names
            $tbl_name="thumbnails";
            $tbl_name2="images";
            $page = "";

            //Sets how many adjacent pages are displayed
            $adjacents = 2;
    
            //Gets the total number of rows from the database
            $query = $this->_db->query("SELECT COUNT(*) as num FROM $tbl_name", PDO::FETCH_NUM);

            //Gets the number of rows from the $query array and stores it in $total_pages
            $total_pages = $query[0]['num'];

            //Setup vars for query.
            $targetpage = "images.php";   //your file name  (the name of this file)
            $limit = 4;  
                if (isset($_GET['page'])){                              //how many items to show per page
                    $page = $_GET['page'];
                }
                if($page) 
                     $start = ($page - 1) * $limit;          //first item to display on this page
                else
                    $start = 0;                             //if no page var is given, set start to 0
    
            //Gets images from the database
        	$result = $this->_db->query("SELECT * FROM $tbl_name, $tbl_name2 WHERE $tbl_name.ImageID = $tbl_name2.ImageID LIMIT $start, $limit", null, PDO::FETCH_ASSOC); 

            //Setup page vars for display.
            if ($page == 0) $page = 1;                  //If no page var is given, default to 1.
            $prev = $page - 1;                          //Previous page is page - 1
            $next = $page + 1;                          //Next page is page + 1
            $lastpage = ceil($total_pages/$limit);      //Lastpage is = total pages / items per page, rounded up.
            $lpm1 = $lastpage - 1;                      //Last page minus 1
    
            //Draws the pagination and stores the code in a variable for re-use
            $pagination = "";
                if($lastpage > 1)
                {   
            $pagination .= "<div class=\"pagination\">";
            //Previous button
                if ($page > 1) 
                    $pagination.= "<a href=\"$targetpage?page=$prev\">Previous</a>";
                else
                    $pagination.= "<span class=\"disabled\">Previous</span>"; 
        
                //Pages 
                if ($lastpage < 7 + ($adjacents * 2))   //Not enough pages to bother breaking it up
                {   
                for ($counter = 1; $counter <= $lastpage; $counter++)
                {
                    if ($counter == $page)
                        $pagination.= "<span class=\"current\">$counter</span>";
                    else
                        $pagination.= "<a href=\"$targetpage?page=$counter\">$counter</a>";                 
                }
        }
        elseif($lastpage > 5 + ($adjacents * 2))    //Enough pages to hide some
        {
            //Close to beginning; only hide later pages
            if($page < 1 + ($adjacents * 2))        
            {
                for ($counter = 1; $counter < 4 + ($adjacents * 2); $counter++)
                {
                    if ($counter == $page)
                        $pagination.= "<span class=\"current\">$counter</span>";
                    else
                        $pagination.= "<a href=\"$targetpage?page=$counter\">$counter</a>";                 
                }
                $pagination.= "...";
                $pagination.= "<a href=\"$targetpage?page=$lpm1\">$lpm1</a>";
                $pagination.= "<a href=\"$targetpage?page=$lastpage\">$lastpage</a>";       
            }
            //In middle; hide some front and some back
            elseif($lastpage - ($adjacents * 2) > $page && $page > ($adjacents * 2))
            {
                $pagination.= "<a href=\"$targetpage?page=1\">1</a>";
                $pagination.= "<a href=\"$targetpage?page=2\">2</a>";
                $pagination.= "...";
                for ($counter = $page - $adjacents; $counter <= $page + $adjacents; $counter++)
                {
                    if ($counter == $page)
                        $pagination.= "<span class=\"current\">$counter</span>";
                    else
                        $pagination.= "<a href=\"$targetpage?page=$counter\">$counter</a>";                 
                }
                $pagination.= "...";
                $pagination.= "<a href=\"$targetpage?page=$lpm1\">$lpm1</a>";
                $pagination.= "<a href=\"$targetpage?page=$lastpage\">$lastpage</a>";       
            }
            //Close to end; only hide early pages
            else
            {
                $pagination.= "<a href=\"$targetpage?page=1\">1</a>";
                $pagination.= "<a href=\"$targetpage?page=2\">2</a>";
                $pagination.= "...";
                for ($counter = $lastpage - (2 + ($adjacents * 2)); $counter <= $lastpage; $counter++)
                {
                    if ($counter == $page)
                        $pagination.= "<span class=\"current\">$counter</span>";
                    else
                        $pagination.= "<a href=\"$targetpage?page=$counter\">$counter</a>";                 
                }
            }
        }
        
        //Next button
        if ($page < $counter - 1) 
            $pagination.= "<a href=\"$targetpage?page=$next\">Next</a>";
        else
            $pagination.= "<span class=\"disabled\">Next</span>";
            $pagination.= "</div>\n";       
    }
?>
<?php
    foreach ($result as $row) {
        $imageName = $row['ImageName'];
        $address = $row['ImageJPEG'];
        $address2= $row['ImagePNG'];
        $address3= $row['Original'];
        $thumbnail = substr($address, 55,80);
        $watermark = substr($address2, 55, 80);
        $original = substr($address3, 55, 80);
        echo "<table>";
        echo "<tr>";
        echo "<th>";
        echo $imageName;
        echo "</th>";
       // echo "<th> Watermarked Image </th>";
        echo "</tr>";
        echo "<tr>";
        echo "<td>";
        echo '<img src="' . $thumbnail . '" width="250" height="250" alt="ImageJPEG" />'; 
        echo "</td>";
        echo "</tr>";
        echo "<tr>";
        echo '<td>
        <a href="images.php?ImageID='.$row['ImageID'].'&ImageName='.$row['ImageName'].'"><img src ="assets/images/add.png"></a>
        <a href="original.php?ImageID='.$row['ImageID'].'&ImageName='.$row['ImageName'].'"><img src ="assets/images/search.png"></a>
        </td>';
        echo "</tr>";
        echo "</table>";
    }
?>
<?=$pagination?>
<?php
    }
    else if (!empty($_GET['searchImages'])){
        $searchImages = $_GET['searchImages'];
        //Table names
        $tbl_name="thumbnails";
        $tbl_name2="images";
        $page = "";

        //Sets how many adjacent pages are displayed
        $adjacents = 2;
    
        //Gets the total number of rows from the database
        $query = $this->_db->query("SELECT COUNT(*) as num FROM $tbl_name WHERE Category = '$searchImages' OR ImageName = '$searchImages'", PDO::FETCH_NUM);

        $total_pages = $query[0]['num'];

        $searchImages = $_GET['searchImages'];
        //Setup vars for query.
        $targetpage = "images.php?searchImages=$searchImages";   //your file name  (the name of this file)
        $limit = 2;
        if (isset($_GET['page']) && isset($_GET['searchImages'])){                            //how many items to show per page
            $page = $_GET['page'];
        }
        if($page) 
            $start = ($page - 1) * $limit;          //first item to display on this page
        else
            $start = 0;    

        $result2 = $this->_db->query("SELECT * FROM $tbl_name WHERE Category = '$searchImages' OR ImageName = '$searchImages' LIMIT $start, $limit", null, PDO::FETCH_ASSOC);
        //Setup page vars for display.
        if ($page == 0) $page = 1;                  //If no page var is given, default to 1.
            $prev = $page - 1;                          //Previous page is page - 1
            $next = $page + 1;                          //Next page is page + 1
            $lastpage = ceil($total_pages/$limit);      //Lastpage is = total pages / items per page, rounded up.
            $lpm1 = $lastpage - 1;                      //Last page minus 1
    
    //Draws the pagination and stores the code in a variable for re-use
            $pagination = "";
        if($lastpage > 1)
        {   
            $pagination .= "<div class=\"pagination\">";
            //Previous button
            if ($page > 1) 
                $pagination.= "<a href=\"$targetpage&page=$prev\">Previous</a>";
            else
                $pagination.= "<span class=\"disabled\">Previous</span>"; 
        
        //Pages 
            if ($lastpage < 7 + ($adjacents * 2))   //Not enough pages to bother breaking it up
            {   
                for ($counter = 1; $counter <= $lastpage; $counter++)
                {
                    if ($counter == $page)
                        $pagination.= "<span class=\"current\">$counter</span>";
                    else
                        $pagination.= "<a href=\"$targetpage&page=$counter\">$counter</a>";                 
                }
            }
            elseif($lastpage > 5 + ($adjacents * 2))    //Enough pages to hide some
            {
            //Close to beginning; only hide later pages
                if($page < 1 + ($adjacents * 2))        
                {
                    for ($counter = 1; $counter < 4 + ($adjacents * 2); $counter++)
                    {
                        if ($counter == $page)
                            $pagination.= "<span class=\"current\">$counter</span>";
                        else
                            $pagination.= "<a href=\"$targetpage&page=$counter\">$counter</a>";                 
                    }
                $pagination.= "...";
                $pagination.= "<a href=\"$targetpage&page=$lpm1\">$lpm1</a>";
                $pagination.= "<a href=\"$targetpage&page=$lastpage\">$lastpage</a>";       
            }
            //In middle; hide some front and some back
            elseif($lastpage - ($adjacents * 2) > $page && $page > ($adjacents * 2))
            {
                $pagination.= "<a href=\"$targetpage&page=1\">1</a>";
                $pagination.= "<a href=\"$targetpage&page=2\">2</a>";
                $pagination.= "...";
                for ($counter = $page - $adjacents; $counter <= $page + $adjacents; $counter++)
                {
                    if ($counter == $page)
                        $pagination.= "<span class=\"current\">$counter</span>";
                    else
                        $pagination.= "<a href=\"$targetpage?page=$counter\">$counter</a>";                 
                    }
                $pagination.= "...";
                $pagination.= "<a href=\"$targetpage&page=$lpm1\">$lpm1</a>";
                $pagination.= "<a href=\"$targetpage&page=$lastpage\">$lastpage</a>";       
            }
            //Close to end; only hide early pages
            else
            {
                $pagination.= "<a href=\"$targetpage&page=1\">1</a>";
                $pagination.= "<a href=\"$targetpage&page=2\">2</a>";
                $pagination.= "...";
                for ($counter = $lastpage - (2 + ($adjacents * 2)); $counter <= $lastpage; $counter++)
                {
                    if ($counter == $page)
                        $pagination.= "<span class=\"current\">$counter</span>";
                    else
                        $pagination.= "<a href=\"$targetpage&page=$counter\">$counter</a>";                 
                }
            }
        }
        
        //Next button
        if ($page < $counter - 1) 
            $pagination.= "<a href=\"$targetpage&page=$next\">Next</a>";
        else
            $pagination.= "<span class=\"disabled\">Next</span>";
            $pagination.= "</div>\n";       
    } 
    ?>
    <?php
    foreach ($result2 as $row){
        $imageName = $row['ImageName'];
        $address = $row['ImageJPEG'];
        $address2= $row['ImagePNG'];
        $address3= $row['Original'];
        $thumbnail = substr($address, 55,80);
        $watermark = substr($address2, 55, 80);
        $original = substr($address3, 55, 80);
        echo "<table>";
        echo "<tr>";
        echo "<th>";
        echo $imageName;
        echo "</th>";
        echo "</tr>";
        echo "<tr>";
        echo "<td>";
        echo '<img src="' . $thumbnail . '" width="250" height="250" alt="ImageJPEG" />'; 
        echo "</td>";
        echo "</tr>";
        echo "<tr>";
        echo '<td>
        <a href="images.php?ImageID='.$row['ImageID'].'&ImageName='.$row['ImageName'].'"><img src ="assets/images/add.png"></a>
        <a href="original.php?ImageID='.$row['ImageID'].'&ImageName='.$row['ImageName'].'"><img src ="assets/images/search.png"></a>
        </td>';
        echo "</tr>";
        echo "</table>";
    }
?>
<?=$pagination?>
<?php 
    }     
}   


    //Method to displayImagesGuest
    public 
    function displayImagesGuest() {
        if (empty($_GET['searchImages'])){
            //Table names
            $tbl_name="thumbnails";
            $tbl_name2="images";
            $page = "";

            //Sets how many adjacent pages are displayed
            $adjacents = 2;
    
            //Gets the total number of rows from the database
            $query = $this->_db->query("SELECT COUNT(*) as num FROM $tbl_name", PDO::FETCH_NUM);

            //Gets the number of rows from the $query array and stores it in $total_pages
            $total_pages = $query[0]['num'];

            //Setup vars for query.
            $targetpage = "images.php";   //your file name  (the name of this file)
            $limit = 4;  
                if (isset($_GET['page'])){                              //how many items to show per page
                    $page = $_GET['page'];
                }
                if($page) 
                     $start = ($page - 1) * $limit;          //first item to display on this page
                else
                    $start = 0;                             //if no page var is given, set start to 0
    
            //Gets images from the database
        	$result = $this->_db->query("SELECT * FROM $tbl_name, $tbl_name2 WHERE $tbl_name.ImageID = $tbl_name2.ImageID LIMIT $start, $limit", null, PDO::FETCH_ASSOC); 

            //Setup page vars for display.
            if ($page == 0) $page = 1;                  //If no page var is given, default to 1.
            $prev = $page - 1;                          //Previous page is page - 1
            $next = $page + 1;                          //Next page is page + 1
            $lastpage = ceil($total_pages/$limit);      //Lastpage is = total pages / items per page, rounded up.
            $lpm1 = $lastpage - 1;                      //Last page minus 1
    
            //Draws the pagination and stores the code in a variable for re-use
            $pagination = "";
                if($lastpage > 1)
                {   
            $pagination .= "<div class=\"pagination\">";
            //Previous button
                if ($page > 1) 
                    $pagination.= "<a href=\"$targetpage?page=$prev\">Previous</a>";
                else
                    $pagination.= "<span class=\"disabled\">Previous</span>"; 
        
                //Pages 
                if ($lastpage < 7 + ($adjacents * 2))   //Not enough pages to bother breaking it up
                {   
                for ($counter = 1; $counter <= $lastpage; $counter++)
                {
                    if ($counter == $page)
                        $pagination.= "<span class=\"current\">$counter</span>";
                    else
                        $pagination.= "<a href=\"$targetpage?page=$counter\">$counter</a>";                 
                }
        }
        elseif($lastpage > 5 + ($adjacents * 2))    //Enough pages to hide some
        {
            //Close to beginning; only hide later pages
            if($page < 1 + ($adjacents * 2))        
            {
                for ($counter = 1; $counter < 4 + ($adjacents * 2); $counter++)
                {
                    if ($counter == $page)
                        $pagination.= "<span class=\"current\">$counter</span>";
                    else
                        $pagination.= "<a href=\"$targetpage?page=$counter\">$counter</a>";                 
                }
                $pagination.= "...";
                $pagination.= "<a href=\"$targetpage?page=$lpm1\">$lpm1</a>";
                $pagination.= "<a href=\"$targetpage?page=$lastpage\">$lastpage</a>";       
            }
            //In middle; hide some front and some back
            elseif($lastpage - ($adjacents * 2) > $page && $page > ($adjacents * 2))
            {
                $pagination.= "<a href=\"$targetpage?page=1\">1</a>";
                $pagination.= "<a href=\"$targetpage?page=2\">2</a>";
                $pagination.= "...";
                for ($counter = $page - $adjacents; $counter <= $page + $adjacents; $counter++)
                {
                    if ($counter == $page)
                        $pagination.= "<span class=\"current\">$counter</span>";
                    else
                        $pagination.= "<a href=\"$targetpage?page=$counter\">$counter</a>";                 
                }
                $pagination.= "...";
                $pagination.= "<a href=\"$targetpage?page=$lpm1\">$lpm1</a>";
                $pagination.= "<a href=\"$targetpage?page=$lastpage\">$lastpage</a>";       
            }
            //Close to end; only hide early pages
            else
            {
                $pagination.= "<a href=\"$targetpage?page=1\">1</a>";
                $pagination.= "<a href=\"$targetpage?page=2\">2</a>";
                $pagination.= "...";
                for ($counter = $lastpage - (2 + ($adjacents * 2)); $counter <= $lastpage; $counter++)
                {
                    if ($counter == $page)
                        $pagination.= "<span class=\"current\">$counter</span>";
                    else
                        $pagination.= "<a href=\"$targetpage?page=$counter\">$counter</a>";                 
                }
            }
        }
        
        //Next button
        if ($page < $counter - 1) 
            $pagination.= "<a href=\"$targetpage?page=$next\">Next</a>";
        else
            $pagination.= "<span class=\"disabled\">Next</span>";
            $pagination.= "</div>\n";       
    }
?>
<?php
    foreach ($result as $row) {
        $imageName = $row['ImageName'];
        $address = $row['ImageJPEG'];
        $address2= $row['ImagePNG'];
        $address3= $row['Original'];
        $thumbnail = substr($address, 55,80);
        $watermark = substr($address2, 55, 80);
        $original = substr($address3, 55, 80);
        echo "<table>";
        echo "<tr>";
        echo "<th>";
        echo $imageName;
        echo "</th>";
       // echo "<th> Watermarked Image </th>";
        echo "</tr>";
        echo "<tr>";
        echo "<td>";
        echo '<img src="' . $thumbnail . '" width="250" height="250" alt="ImageJPEG" />'; 
        echo "</td>";
        echo "</tr>";
        echo "<tr>";
        echo '<td>
        <a href="original.php?ImageID='.$row['ImageID'].'&ImageName='.$row['ImageName'].'"><img src ="assets/images/search.png"></a>
        </td>';
        echo "</tr>";
        echo "</table>";
    }
?>
<?=$pagination?>
<?php
    }
    else if (!empty($_GET['searchImages'])){
        $searchImages = $_GET['searchImages'];
        //Table names
        $tbl_name="thumbnails";
        $tbl_name2="images";
        $page = "";

        //Sets how many adjacent pages are displayed
        $adjacents = 2;
    
        //Gets the total number of rows from the database
        $query = $this->_db->query("SELECT COUNT(*) as num FROM $tbl_name WHERE Category = '$searchImages' OR ImageName = '$searchImages'", PDO::FETCH_NUM);

        $total_pages = $query[0]['num'];

        $searchImages = $_GET['searchImages'];
        //Setup vars for query.
        $targetpage = "images.php?searchImages=$searchImages";   //your file name  (the name of this file)
        $limit = 2;
        if (isset($_GET['page']) && isset($_GET['searchImages'])){                            //how many items to show per page
            $page = $_GET['page'];
        }
        if($page) 
            $start = ($page - 1) * $limit;          //first item to display on this page
        else
            $start = 0;    

        $result2 = $this->_db->query("SELECT * FROM $tbl_name WHERE Category = '$searchImages' OR ImageName = '$searchImages' LIMIT $start, $limit", null, PDO::FETCH_ASSOC);
        //Setup page vars for display.
        if ($page == 0) $page = 1;                  //If no page var is given, default to 1.
            $prev = $page - 1;                          //Previous page is page - 1
            $next = $page + 1;                          //Next page is page + 1
            $lastpage = ceil($total_pages/$limit);      //Lastpage is = total pages / items per page, rounded up.
            $lpm1 = $lastpage - 1;                      //Last page minus 1
    
            //Draws the pagination and stores the code in a variable for re-use
            $pagination = "";
        if($lastpage > 1)
        {   
            $pagination .= "<div class=\"pagination\">";
            //Previous button
            if ($page > 1) 
                $pagination.= "<a href=\"$targetpage&page=$prev\">Previous</a>";
            else
                $pagination.= "<span class=\"disabled\">Previous</span>"; 
        
            //Pages 
            if ($lastpage < 7 + ($adjacents * 2))   //Not enough pages to bother breaking it up
            {   
                for ($counter = 1; $counter <= $lastpage; $counter++)
                {
                    if ($counter == $page)
                        $pagination.= "<span class=\"current\">$counter</span>";
                    else
                        $pagination.= "<a href=\"$targetpage&page=$counter\">$counter</a>";                 
                }
            }
            elseif($lastpage > 5 + ($adjacents * 2))    //Enough pages to hide some
            {
            //Close to beginning; only hide later pages
                if($page < 1 + ($adjacents * 2))        
                {
                    for ($counter = 1; $counter < 4 + ($adjacents * 2); $counter++)
                    {
                        if ($counter == $page)
                            $pagination.= "<span class=\"current\">$counter</span>";
                        else
                            $pagination.= "<a href=\"$targetpage&page=$counter\">$counter</a>";                 
                    }
                $pagination.= "...";
                $pagination.= "<a href=\"$targetpage&page=$lpm1\">$lpm1</a>";
                $pagination.= "<a href=\"$targetpage&page=$lastpage\">$lastpage</a>";       
            }
            //In middle; hide some front and some back
            elseif($lastpage - ($adjacents * 2) > $page && $page > ($adjacents * 2))
            {
                $pagination.= "<a href=\"$targetpage&page=1\">1</a>";
                $pagination.= "<a href=\"$targetpage&page=2\">2</a>";
                $pagination.= "...";
                for ($counter = $page - $adjacents; $counter <= $page + $adjacents; $counter++)
                {
                    if ($counter == $page)
                        $pagination.= "<span class=\"current\">$counter</span>";
                    else
                        $pagination.= "<a href=\"$targetpage?page=$counter\">$counter</a>";                 
                    }
                $pagination.= "...";
                $pagination.= "<a href=\"$targetpage&page=$lpm1\">$lpm1</a>";
                $pagination.= "<a href=\"$targetpage&page=$lastpage\">$lastpage</a>";       
            }
            //Close to end; only hide early pages
            else
            {
                $pagination.= "<a href=\"$targetpage&page=1\">1</a>";
                $pagination.= "<a href=\"$targetpage&page=2\">2</a>";
                $pagination.= "...";
                for ($counter = $lastpage - (2 + ($adjacents * 2)); $counter <= $lastpage; $counter++)
                {
                    if ($counter == $page)
                        $pagination.= "<span class=\"current\">$counter</span>";
                    else
                        $pagination.= "<a href=\"$targetpage&page=$counter\">$counter</a>";                 
                }
            }
        }
        
        //Next button
        if ($page < $counter - 1) 
            $pagination.= "<a href=\"$targetpage&page=$next\">Next</a>";
        else
            $pagination.= "<span class=\"disabled\">Next</span>";
            $pagination.= "</div>\n";       
    } 
    ?>
    <?php
    foreach ($result2 as $row){
        $imageName = $row['ImageName'];
        $address = $row['ImageJPEG'];
        $address2= $row['ImagePNG'];
        $address3= $row['Original'];
        $thumbnail = substr($address, 55,80);
        $watermark = substr($address2, 55, 80);
        $original = substr($address3, 55, 80);
        echo "<table>";
        echo "<tr>";
        echo "<th>";
        echo $imageName;
        echo "</th>";
        echo "</tr>";
        echo "<tr>";
        echo "<td>";
        echo '<img src="' . $thumbnail . '" width="250" height="250" alt="ImageJPEG" />'; 
        echo "</td>";
        echo "</tr>";
        echo "<tr>";
        echo '<td>
        <a href="original.php?ImageID='.$row['ImageID'].'&ImageName='.$row['ImageName'].'"><img src ="assets/images/search.png"></a>
        </td>';
        echo "</tr>";
        echo "</table>";
    }
?>
<?=$pagination?>
<?php 
    }     
}   
    //Method to searchImages
    public
    function searchImages(){
        if(isset($_GET['search'])){
            if(!empty($_GET['searchImages'])){
                $searchImages = $_GET['searchImages'];
                $result = $this->_db->query('SELECT * FROM images WHERE ImageName = "'.$searchImages.'" OR category = "'.$searchImages.'"');
                if (!empty($result)){
                     //    $this->msg[] = 'Search successful';
                } else {
                      //  $this->error[] = 'No results found';
                }
            } 
            else if (empty($_GET['searchImages'])){
               // $this->error[] = 'Please fill in all fields';
            }
        }
    }
    
    //Method for pickedImage
    public
    function pickedImage(){
        if(isset($_GET['ImageID'])){
            $selected = $_GET['ImageID'];
            $result = $this->_db->query("SELECT * FROM images WHERE ImageID = $selected", null, PDO::FETCH_ASSOC);
            $address = '';
                foreach ($result as $row) {
                    if (isset($row['ImageJPEG'])){
                        $address = $row['ImageJPEG'];
                    }
                    if (isset($row['ImagePNG'])){
                        $address2= $row['ImagePNG'];
                    }
                    if (isset($row['Original'])){
                        $address3= $row['Original'];
                    }

                    $thumbail = '';
                    $watermark = '';
                    $original = '';
                    $thumbnail = substr($address, 55,80);
                    $watermark = substr($address2, 55, 80);
                    $original = substr($address3, 55, 80);
                    
                    echo "<table>";
                    echo "<tr>";
                    echo "<td>";
                    echo '<a href='. $watermark. '><img src="' . $watermark. '" width="250" height="250" alt="ImageWatermarked" ></a>'; 
                    echo "</td>";
                    echo "</tr>";
                    echo "<tr>";
                    if (isset($_SESSION['id'])){
                        echo '<td>
                         <a href="images.php?ImageID='.$row['ImageID'].'&ImageName='.$row['ImageName'].'"><img src ="assets/images/add.png"></a>';
                        echo '</td>';
                    }
                echo "</tr>";
                echo "</table>";
            }
        }
    }

    //Method for pickedImageDetails
    public
    function pickedImageDetails(){
        if (isset($_GET['ImageID'])){
            $selected = $_GET['ImageID'];
            $result = $this->_db->query("SELECT * FROM images WHERE ImageID = $selected ORDER BY ImageID DESC", null, PDO::FETCH_ASSOC);
            foreach ($result as $row){
            echo "<table>";
            echo "<tr>";
            echo "<th>";
            echo "Image Name";
            echo "</th>";
            echo "<td>";
            echo $row['ImageName'];
            echo "</td>";
            echo "</tr>";
            echo "<tr>";
            echo "<th>";
            echo "Image Description";
            echo "</th>";
            echo "<td>";
            echo $row['ImageDescription'];
            echo "</td>";
            echo "</tr>";
            echo "<tr>";
            echo "<th>";
            echo "Author";
            echo "</th>";
            echo "<td>";
            echo $row['Author'];
            echo "</td>";
            echo "</tr>";
            echo "<tr>";
            echo "<th>";
            echo "Price";
            echo "</th>";
            echo "<td>";
            echo "&pound;".$row['Price'];
            echo "</td>";
            echo "</tr>";
            echo "<tr>";
            echo "<th>";
            echo "Size";
            echo "</th>";
            echo "<td>";
            echo $row['ImageWidth'].' x '.$row['ImageHeight'];
            echo "</td>";
            echo "</tr>";
            echo "<tr>";
            echo "<th>";
            echo "MegaPixels";
            echo "</th>";
            echo "<td>";
            echo $row['MegaPixels'];
            echo "</td>";
            echo "</tr>";
            echo "<tr>";
            echo "<th>";
            echo "Print Size (200 DPI)";
            echo "</th>";
            echo "<td>";
            echo $row['DPIWidth200'].' x '.$row['DPIHeight200'];
            echo "</td>";
            echo "</tr>";
            echo "<tr>";
            echo "<th>";
            echo "Print Size (300 DPI)";
            echo "</th>";
            echo "<td>";
            echo $row['DPIWidth300'].' x '.$row['DPIHeight300'];
            echo "</td>";
            echo "</tr>";
            echo "</table>";
            }
        }
    }
    
    //Method to displayCategory
    public 
    function displayCategory(){
        //$result = $this->_db->query("SELECT COUNT(*) as num FROM images ")
        $result = $this->_db->query('SELECT DISTINCT category FROM images ORDER BY category DESC');
        foreach($result as $row){
        echo '<p><a href="images.php?searchImages='.$row['category']. '">'.$row['category'].'</a></p>';
        }
    }
        
    //Method to displayStudentImage
    public
    function displayStudentImages(){
        
        if(isset($_SESSION['username'])){
            $user = $_SESSION['username'];
            $test = $user;
            
            $tbl_name="thumbnails";
            $tbl_name2="images";
            $page = "";

            //Sets how many adjacent pages are displayed
            $adjacents = 2;
    
            //Gets the total number of rows from the database
            $query = $this->_db->query("SELECT COUNT(*) as num FROM $tbl_name WHERE Author = '$test'", PDO::FETCH_NUM);

            //Gets the number of rows from the $query array and stores it in $total_pages
            $total_pages = $query[0]['num'];

             //Setup vars for query.
            $targetpage = "student_account.php";   //your file name  (the name of this file)
            $limit = 2;  
            if (isset($_GET['page'])){                              //how many items to show per page
             $page = $_GET['page'];
            }
            if($page) 
            $start = ($page - 1) * $limit;          //first item to display on this page
            else
            $start = 0;                             //if no page var is given, set start to 0
    
            //Gets images from the database
   	        $result = $this->_db->query("SELECT * FROM $tbl_name WHERE Author = '$test' ORDER BY ImageID DESC LIMIT $start, $limit", null, PDO::FETCH_ASSOC); 

            //Setup page vars for display.
            if ($page == 0) $page = 1;                  //If no page var is given, default to 1.
            $prev = $page - 1;                          //Previous page is page - 1
            $next = $page + 1;                          //Next page is page + 1
            $lastpage = ceil($total_pages/$limit);      //Lastpage is = total pages / items per page, rounded up.
            $lpm1 = $lastpage - 1;                      //Last page minus 1
    
            //Draws the pagination and stores the code in a variable for re-use
            $pagination = "";
                if($lastpage > 1)
                {   
                    $pagination .= "<div class=\"pagination\">";
                //Previous button
                    if ($page > 1) 
                        $pagination.= "<a href=\"$targetpage?page=$prev\">Previous</a>";
                    else
                        $pagination.= "<span class=\"disabled\">Previous</span>"; 
        
            //Pages 
            if ($lastpage < 7 + ($adjacents * 2))   //Not enough pages to bother breaking it up
            {   
                for ($counter = 1; $counter <= $lastpage; $counter++)
                {
                    if ($counter == $page)
                        $pagination.= "<span class=\"current\">$counter</span>";
                    else
                        $pagination.= "<a href=\"$targetpage?page=$counter\">$counter</a>";                 
                }
            }
            elseif($lastpage > 5 + ($adjacents * 2))    //Enough pages to hide some
            {
                //Close to beginning; only hide later pages
                if($page < 1 + ($adjacents * 2))        
                {
                    for ($counter = 1; $counter < 4 + ($adjacents * 2); $counter++)
                    {
                        if ($counter == $page)
                            $pagination.= "<span class=\"current\">$counter</span>";
                        else
                            $pagination.= "<a href=\"$targetpage?page=$counter\">$counter</a>";                 
                }
                $pagination.= "...";
                $pagination.= "<a href=\"$targetpage?page=$lpm1\">$lpm1</a>";
                $pagination.= "<a href=\"$targetpage?page=$lastpage\">$lastpage</a>";       
            }
            //In middle; hide some front and some back
            elseif($lastpage - ($adjacents * 2) > $page && $page > ($adjacents * 2))
            {
                $pagination.= "<a href=\"$targetpage?page=1\">1</a>";
                $pagination.= "<a href=\"$targetpage?page=2\">2</a>";
                $pagination.= "...";
                    for ($counter = $page - $adjacents; $counter <= $page + $adjacents; $counter++)
                    {
                        if ($counter == $page)
                            $pagination.= "<span class=\"current\">$counter</span>";
                        else
                            $pagination.= "<a href=\"$targetpage?page=$counter\">$counter</a>";                 
                    }
                $pagination.= "...";
                $pagination.= "<a href=\"$targetpage?page=$lpm1\">$lpm1</a>";
                $pagination.= "<a href=\"$targetpage?page=$lastpage\">$lastpage</a>";       
            }
            //Close to end; only hide early pages
            else
            {
                $pagination.= "<a href=\"$targetpage?page=1\">1</a>";
                $pagination.= "<a href=\"$targetpage?page=2\">2</a>";
                $pagination.= "...";
                    for ($counter = $lastpage - (2 + ($adjacents * 2)); $counter <= $lastpage; $counter++)
                    {
                        if ($counter == $page)
                            $pagination.= "<span class=\"current\">$counter</span>";
                        else
                            $pagination.= "<a href=\"$targetpage?page=$counter\">$counter</a>";                 
                }
            }
        }
        
        //Next button
        if ($page < $counter - 1) 
            $pagination.= "<a href=\"$targetpage?page=$next\">Next</a>";
        else
            $pagination.= "<span class=\"disabled\">Next</span>";
            $pagination.= "</div>\n";       
    }
    ?>
    <?php
          
        foreach($result as $row){
        $address = $row['ImageJPEG'];
        $thumbnail = substr($address, 52,80);
        echo "<table>";
        echo "<tr>";
        echo "<td>";
        echo $row['ImageName'];
        echo "</td>";
        echo "</tr>";
        echo "<tr>";
        echo "<td>";
        echo '<img src="' . $thumbnail . '" width="250" height="250" alt="ImageJPEG" />'; 
        echo "</td>";
        echo "</tr>";
        echo "<tr>";
        echo "<td>";
        echo '<a href="student_account.php?ImageID='.$row['ImageID'].'"><img src ="assets/images/remove.png"></a>';
        echo "</td>";
        echo "</tr>";
        echo "</table>";
        }
    }
?>
<?=$pagination?>
<?php
    }

    //Admin
        
    //Method to displayAdminImages
    public
    function displayAdminImages(){
            
        $tbl_name="thumbnails";
        $tbl_name2="images";
        $page = "";
            
        //Sets how many adjacent pages are displayed
        $adjacents = 2;
    
        //Gets the total number of rows from the database
        $query = $this->_db->query("SELECT COUNT(*) as num FROM $tbl_name", PDO::FETCH_NUM);

        //Gets the number of rows from the $query array and stores it in $total_pages
        $total_pages = $query[0]['num'];

        //Setup vars for query.
        $targetpage = "admin_account.php";   //your file name  (the name of this file)
        $limit = 2;  
        if (isset($_GET['page'])){                              //how many items to show per page
            $page = $_GET['page'];
        }
        if($page) 
            $start = ($page - 1) * $limit;          //first item to display on this page
        else
            $start = 0;                             //if no page var is given, set start to 0
    
        //Gets images from the database
    	$result = $this->_db->query("SELECT * FROM $tbl_name ORDER BY ImageID DESC LIMIT $start, $limit", null, PDO::FETCH_ASSOC); 

        //Setup page vars for display.
        if ($page == 0) $page = 1;                  //If no page var is given, default to 1.
        $prev = $page - 1;                          //Previous page is page - 1
        $next = $page + 1;                          //Next page is page + 1
        $lastpage = ceil($total_pages/$limit);      //Lastpage is = total pages / items per page, rounded up.
        $lpm1 = $lastpage - 1;                      //Last page minus 1
    
        //Draws the pagination and stores the code in a variable for re-use
        $pagination = "";
        if($lastpage > 1)
        {   
            $pagination .= "<div class=\"pagination\">";
            //Previous button
            if ($page > 1) 
                $pagination.= "<a href=\"$targetpage?page=$prev\">Previous</a>";
            else
                $pagination.= "<span class=\"disabled\">Previous</span>"; 
        
        //Pages 
        if ($lastpage < 7 + ($adjacents * 2))   //Not enough pages to bother breaking it up
        {   
            for ($counter = 1; $counter <= $lastpage; $counter++)
            {
                if ($counter == $page)
                    $pagination.= "<span class=\"current\">$counter</span>";
                else
                    $pagination.= "<a href=\"$targetpage?page=$counter\">$counter</a>";                 
            }
        }
        else if($lastpage > 5 + ($adjacents * 2))    //Enough pages to hide some
        {
            //Close to beginning; only hide later pages
            if($page < 1 + ($adjacents * 2))        
            {
                for ($counter = 1; $counter < 4 + ($adjacents * 2); $counter++)
                {
                    if ($counter == $page)
                        $pagination.= "<span class=\"current\">$counter</span>";
                    else
                        $pagination.= "<a href=\"$targetpage?page=$counter\">$counter</a>";                 
                }
                $pagination.= "...";
                $pagination.= "<a href=\"$targetpage?page=$lpm1\">$lpm1</a>";
                $pagination.= "<a href=\"$targetpage?page=$lastpage\">$lastpage</a>";       
            }
            //In middle; hide some front and some back
            elseif($lastpage - ($adjacents * 2) > $page && $page > ($adjacents * 2))
            {
                $pagination.= "<a href=\"$targetpage?page=1\">1</a>";
                $pagination.= "<a href=\"$targetpage?page=2\">2</a>";
                $pagination.= "...";
                for ($counter = $page - $adjacents; $counter <= $page + $adjacents; $counter++)
                {
                    if ($counter == $page)
                        $pagination.= "<span class=\"current\">$counter</span>";
                    else
                        $pagination.= "<a href=\"$targetpage?page=$counter\">$counter</a>";                 
                }
                $pagination.= "...";
                $pagination.= "<a href=\"$targetpage?page=$lpm1\">$lpm1</a>";
                $pagination.= "<a href=\"$targetpage?page=$lastpage\">$lastpage</a>";       
            }
            //Close to end; only hide early pages
            else
            {
                $pagination.= "<a href=\"$targetpage?page=1\">1</a>";
                $pagination.= "<a href=\"$targetpage?page=2\">2</a>";
                $pagination.= "...";
                for ($counter = $lastpage - (2 + ($adjacents * 2)); $counter <= $lastpage; $counter++)
                {
                    if ($counter == $page)
                        $pagination.= "<span class=\"current\">$counter</span>";
                    else
                        $pagination.= "<a href=\"$targetpage?page=$counter\">$counter</a>";                 
                }
            }
        }
        
        //Next button
        if ($page < $counter - 1) 
            $pagination.= "<a href=\"$targetpage?page=$next\">Next</a>";
        else
            $pagination.= "<span class=\"disabled\">Next</span>";
            $pagination.= "</div>\n";       
    }
?>
<?php
    foreach($result as $row){
    $address = $row['ImageJPEG'];
    $thumbnail = substr($address, 55,80);
    echo "<table>";
    echo "<tr>";
    echo "<td>";
    echo $row['ImageName'];
    echo "</td>";
    echo "</tr>";
    echo "<tr>";
    echo "<td>";
    echo '<img src="' . $thumbnail . '" width="250" height="250" alt="ImageJPEG" />'; 
    echo "</td>";
    echo "</tr>";
    echo "<tr>";
    echo "<td>";
    echo '<a href="admin_account.php?ImageID='.$row['ImageID'].'"><img src ="assets/images/remove.png"></a>';
    echo "</td>";
    echo "</tr>";
    echo "</table>";
    }
?>
<?=$pagination?>
<?php
    }
    
    //Method to deleteImage
    public 
    function deleteImage(){
        $id = $_GET['ImageID'];
        $result = $this->_db->query("SELECT * FROM thumbnails WHERE ImageID = '$id'", null, PDO::FETCH_ASSOC);
        $result2 = $this->_db->query("SELECT * FROM images WHERE ImageID = '$id'", null, PDO::FETCH_ASSOC);
        foreach($result as $row){
                   
            $address = $row['ImageJPEG'];
            $thumbnail = substr($address, 55,80);
            unlink($thumbnail);
        }
        foreach($result2 as $row) {
                
            $address2= $row['ImagePNG'];
            $address3= $row['Original'];
            $watermark = substr($address2, 55, 80);
            $original = substr($address3, 55, 80);
            unlink($watermark);
            unlink($original);
                
        }
        $result3 = $this->_db->query('DELETE FROM thumbnails WHERE ImageID = "'.$id.'" ');
        $result4 = $this->_db->query('DELETE FROM images WHERE ImageID = "'.$id.'" ');
        }
    }
?>