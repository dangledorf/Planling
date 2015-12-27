<?php
//main configuration file
//constants & system variables
	//locations
	define('ROOT_PATH', $_SERVER['DOCUMENT_ROOT']); //absolute file location
	define('MAIN_URL', 'localhost'); //site url
	//page type system
	$GLOBALS['PAGE_TYPE'] = 0; //current page type defined - changes what happens on script end etc
	define('PAGE_TYPE_CONTENT', 0); //main content pages
	define('PAGE_TYPE_SCRIPT', 1); //script pages
	define('PAGE_TYPE_AJAX', 2); //ajax pages
	//defaults
	define('DATE_FULL', 'F jS\, Y'); //site url
	define('TIME_FULL', 'g:ia'); //site url
	//passwords
	define('REQ_PASSWORD_LENGTH', 6); //password lengths
	define('PASSWORD_RESET_LIFE', 24); //password reset expiration time - in hours
//end constants

//load config variables
require(ROOT_PATH.'/../init_config.php');

//initial config
register_shutdown_function('script_end'); //this sets the function that runs at the end of the script.

//start database
$con = mysqli_connect($config['dbserver'], $config['dbuser'], $config['dbpass'], $config['dbtable']);
if(!$con) die('Error');

//session start
session_start();

//display errors if in debug mode
$_SESSION['debug_mode'] = 1;
if(debug()) {
	error_reporting(E_ALL);
	ini_set('display_errors', 1);
}

//create user data if logged in
$main_data = set_main_data(); //sets the users main data
if(!isset($main_data) || empty($main_data) || !$main_data || !is_array($main_data)) unset($main_data); //unset main data if not correct

