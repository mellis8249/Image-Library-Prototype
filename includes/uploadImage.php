<?php
//Requires the bulletproof class file. 
require_once 'classes/bulletproof.class.php';

//Requires the form. 
require_once   'uploadForm.php';

//Create an instance of BulletProof
$bulletProof = new ImageUploader\BulletProof;

//Create an instance of Db
$db = new Db();

//Requires function scripts
require 'functions/sanitize.php';
require 'functions/output_errors.php';
require 'functions/escape_output.php';

// File properties
$thumbnail = $_FILES['thumbnail']['tmp_name']; 
$watermarked = $_FILES['watermarked']['tmp_name'];
$original = $_FILES['original']['tmp_name'];

    //Checks if the form has been posted, only displays error messages if the form is submitted
    if (empty($_POST) === false) {
        //Puts the required fields to check in an array called $required
        $required = array(        'ImageName',        'ImageDescription',     'category' );
        //Start of foreach loop, checks if the fields in the required array are not set or empty
        foreach ($_POST as $key => $value) {
            if (!isset($value) or empty($value) && in_array($key, $required) === true) {
                //Creates an array called $errors
                $errors   = array();
                //Puts an error message into the $error array
                $errors[] = 'Please fill in all fields';
                //Breaks away from this foreach loop
                break 1;
            }
        }
    }

    //Checks if the form has been posted, only displays error messages if the form is submitted
    if (empty($_POST) === false){
        //Checks if $thumbnail is not set or empty
        if (!isset($thumbnail) or empty($thumbnail)){
        //Puts an error message into the $error array
        $errors[] = "Please select a Thumbnail";
        }
        //Checks if $watermarked is not set or empty
        if (!isset($watermarked) or empty($watermarked)){
        //Puts an error message into the $error array
        $errors[] = "Please select a Watermark";
        }
        //Checks if $original is not set or empty
        if (!isset($original) or empty($original)){
        //Puts an error message into the $error array
        $errors[] = "Please select a Original";
        }
    }

    //Checks if the form has been posted, only displays error messages if the form is submitted
    if (empty($_POST) === false){
        //Checks if $thumbnail is set and not empty
        if (isset($thumbnail) && !empty($thumbnail)){
            //Uses getimagesize and stores the result in $image_size
            $image_size = getimagesize($thumbnail);
            //Stores the file size in $file_size
            $file_size = $_FILES['thumbnail']['size'] > 2000000;
            //Creates an array called $whitelist
            $whitelist = array('.jpg', '.jpeg', '.gif');
            //$Stores the file extension in $fileExtension
            $fileExtension = strrchr($_FILES['thumbnail']['name'], ".");
            //$Stores the file type in $filetype
            $filetype = $_FILES['thumbnail']['type'];
            //Stores upload type in $pos
            $pos = strpos($filetype, 'image');
            //Checks if $image_size is false
            if($image_size===FALSE) {
                //Checks if the image extension is not in the whitelist 
                if (!(in_array($fileExtension, $whitelist))) {
                    //Checks if the upload type is false
                    if ($pos === FALSE){
                        //Puts an error message into the $error array 
                        $errors[] ='Please select a valid  JPEG or GIF Image';
                        //Checks if the file size is valid
                        if ($file_size===TRUE){
                            //Puts an error message into the $error array
                            $errors[] ='Please select a image file below 2Mb';
                        }
                    }
                }
            }
        }

    //Checks if $watermarked is set and not empty
    if (isset($watermarked) && !empty($watermarked)){
        //Uses getimagesize and stores the result in $image_size
        $image_size1 = getimagesize($watermarked);
        //Stores the file size in $file_size
        $file_size = $_FILES['watermarked']['size'] > 6000000;
        //Creates an array called $whitelist
        $whitelist = array('.png');
        //$Stores the file extension in $fileExtension
        $fileExtension = strrchr($_FILES['watermarked']['name'], ".");
        //$Stores the file type in $filetype
        $filetype = $_FILES['watermarked']['type'];
        //Stores upload type in $pos
        $pos = strpos($filetype, 'image');
        //Checks if $image_size is false
        if($image_size===FALSE) {
            //Checks if the image extension is not in the whitelist 
            if (!(in_array($fileExtension, $whitelist))) {
                //Checks if the upload type is false
                if ($pos === FALSE){
                    //Puts an error message into the $error array
                    $errors[] ='Please select a valid  PNG Image';
                    //Checks if the file size is valid
                    if ($file_size===TRUE){
                        //Puts an error message into the $error array
                        $errors[] ='Please select a image file below 5Mb';
                    }
                }
            }
        }
    }

    //Checks if $watermarked is set and not empty
    if (isset($original) && !empty($original)){
        //Uses getimagesize and stores the result in $image_size
        $image_size2 = getimagesize($original);
        //Stores the file size in $file_size
        $file_size = $_FILES['original']['size'] > 6000000;
        //Creates an array called $whitelist
        $whitelist = array('.png');
        //$Stores the file extension in $fileExtension
        $fileExtension = strrchr($_FILES['original']['name'], ".");
        //$Stores the file type in $filetype
        $filetype = $_FILES['original']['type'];
        //Stores upload type in $pos
        $pos = strpos($filetype, 'image');
        //Checks if $image_size is false
        if($image_size===FALSE) {
            //Checks if the image extension is not in the whitelist 
            if (!(in_array($fileExtension, $whitelist))) {
                //Checks if the upload type is false
                if ($pos === FALSE){
                    //Puts an error message into the $error array
                    $errors[] ='Please select a valid PNG Image';
                    //Checks if the file size is valid
                    if ($file_size===TRUE){
                        //Puts an error message into the $error array
                        $errors[] ='Please select a image file below 5Mb';
                    }
                }
            }
        }
    }
    //Checks if the watermarked image is not the same as the original image
    if ($image_size1 != $image_size2){
        $errors[] = 'Watermarked and Original must be the same image';
    }
    }
    
    //Outputs errors if they exist
    if (isset($errors)) {
        output_errors($errors);
    }

    
  //If there are errors, uses the output_errors function to output the errors to the screen
  if (empty($errors)){
  if ($_POST['upload']) {

            //Checks if the field is set and not empty and puts the $_POST into a variable
            if (isset($_POST['ImageName']) && !empty($_POST['ImageName'])) {
                $ImageName = $_POST['ImageName'];
            }

            //Checks if the field is set and not empty and puts the $_POST into a variable
            if (isset($_POST['ImageDescription']) && !empty($_POST['ImageDescription'])) {
                $ImageDescription = $_POST['ImageDescription'];
            }

            //Checks if the field is set and not empty and puts the $_POST into a variable
            if (isset($_POST['category']) && !empty($_POST['category'])) {
                $category = $_POST['category'];
            }

        //Start of try Catch
        try {
        if($_FILES){
            //Stores $bulletproof (which includes the upload path) in $thumbnail
            $thumbnail = $bulletProof
            //Uses the bulletproof class to check for invalid file types
            ->fileTypes(array("gif", "jpg", "jpeg"))
            //Uses the bulletproof class to check for an invalid file size
            ->limitSize(array("min"=>1, "max"=>2000000))
            //Uses the bulletproof class to check for invalid file dimensions
            ->limitDimension(array("height"=>1200, "width"=>1200))
            //Uses the bulletproof class to shrink the image to the specified values
            ->shrink(array("height"=>250, "width"=>250))
            //Uses the bulletproof class to specify the upload directory and creates one if it doesn't exist
            ->uploadDir("/customers/b/5/2/valadan.co.uk//httpd.www/ImageLibrary/includes/thumbnails")
            //Uses the bulletproof class to upload the file and store values in $bulletproof
            ->upload($_FILES['thumbnail']);
        }

        //Create an instance of BulletProof
        $bulletProof2 = new ImageUploader\BulletProof;

        if($_FILES){
            //Stores $bulletproof2 (which includes the upload path) in $watermarked
            $watermarked = $bulletProof2
            //Uses the bulletproof class to check for invalid file types
            ->fileTypes(array("png"))
            //Uses the bulletproof class to check for an invalid file size
            ->limitSize(array("min"=>1, "max"=>6000000))
            //Uses the bulletproof class to check for invalid file dimensions
            ->limitDimension(array("height"=>3000, "width"=>3000))
            //Uses the bulletproof class to watermark the image, with the specified watermark image
            ->watermark('assets/images/watermark3.png', 'center')
            //Uses the bulletproof class to specify the upload directory and creates one if it doesn't exist
            ->uploadDir("/customers/b/5/2/valadan.co.uk//httpd.www/ImageLibrary/includes/watermarked")
            //Uses the bulletproof class to upload the file and store values in $bulletproof2
            ->upload($_FILES['watermarked']);
        }

        //Create an instance of BulletProof
        $bulletProof3 = new ImageUploader\BulletProof;

        if($_FILES){
            //Stores $bulletproof3 (which includes the upload path) in $original
            $original = $bulletProof3
            //Uses the bulletproof class to check for invalid file types
            ->fileTypes(array("png"))
            //Uses the bulletproof class to check for an invalid file size
            ->limitSize(array("min"=>1, "max"=>6000000))
            //Uses the bulletproof class to check for invalid file dimensions
            ->limitDimension(array("height"=>3000, "width"=>3000))
            //Uses the bulletproof class to specify the upload directory and creates one if it doesn't exist
            ->uploadDir("/customers/b/5/2/valadan.co.uk//httpd.www/ImageLibrary/includes/originals") 
            //Uses the bulletproof class to upload the file and store values in $bulletproof3
            ->upload($_FILES['original']);
        }


        //Uses the clean_string function to trim and sanitize the variables
        $ImageName  = clean_string($ImageName);
        $ImageDescription  = clean_string($ImageDescription);
        $category     = clean_string($category);
        //$thumbnail = clean_string($thumbnail);
        //$watermarked = clean_string($watermarked);
        //$original = clean_string($original);
        //Uses the escape_output function to convert characters to HTML entities
        $ImageName  = escape_output($ImageName);
        $ImageDescription  = escape_output($ImageDescription);
        $category     = escape_output($category);
        //$thumbnail = escape_output($category);
        //$watermarked = escape_output($original);
        //$original = escape_output($original);

        list($width, $height) = $image_size2;
        
        $total_pixels = $width * $height; 
        $megapixels = '' .round($total_pixels / 1000000, 1);
        
        $dpiWidth200 = $width / 200;
        $dpiHeight200 = $height / 200;
        
        $dpiWidth300 = $width / 300;
        $dpiHeight300 = $height / 300;
        
        if ($width >= 0 && $height >= 0){
            if ($width <= 320 && $height <= 240){
                $price = "2.00";
            }
            if ($width >= 640 && $height >= 480){
                $price = "4.00";
            }
            if ($width >= 1024 && $height >= 768){
                $price = "5.00";
            }
            if ($width >= 1280 && $height >= 960){
                $price = "6.00";
            }
            if ($width >= 1536 && $height >= 1180){
                $price = "8.00";
            }
            if ($width >= 1600 && $height >= 1200){
                $price = "9.00";
            }
            if ($width >= 2048 && $height >= 1536){
                $price = "10.00";
            }
            if ($width >= 3032 && $height >= 2008){
                $price = "12.00";
            }
        }
        
        if (isset($_SESSION['username'])){
            $author = $_SESSION['username'];
        }
        //Creates the query to insert item into the database and runs the query and stores the result in $result
        $result =  $db->query("INSERT INTO thumbnails(ImageName, ImageDescription, Category, Author,  ImageJPEG, ImageFile) VALUES('$ImageName', '$ImageDescription', '$category', '$author', '$thumbnail', '$thumbnail')");
        //Creates the query to insert item into the database and runs the query and stores the result in $result
        $result = $db->query("INSERT INTO images (ImageName, ImageDescription, Category, Author, Price, ImagePNG, Original, ImageWidth, ImageHeight, MegaPixels, DPIWidth200, DPIHeight200, DPIWidth300, DPIHeight300, ImageFile) VALUES('$ImageName', '$ImageDescription', '$category', '$author', '$price', '$watermarked', '$original', '$width', '$height', '$megapixels', '$dpiWidth200', '$dpiHeight200', '$dpiWidth300', '$dpiHeight300', '$watermarked')");
        //If query is successful, outputs the below message to the screen
        echo 'Insert successful';
        
       // print_r($image_size2[3]);
      //  echo $image_size2;
        //print_r($image_size2['width']);

        } catch(\ImageUploader\ImageUploaderException $e){
            //Displays error message from the bulletproof class
            echo $e->getMessage();
            echo '</br>';
            echo '</br>';
        } //End of Try Catch
    }
}

?>