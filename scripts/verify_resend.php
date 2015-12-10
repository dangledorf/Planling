<?php
//verify a users email
require('../includes/config/config.php');

//get variables
$email = set_get('e', '');

//check if it is valid
$sql = sql_query(" SELECT id, confirm FROM `users` WHERE email='$email' LIMIT 1 ");
if(sql_count($sql) <= 0){
	notices_set('Invalid email.', 'error');
	do_redirect();
}

//check if account already verified
$data = sql_fetch($sql);
if(!isset($data['confirm'])){ //account already confirmed
	notices_set('Email already confirmed.', 'success');
	do_redirect();
}

//create account confirm
$confirm = confirm_token_create( $email );

//update account with new verify code
sql_query(" UPDATE `users` SET confirm='$confirm' WHERE id='$data[id]' LIMIT 1 ");

//send email
email_send( 
	'verify-resend', 
	'Planling Verification Code', 
	array($email => $email), 
	array('{{%LINK%}}' => 'http://'.MAIN_URL.'/verify?e='.$email.'&t='.$confirm) 
	);

//set message
notices_set('Confirmation code successfully sent!', 'success');

//redirect user
do_redirect();
?>