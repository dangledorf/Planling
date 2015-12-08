<?php 
require('includes/config/config.php');
page_type_set(PAGE_TYPE_CONTENT);

//scripts
require('scripts/register/register.php');
if(is_logged_in()) do_redirect();

echo '
<article>
	<form method="post">
		<table class="center">
			<tr>
				<td>
					<label for="_email1">
						Email:
					</label>
				</td>
				<td>
					<input type="email" name="email1" id="_email1" value="'.set_post('email1','').'" autocomplete="off" maxlength="255" placeholder="wordsworth@email.com" required>
				</td>
			</tr>
			<tr>
				<td>
					<label for="_email2">
						Confirm Email:
					</label>
				</td>
				<td>
					<input type="email" name="email2" id="_email2" value="'.set_post('email2','').'" autocomplete="off" maxlength="255" placeholder="wordsworth@email.com" required>
				</td>
			</tr>
			<tr>
				<td>
					<label for="_password1">
						Password:
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
					<input type="submit" class="full col-bg-blue" value="Create Account">
				</td>
			</tr>
		</table>
	</form>
</article>';

?>