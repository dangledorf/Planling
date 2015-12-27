<?php
//send a password reset request to a user
//check token and email first
//get variables
$email = set_request('e', '');
if(empty($email) || !email_is_valid($email)){
	notices_set('Invalid email. <a href="password">Please request a new password reset.</a>', 'error');
	do_redirect();
}
$token = set_request('t', '');
if(empty($token)){
	notices_set('Invalid token. <a href="password">Please request a new password reset.</a>', 'error');
	do_redirect();
}

//check if email and token is valid
$sql = sql_query(" 	SELECT pr.id 
					FROM `password_reset` pr
						INNER JOIN `users` u
							ON u.id=pr.user
					WHERE pr.token='$token' AND pr.stamp>'".date('Y-m-d H:i:s', strtotime('-'.PASSWORD_RESET_LIFE.' hours'))."'
					LIMIT 1");
if(sql_count($sql) <= 0){ //no valid token found
	notices_set('Your token is invalid. <a href="password">Please request a new password reset.</a>', 'error');
	do_redirect();
}

//check if form submitted
if(!isset($_POST['password1']) && !isset($_POST['password2'])) return false; //variables not set yet

//get passwords
$password1 = set_post('password1', '');
$password2 = set_post('password2', '');

//error checking
$terror = false; //if an error occurred
if(!password_is_valid($password1) || !password_is_valid($password2)){
	notices_set('Invalid password - Passwords must be at least '.REQ_PASSWORD_LENGTH, 'error');
	$terror = true;
}
if($password1 != $password2){
	notices_set('Passwords do not match', 'error');
	$terror = true;
}

//last error check
if($terror){ //exit script
	echo notices_get();
	return false;
}

//hash password
$sql = sql_query(" SELECT id, hash_token FROM `users` WHERE email='$email' LIMIT 1 "); //get users unique hash token
if(sql_count($sql) <= 0){ //no user found
	notices_set('Invalid email. <a href="password">Please request a new password reset.</a>', 'error');
	do_redirect();
}
$data = sql_fetch($sql); //get user data
$password = password_encrypt( $password1, $data['hash_token'] ); //use users hash token to create password

//update users account
sql_query(" UPDATE `users` SET confirm=NULL, password='$password' WHERE id='$data[id]' AND email='$email' LIMIT 1 ");

//delete old token
sql_query(" DELETE FROM `password_reset` WHERE user='$data[id]' LIMIT 1 ");

//cleanup old tokens
sql_query(" DELETE FROM `password_reset` WHERE stamp<'".date('Y-m-d H:i:s', strtotime('-'.PASSWORD_RESET_LIFE.' hours'))."' LIMIT 500 ");

//send email
email_send( 
	'password_change', 
	'Planling Password Changed', 
	array($email => $email), 
	array('{{%LINK%}}' => 'http://'.MAIN_URL.'/password')  
	);

//set message
notices_set('Your password has successfully been changed.', 'success');

//redirect user
do_redirect();
?>