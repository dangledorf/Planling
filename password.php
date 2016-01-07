<?php 
require('includes/config/config.php');
page_type_set(PAGE_TYPE_CONTENT);

if(is_logged_in()){
	//logged in - user is changing their password
	echo '
	<article class="boxed">
		<h1>Change Password</h1>
		Please enter your desired password below.
		<hr>
		<form method="post">
			<div class="col name">
				<label for="_curpassword">
					Current Password:
				</label>
			</div>
			<div class="col data">
				<input type="password" name="curpassword" id="_curpassword" autocomplete="off" minlength="'.REQ_PASSWORD_LENGTH.'" maxlength="255" required>
				<div class="description">Lorem Ipsum is simply dummy text of the printing and typesetting industry.</div>
			</div>
			<hr>

			<div class="col name">
				<label for="_password1">
					New Password:
				</label>
			</div>
			<div class="col data">
				<input type="password" name="password1" id="_password1" autocomplete="off" minlength="'.REQ_PASSWORD_LENGTH.'" maxlength="255" required>
				<div class="description">Lorem Ipsum is simply dummy text of the printing and typesetting industry.</div>
			</div>

			<div class="col name">
				<label for="_password2">
					Confirm Password:
				</label>
			</div>
			<div class="col data">
				<input type="password" name="password2" id="_password2" autocomplete="off" minlength="'.REQ_PASSWORD_LENGTH.'" maxlength="255" required>
				<div class="description">Lorem Ipsum is simply dummy text of the printing and typesetting industry.</div>
			</div>

			<hr>
			<input type="submit" class="full col-bg-blue" value="Change Password">
			<input type="hidden" name="e" value="'.set_request('e', '').'">
			<input type="hidden" name="t" value="'.set_request('t', '').'">
		</form>
	</article>';
}else{
	if(!isset($_REQUEST['t'])) { //send user an email to change password
		require('scripts/password_reset.php'); //sends the user an email regarding password

		echo '
		<article class="boxed">
			<h1>Password Reset - Step 1.</h1>
			If you have forgotten your password, you can request us to reset your password. If you would like to request a password change, enter your email and we will send you super-secret instructions.
			<hr>
			<form method="post">
				<div class="col name">
					<label for="_email">
						Email:
					</label>
				</div>
				<div class="col data">
					<input type="email" name="email" id="_email" value="" autocomplete="off" maxlength="255" placeholder="wordsworth@email.com" required>
					<div class="description">Lorem Ipsum is simply dummy text of the printing and typesetting industry.</div>
				</div>
				<hr>
				<input type="submit" class="full col-bg-blue" value="Reset Password">
			</form>
		</article>';
	}else{ //change users password
		require('scripts/password_change.php'); //changes a users password

		echo '
		<article class="boxed">
			<h1>Password Reset - Step 2.</h1>
			Hello <strong>'.$_GET['e'].'</strong>! Please enter your desired password below.
			<hr>
			<form method="post">
				<div class="col name">
					<label for="_password1">
						New Password:
					</label>
				</div>
				<div class="col data">
					<input type="password" name="password1" id="_password1" autocomplete="off" minlength="'.REQ_PASSWORD_LENGTH.'" maxlength="255" required>
					<div class="description">Lorem Ipsum is simply dummy text of the printing and typesetting industry.</div>
				</div>

				<div class="col name">
					<label for="_password2">
						Confirm Password:
					</label>
				</div>
				<div class="col data">
					<input type="password" name="password2" id="_password2" autocomplete="off" minlength="'.REQ_PASSWORD_LENGTH.'" maxlength="255" required>
					<div class="description">Lorem Ipsum is simply dummy text of the printing and typesetting industry.</div>
				</div>

				<hr>
				<input type="submit" class="full col-bg-blue" value="Change Password">
				<input type="hidden" name="e" value="'.set_request('e', '').'">
				<input type="hidden" name="t" value="'.set_request('t', '').'">
			</form>
		</article>';
	}
}
?>