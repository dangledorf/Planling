<?php
//creates a user account
//get variables
$email1 = set_post('email1', '');
$email2 = set_post('email2', '');
$password1 = set_post('password1', '');
$password2 = set_post('password2', '');

//check if form submitted
if(!isset($_POST['email1']) || !isset($_POST['email2']) || !isset($_POST['password1']) || !isset($_POST['password2'])) return false; //variables not set yet

//error checking
$terror = false; //if an error occurred
if(!email_is_valid($email1) || !email_is_valid($email2)){
	notices_set('Invalid email address', 'error');
	$terror = true;
}
if($email1 != $email2){
	notices_set('Emails do not match', 'error');
	$terror = true;
}
if(!password_is_valid($password1) || !password_is_valid($password2)){
	notices_set('Invalid password - Passwords must be at least '.REQ_PASSWORD_LENGTH, 'error');
	$terror = true;
}
if($password1 != $password2){
	notices_set('Passwords do not match', 'error');
	$terror = true;
}

//check if user exists already
$sql = sql_query(" SELECT id FROM `users` WHERE email='$email1' LIMIT 1 ");
if(sql_count($sql) > 0){
	notices_set('Email already in use, please use a different email or reset your password', 'error');
	$terror = true;
}

//last error check
if($terror){ //exit script
	echo notices_get();
	return false;
}

//create password
$hash_token = password_hash_create(); //creates a users unique hash
$password = password_encrypt( $password1, $hash_token );

//create account confirm
$confirm = confirm_token_create( $email1 );

//add to database
sql_query(" INSERT INTO `users` (hash_token, email, password, confirm) VALUES('$hash_token', '$email1', '$password', '$confirm') ");

//log the user in
if(do_login($email1, $password1) == true) $main_data = set_main_data(); //login success - create main_data
else return false;

//success
return true;
?>