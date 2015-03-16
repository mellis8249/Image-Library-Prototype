<?php
	//Function to clean, trim and sanitize
	function clean_string($string){
		$string = trim($string);
		$string = filter_var($string, FILTER_SANITIZE_STRING);
		return $string;
	}

	?>