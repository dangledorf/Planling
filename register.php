<?php 
require('includes/config/config.php');
page_type_set(PAGE_TYPE_CONTENT);

//scripts
require('scripts/register.php');
if(is_logged_in()) do_redirect();

echo '
<article class="boxed">
	<h1>Register</h1>
	Creating a Planling account is as easy as it gets. Fill out the form bellow to quickly gain free access to our robust tools for educators.
	<hr>
	<form method="post">
		<div class="col name">
			<label for="_email1">
				Email:
			</label>
		</div>
		<div class="col data">
			<input type="email" name="email1" id="_email1" value="'.set_post('email1','').'" autocomplete="off" maxlength="255" placeholder="wordsworth@email.com" required>
			<div class="description">Please enter your email address. You will use this to login.</div>
		</div>
		<div class="col name">
			<label for="_email2">
				Confirm Email:
			</label>
		</div>
		<div class="col data">
			<input type="email" name="email2" id="_email2" value="'.set_post('email2','').'" autocomplete="off" maxlength="255" placeholder="wordsworth@email.com" required>
			<div class="description">Confirm your email address above.</div>
		</div>
		<div class="col name">
			<label for="_password1">
				Password:
			</label>
		</div>
		<div class="col data">
			<input type="password" name="password1" id="_password1" class="short" autocomplete="off" minlength="'.REQ_PASSWORD_LENGTH.'" maxlength="255" required>
			<div class="description">Passwords must be a minimum of '.REQ_PASSWORD_LENGTH.' characters. </div>
		</div>
		<div class="col name">
			<label for="_password2">
				Confirm Password:
			</label>
		</div>
		<div class="col data">
			<input type="password" name="password2" id="_password2" class="short" autocomplete="off" minlength="'.REQ_PASSWORD_LENGTH.'" maxlength="255" required>
			<div class="description">Confirm your password above.</div>
		</div>
		<hr>
		<input type="submit" class="full col-bg-blue" value="Create Account" disabled>
	</form>
</article>';
?>