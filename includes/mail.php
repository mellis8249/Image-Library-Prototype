<?php
//Requires the form. 
require_once   'form2.php';

$selected = $_GET['ImageID'];

//Create an instance of Db
$db = new Db();

$result = $db->query("SELECT Original FROM images WHERE ImageID = $selected", null, PDO::FETCH_ASSOC);

$address = $row['ImageJPEG'];
$address2= $row['ImagePNG'];
$address3= $row['Original'];
$thumbnail = substr($address, 52,80);
$watermark = substr($address2, 52, 80);
$original = substr($address3, 52, 80);

//Requires the function scripts
require 'functions/sanitize.php';
require 'functions/output_errors.php';
require 'functions/escape_output.php';

if (empty($_POST) === false) {
    //Puts the required fields to check in an array called $required
    $required = array(        'firstname',        'lastname',        'email'    );
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

    //Checks if there are any errors in the $error array
    
    if (empty($errors) === true) {
      //Checks if the email the user inputs is a valid email 
      
      if (filter_var($_POST['email'], FILTER_VALIDATE_EMAIL) === false) {
        //Puts an error message into the $error array
        $errors[] = 'A valid email address is required';
      }

    }

  }

  //Checks if any errors exist in the $error array, if so uses the output_errors function to output the error messages to the screen
  
  if (isset($errors)) {
    output_errors($errors);
  }

  //Checks if the form has been posted, only displays error messages if the form is submitted
  
  if (empty($_POST) === false) {
    //Checks if there are any errors in the $error array
    
    if (empty($errors)) {
      
      if ($_POST['submit']) {
        //Checks if the field is set and not empty and puts the $_POST into a variable
        
        if (isset($_POST['firstname']) && !empty($_POST['firstname'])) {
          $firstname = $_POST['firstname'];
        }

        //Checks if the field is set and not empty and puts the $_POST into a variable
        
        if (isset($_POST['lastname']) && !empty($_POST['lastname'])) {
          $lastname = $_POST['lastname'];
        }

        //Checks if the field is set and not empty and puts the $_POST into a variable
        
        if (isset($_POST['email']) && !empty($_POST['lastname'])) {
          $email = $_POST['email'];
        }

        //Uses the clean_string function to trim and sanitize the variables
        $firstname = clean_string($firstname);
        $lastname  = clean_string($lastname);
        $email     = clean_string($email);
        //Uses the escape_output function to convert characters to HTML entities
        $firstname = escape_output($firstname);
        $lastname  = escape_output($lastname);
        $email     = escape_output($email);
        $from = "m.ellis@valadan.co.uk";
        $to = $_POST['email'];
        $subject = "Image request";
        $subject2 = "Copy of Image request";
        $message1 = $firstname . " " . $lastname . "\n\n" . "Thank you for selecting the following image:" . "\n\n" .  "www.valadan.co.uk/prototype/$original";
        $message2 = $firstname . " " . $lastname . "\n\n" . "Selected the following image:" . "\n\n" .  "www.valadan.co.uk/prototype/$original";
        $headers = "From:" . $to;
        $headers = "From:" . $from;
        
        mail($to, $subject, $message1, $headers);
        mail($from, $subject2, $message2, $headers2);
        echo "Mail Sent. Thank you " . $firstname . ", check your email for the Original image."; 
        
      }

    }

  }





?>