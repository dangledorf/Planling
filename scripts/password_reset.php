<?php
//send a password reset request to a user

//check if form submitted
if(!isset($_POST['email'])) return false; //variables not set yet

//get variables
$email = set_post('email', '');
if(empty($email) || !email_is_valid($email)){
	notices_set('Invalid email.', 'error');
	return false;
}

//check if it is valid
$sql = sql_query(" SELECT id FROM `users` WHERE email='$email' LIMIT 1 ");
if(sql_count($sql) <= 0){
	notices_set('Invalid email.', 'error');
	return false;
}
$data = sql_fetch($sql);

//create code
$confirm = confirm_token_create( $email );

//delete all tokens for that email
sql_query(" DELETE FROM `password_reset` WHERE user='$data[id]' LIMIT 1 ");

//insert
sql_query(" INSERT INTO `password_reset` (user, token) VALUES('$data[id]' , '$confirm') 
			ON DUPLICATE KEY UPDATE token='$confirm' ");

//send email
email_send( 
	'password_reset', 
	'Planling Password Reset', 
	array($email => $email), 
	array('{{%LINK%}}' => 'http://'.MAIN_URL.'/password?e='.$email.'&t='.$confirm) 
	);

//set message
notices_set('Instructions on how to reset your password has been sent to <strong>'.$email.'</strong>.', 'success');

//redirect user
do_redirect();
?>