<?php
//main configuration file
require_once('../init_config.php');

//initial config
register_shutdown_function('script_end'); //this sets the function that runs at the end of the script.

//start database
$con = mysqli_connect($config['dbserver'], $config['dbuser'], $config['dbpass'], $config['dbtable']);
if(!$con) { die('Error'); }

//session start
session_start();

//display errors if in debug mode
$_SESSION['debug_mode'] = 1;
if(debug()) {
	error_reporting(E_ALL);
	ini_set('display_errors', 1);
}

//create user data if logged in
if(isset($_SESSION['id']) && isset($_SESSION['user'])) {
	$tid = sql_filter($_SESSION['id']); //users id
	$tuser = sql_filter($_SESSION['user']); //users email or username
	$tsessionid = sql_filter(session_id());
	$sql = sql_fetch("SELECT * FROM `users` WHERE id='$tid' AND session_id='$tsessionid' AND ( email='$tuser' OR username='$tuser' ) LIMIT 1");
	if(sql_count($sql) > 0) $main_data = sql_fetch($sql); //main users data

	//cleanup
	unset($tid); unset($tuser); unset($tsessionid);
}

?>
<?php
/////////////////////////////
///////MISC FUNCTIONS////////
/////////////////////////////
function debug() { //returns if in debug mode or not
	if($_SESSION['debug_mode'] == 1) return true;
	return false;
}
function script_end() { //this script is ran at the end of every page.
	session_write_close(); //save and end sessions on page
}

////////////////////////////
///////SQL FUNCTIONS////////
////////////////////////////
function sql_query($x) { //does main mysql pull
	global $con;
	if(debug()) $sql = mysqli_query($con, $x) or die(mysqli_error($con)); //does query pull for debug mode
	else $sql = mysqli_query($con, $x); //does query pull
	return $sql; //returns database pull
}
function sql_count($x) { //count rows
	$count = mysqli_num_rows($x); //does query pull
	return $count; //returns total
}
function sql_fetch($x) { //turn mysql into array
	$fetch = mysqli_fetch_array($x); //does query pull
	return $fetch; //returns data
}
function sql_getid() { //get last inserted id
	global $con;
	$id = mysqli_insert_id($con); //get last id of query
	return $id; //returns last insert id
}
function sql_close($x) { //close connection
	mysqli_close($x); //close query
}
function sql_filter($x) { //filter variable to make it safe for database
	global $con;
	$variable = mysqli_real_escape_string($con, $x);
	return $variable;	
}

////////////////////////////
///////USER FUNCTIONS////////
////////////////////////////
function is_logged_in() { //checks if a users data is set and logged in
	global $main_data;
	if(isset($main_data)) return true;
	return false;
}

?>