//start
ob_start();
?>
<?php
/////////////////////////////
///////MISC FUNCTIONS////////
/////////////////////////////
function debug() { //returns if in debug mode or not
	if(isset($_SESSION['debug_mode'])) return true;
	return false;
}
function page_type_set($page_type) { //changes the page type to the one specified
	//set page type
	$GLOBALS['PAGE_TYPE'] = $page_type;
	//embed things
	if($GLOBALS['PAGE_TYPE'] == PAGE_TYPE_CONTENT) {
		require_once(ROOT_PATH.'/includes/config/header.php');
		//show notices
		echo notices_get();
	}
}
//variable handling
function set_post($name, $default) { //gets a post variable and cleans it
	if(!isset($_POST[$name])) return $default; //returns default
	return sql_filter(trim($_POST[$name])); //filters variable
}
function set_get($name, $default) { //gets a get variable and cleans it
	if(!isset($_GET[$name])) return $default; //returns default
	return sql_filter(trim($_GET[$name])); //filters variable
}
function set_request($name, $default) { //gets a request variable and cleans it
	if(!isset($_REQUEST[$name])) return $default; //returns default
	return sql_filter(trim($_REQUEST[$name])); //filters variable
}
function var_ext(&$var, $default = false ) { //returns the variable or if null your return 
	return isset($var) ? $var : $default;
}
//redirects
function do_redirect($location = '/') { //handles redirecting the users browser
	ob_flush(); //flush page
	header("Location: ".$location); //relocate
	exit; //end
}
//sessions
function clear_session() { //clears a session
	//clear session array
	$_SESSION = array();
	//delete session cookies
	if(ini_get("session.use_cookies")) {
    	$params = session_get_cookie_params();
    	setcookie(session_name(), '', time() - 42000,
        	$params["path"], $params["domain"],
        	$params["secure"], $params["httponly"]
    	);
    }
    //destroy session
    session_destroy();
}
function notices_set($notice, $type) { //adds a notice to a session
	//check if notices exists
	if(!isset($_SESSION['notices'])) $_SESSION['notices'] = array(); //create array of errors if not set
	//check if notices type exists
	if(!isset($_SESSION['notices'][$type])) $_SESSION['notices'][$type] = array(); //create specific notice type array
	//add notice
	$_SESSION['notices'][$type][] = '<div class="notice '.$type.'"><div class="fa fa-exclamation"></div><div class="description">'.$notice.'</div><div class="fa fa-times"></div></div>';
}
function notices_get($type = NULL) { //returns notices
	//initial check
	if(!isset($_SESSION['notices'])) return false; //no notices set
	//get notices
	$tarray = array(); //create temp array
	if(isset($type)){ //return all notices of a type
		if(!isset($_SESSION['notices'][$type])) return false; //no notices of that type set
		//copy over notices of a type
		$tarray = $_SESSION['notices'][$type];
	}else{ //return all notices
		if(count($_SESSION['notices']) <= 0) return false; //no notices
		//go through all notices
		foreach($_SESSION['notices'] as $x){
			if(count($x) <= 0) continue; //empty notice type array
			foreach($x as $z){
				$tarray[] = $z; //add types to temp array
			}
		}
	}
	//clear notices
	$_SESSION['notices'] = array();
	unset($_SESSION['notices']);
	//combine and return notices
	return '<article class="notices-shell">'.implode('', $tarray).'</article>';
}
//end script functions
function script_end() { //this script is ran at the end of every page.
	//embed footer
	if($GLOBALS['PAGE_TYPE'] == PAGE_TYPE_CONTENT) require_once(ROOT_PATH.'/includes/config/footer.php');
	//close sessions
	session_write_close();
	//clear ob
	ob_flush();
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
///////USER FUNCTIONS///////
////////////////////////////
//login and logout
function is_logged_in() { //checks if a users data is set and logged in
	global $main_data;
	if(isset($main_data)) return true;
	return false;
}
function do_login($username, $password) { //logs a user in
	//get variables
	$user = strtolower(sql_filter( $username ));
	$password = sql_filter( $password );
	//check if email or username login
	$tstring = " email='$user' ";
	if(!email_is_valid($user)) $tstring = " username='$user' ";
	//hash password
	$sql = sql_query(" SELECT hash_token FROM `users` WHERE $tstring LIMIT 1 "); //get users unique hash token
	if(sql_count($sql) <= 0){ //no user found
		notices_set('Email or username not found, please try again.', 'error');
		return false;
	}
	$data = sql_fetch($sql); //get user data
	$password = password_encrypt( $password, $data['hash_token'] ); //use users hash token to create password
	//check login info
	$sql = sql_query(" SELECT * FROM `users` WHERE $tstring AND password='$password' LIMIT 1 ");
	if(sql_count($sql) <= 0){ //wrong login info
		notices_set('Invalid password, please try again or request a password reset.', 'error');
		return false;
	}
	$data = sql_fetch($sql); //get users info
	//set session info
	if(isset($_SESSION['notices'])) $tnotices = $_SESSION['notices']; //store current notices
	clear_session(); //clear old session
	session_start(); //start new session
	session_regenerate_id(); //create new session id
	//save session id and last login
	sql_query(" UPDATE `users` SET session_id='".session_id()."', last_login=NOW() WHERE id='$data[id]' LIMIT 1 ");
	//set session variables
	$_SESSION['id'] = $data['id']; //save users id
	$_SESSION['email'] = $data['email']; //save users email
	$_SESSION['notices'] = $tnotices; //pass last notices
	//set notices
	if(isset($data['confirm'])) {
		if( date('Y-m-d') > date('Y-m-d', strtotime($data['joined'])) ){ //over a day old since joined
			notices_set('Your email is not verified. We have sent you an email to verify your account. <a href="verify_resend?e='.$email.'">Click here to send '.$email.' another confirmation code &raquo;</a>', 'alert');
		}else{ //just joined - don't tell them to reverify
			notices_set('Your email is not verified. We have sent you an email to verify your account.', 'alert');
		}
	}
	//done
	return true;
}
function set_main_data() { //sets the users universal main_data variable
	if(!isset($_SESSION['id']) || !isset($_SESSION['email'])) return false;
	//set variables
	$tid = sql_filter($_SESSION['id']); //users id
	$tuser = sql_filter($_SESSION['email']); //users email
	$tsessionid = sql_filter(session_id()); //users current session id
	$sql = sql_query("SELECT * FROM `users` WHERE id='$tid' AND session_id='$tsessionid' AND email='$tuser' LIMIT 1");
	if(sql_count($sql) > 0) return sql_fetch($sql); //main users data
	//check if logged in somewhere else
	if(isset($_COOKIE['PHPSESSID'])) { //account logged in somewhere else
		clear_session();
		session_start();
		notices_set('Your account was logged in at another location. <a href="password">If you were unaware of this, please change your password &raquo;</a>', 'alert');
	}else{ //session expired
		clear_session();
		session_start();
		notices_set('You have been logged out for inactivity.', 'alert');
	}
	//no good
	return false;
}

//emails
function email_is_valid($email) { //checks if an email is valid
	if(filter_var($email, FILTER_VALIDATE_EMAIL) && !empty($email)) return true;
	return false;
}

//passwords
function password_is_valid($password) { //checks if a password is valid
	if(!empty($password) && strlen($password) >= REQ_PASSWORD_LENGTH) return true;
	return false;
}
function password_encrypt($password, $tokens) { //encrypts a password
	global $config;
	return hash( 'sha512', md5($password.$config['passwordtoken'].$tokens) );
}
function password_hash_create() { //creates a users unique hash token
	return md5( date('jnYgis').rand(0,9999) );
}

//confirm tokens
function confirm_token_create($email) { //creates an account confirm token
	return md5( $email.date('jnYgis').rand(0,9999) );
}

////////////////////////////
///////HTML FUNCTIONS////////
////////////////////////////
function create_tag_mini($color, $text) { //draws a mini-tag
	return '<div class="mini-tag '.$color.'">'.$text.'</div>';
}
function create_tag_required() { //draws a required mini-tag
	return create_tag_mini('col-bg-red', 'Required');
}

////////////////////////////
///////EMAIL FUNCTIONS//////	
////////////////////////////
function email_init() { //inits the email system
	require_once(ROOT_PATH.'/scripts/other/mailer/mail_config.php');
	return $mail; //return created mail object
}
function email_send($format, $subject, $to = array(), $data = array()) { //sends an email
	/*
	$format: register, account, etc. This is combined to make a file name. ie. register.html
	$to: array of who you are sending this to - array('email' => 'first last name')
	$data: array of data to replace - array('{{%REPLACE_ME%}}' => 'Replacing with this')
	*/
	$mail = email_init(); //init email
	//format variables
	if(empty($format)) return false; //no email format specified
	if(!isset($subject)) $subject = 'Hello from Planling!';
	if(empty($to)) return false; //no to set
	//load html email base
	$tbase = file_get_contents(ROOT_PATH.'/includes/emails/base.html');
	//load html email content base
	$tcontent = file_get_contents(ROOT_PATH.'/includes/emails/'.$format.'.html');
	//swap keywords in content file
	foreach($data as $x => $y){
		$tcontent = str_replace($x, $y, $tcontent);
	}
	//swap keywords in base file
	$body = $tbase;
	$body = str_replace('{{%CONTENT%}}', $tcontent, $body);
	//send email
	$mail->Subject = $subject;
	$mail->Body = $body; 
	$mail->WordWrap = 50;
	$mail->MsgHTML($body);
	$mail->IsHTML(true);
	//send to each address
	foreach($to as $e => $n) {
		//add address
		$mail->AddAddress($e, $n);
		//send mail
		if(!$mail->Send()){
			//fail
		}else{
			//success
		}
		//clear addresses
		$mail->ClearAddresses();
	}
}

?>