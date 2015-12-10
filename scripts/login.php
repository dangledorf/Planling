<?php
//logs a user in
if(is_logged_in()) return false; //user already logged in

//get variables
$user = set_post('user', '');
$password = set_post('password', '');

//check if ready
if(!isset($_POST['user']) && !isset($_POST['password'])) return false; //variables not set yet

//error checking
$terror = false; //if an error occurred
if(empty($user)){ 
	notices_set('Please provide an email or username', 'error');
	$terror = true;
}
if(!password_is_valid($password)){
	notices_set('Invalid password - Passwords must be at least '.REQ_PASSWORD_LENGTH, 'error');
	$terror = true;
}

//last error check
if($terror){ //exit script
	echo notices_get(); //show errors
	return false;
}

//login
if(do_login($user, $password)) do_redirect(); //login successful
else echo notices_get(); //show errors
?>