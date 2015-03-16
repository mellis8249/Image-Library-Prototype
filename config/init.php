<?php 
session_start();
error_reporting(0);
//require 'configuration.php';

function __autoload($class_name) {
  require_once 'includes/classes/'.$class_name . '.class.php';
}


//require_once   'includes/classes/Db.class.php';
?>