<?php

function redirect_to( $location = NULL ) {
  if ($location != NULL) {
    header("Location: {$location}");
    exit;
  }
}

function output_message($message="") {
  if (!empty($message)) { 
    return "<p class=\"message\">{$message}</p>";
  } else {
    return "";
  }
}


function form_errors($errors=array()){
	$output = '';
	if(!empty($errors)){
	$output.= "<div class=\"error\">";
	$output.= "pls fix the following errors:";
	$output.= "<ul>";
	foreach($errors as $key => $error){
		$output.= "<li> $error</li>";
		}
		$output.= "</ul>";
		$output.= "</div>";
	}
		
		return $output;
	}	
	


function through_value($value){
	return isset($value) && $value!=="";
}
	
function min_len($value, $passmin_len){
	return $value >= $passmin_len;
}

function in_arr($value, $aray){
	return in_array($value, $aray);
	}
	
function subj_arr_validate($value = array()){
	return !empty($value);
	}
 ?>
  