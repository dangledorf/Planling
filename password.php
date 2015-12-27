<?php 
require('includes/config/config.php');
page_type_set(PAGE_TYPE_CONTENT);

if(is_logged_in()){
	//logged in - user is changing their password
	echo '
	<article>
		<h1>Change Password</h1>
		Please enter your desired password below.
		<hr>
	</article>
	<article class="boxed">
		<form method="post">
			<table class="center">
				<tr class="line-bottom">
					<td>
						<label for="_curpassword">
							Current Password:
						</label>
					</td>
					<td>
						<input type="password" name="curpassword" id="_curpassword" autocomplete="off" minlength="'.REQ_PASSWORD_LENGTH.'" maxlength="255" required>
					</td>
				</tr>
				<tr><td colspan="2"><hr></td>
				<tr>
					<td>
						<label for="_password1">
							New Password:
						</label>
					</td>
					<td>
						<input type="password" name="password1" id="_password1" autocomplete="off" minlength="'.REQ_PASSWORD_LENGTH.'" maxlength="255" required>
					</td>
				</tr>
				<tr>
					<td>
						<label for="_password2">
							Confirm Password:
						</label>
					</td>
					<td>
						<input type="password" name="password2" id="_password2" autocomplete="off" minlength="'.REQ_PASSWORD_LENGTH.'" maxlength="255" required>
					</td>
				</tr>
				<tr>
					<td colspan="2">
						<input type="submit" class="full col-bg-blue" value="Change Password">
					</td>
				</tr>
			</table>
			<input type="hidden" name="e" value="'.set_request('e', '').'">
			<input type="hidden" name="t" value="'.set_request('t', '').'">
		</form>
	</article>';
}else{
	if(!isset($_REQUEST['t'])) { //send user an email to change password
		require('scripts/password_reset.php'); //sends the user an email regarding password

		echo '
		<article>
			<h1>Password Reset - Step 1.</h1>
			If you have forgotten your password, you can request us to reset your password. If you would like to request a password change, enter your email and we will send you super-secret instructions.
			<hr>
		</article>
		<article class="boxed">
			<form method="post">
				<table class="center">
					<tr>
						<td>
							<label for="_email">
								Email:
							</label>
						</td>
						<td>
							<input type="email" name="email" id="_email" value="" autocomplete="off" maxlength="255" placeholder="wordsworth@email.com" required>
						</td>
					</tr>
					<tr>
						<td colspan="2">
							<input type="submit" class="full col-bg-blue" value="Reset Password">
						</td>
					</tr>
				</table>
			</form>
		</article>';	
	}else{ //change users password
		require('scripts/password_change.php'); //changes a users password

		echo '
		<article>
			<h1>Password Reset - Step 2.</h1>
			Hello <strong>'.$_GET['e'].'</strong>! Please enter your desired password below.
			<hr>
		</article>
		<article class="boxed">
			<form method="post">
				<table class="center">
					<tr>
						<td>
							<label for="_password1">
								New Password:
							</label>
						</td>
						<td>
							<input type="password" name="password1" id="_password1" autocomplete="off" minlength="'.REQ_PASSWORD_LENGTH.'" maxlength="255" required>
						</td>
					</tr>
					<tr>
						<td>
							<label for="_password2">
								Confirm Password:
							</label>
						</td>
						<td>
							<input type="password" name="password2" id="_password2" autocomplete="off" minlength="'.REQ_PASSWORD_LENGTH.'" maxlength="255" required>
						</td>
					</tr>
					<tr>
						<td colspan="2">
							<input type="submit" class="full col-bg-blue" value="Change Password">
						</td>
					</tr>
				</table>
				<input type="hidden" name="e" value="'.set_request('e', '').'">
				<input type="hidden" name="t" value="'.set_request('t', '').'">
			</form>
		</article>';
	}
}
?>