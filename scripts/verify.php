<?php
//verify a users email
require('../includes/config/config.php');

//get variables
$email = set_get('e', '');
$confirm = set_get('t', '');
if(empty($email) || !email_is_valid($email)){
	notices_set('Invalid email.', 'error');
	do_redirect();
}
if(empty($confirm)){
	notices_set('Invalid confirmation code.', 'error');
	do_redirect();
}

//check if it is valid
$sql = sql_query(" SELECT id, confirm FROM `users` WHERE email='$email' LIMIT 1 ");
if(sql_count($sql) <= 0){
	notices_set('Invalid email.', 'error');
	do_redirect();
}

//check if confirm is already cleared
$data = sql_fetch($sql);
if(!isset($data['confirm'])){ //account already confirmed
	notices_set('Email already confirmed.', 'error');
	do_redirect();
}else if($data['confirm'] != $confirm){
	notices_set('Invalid confirmation code. <a href="verify_resend?e='.$email.'">Click here to send '.$email.' another confirmation code &raquo;</a>', 'error');
	do_redirect();
}

//verify users account
sql_query(" UPDATE `users` SET confirm=NULL WHERE email='$email' AND confirm='$confirm' LIMIT 1 ");

//set message
notices_set('Email successfully verified! Have a good day!', 'success');

//redirect user
do_redirect();
?>