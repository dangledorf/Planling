<?php
//logs a user out
require('../includes/config/config.php');
if(!is_logged_in()) do_redirect(); //user not logged in

//clear users stored session_id
sql_query(" UPDATE `users` SET session_id=NULL WHERE id='$main_data[id]' AND email='$main_data[email]' LIMIT 1");

//destroys users session
clear_session();

//redirect user
do_redirect();
?>