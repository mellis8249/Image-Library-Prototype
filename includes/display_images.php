<h2> All Images: </h2>
<p> Select a Watermarked Image <p>
<?php 
    //Create instance of Db
    $db = new Db();

    //Table names
    $tbl_name="thumbnails";
    $tbl_name2="images";

    //Sets how many adjacent pages are displayed
    $adjacents = 2;
    
    //Gets the total number of rows from the database
    $query = $db->query("SELECT COUNT(*) as num FROM $tbl_name",PDO::FETCH_NUM);

    //Gets the number of rows from the $query array and stores it in $total_pages
    $total_pages = $query[0]['num'];

    //Setup vars for query.
    $targetpage = "images.php";   //your file name  (the name of this file)
    $limit = 3;                                 //how many items to show per page
    $page = $_GET['page'];
    if($page) 
        $start = ($page - 1) * $limit;          //first item to display on this page
    else
        $start = 0;                             //if no page var is given, set start to 0
    
    //Gets images from the database
    $result = $db->query("SELECT * FROM $tbl_name, $tbl_name2 WHERE $tbl_name.ImageID = $tbl_name2.ImageID LIMIT $start, $limit ",null, PDO::FETCH_ASSOC);

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
            $pagination.= "<a href=\"$targetpage?page=$prev\">� previous</a>";
        else
            $pagination.= "<span class=\"disabled\">� previous</span>"; 
        
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
            $pagination.= "<a href=\"$targetpage?page=$next\">next �</a>";
        else
            $pagination.= "<span class=\"disabled\">next �</span>";
        $pagination.= "</div>\n";       
    }
?>
<?php
foreach ($result as $row) {
    $address = $row['ImageJPEG'];
    $address2= $row['ImagePNG'];
    $address3= $row['Original'];
    $thumbnail = substr($address, 52,80);
    $watermark = substr($address2, 52, 80);
    $original = substr($address3, 52, 80);
    
    echo "<table>";
    echo "<tr>";
    echo "<th> JPEG Image </th>";
    echo "<th> Watermarked Image </th>";
    echo "</tr>";
    echo "<tr>";
    echo "<td>";
    echo '<img src="' . $thumbnail . '" width="250" height="250" alt="ImageJPEG" />'; 
    echo "</td>";
    echo "<td>";
    echo '<a href="original.php?ImageID='. $row['ImageID']. '"><img src="' . $watermark. '" width="250" height="250" alt="ImageWatermarked" ></a>'; 
    echo "</td>";
    echo "</tr>";
    echo "</table>";
    }
?>
<?=$pagination?>