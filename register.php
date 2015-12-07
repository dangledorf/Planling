<?php 
require('includes/config/config.php');
page_type_set(PAGE_TYPE_CONTENT);

//scripts
require('scripts/register/register.php');
if(is_logged_in()) do_redirect();

echo '
<article>
	<form action="" method="post">
		<div class="flex_table">
			<div class="flex_tr">
				<div class="flex_td flex_small">
					<label for="_email1">
						Email:'.create_tag_required().'
					</label>
				</div>
				<div class="flex_td">
					<input type="email" name="email1" id="_email1" value="'.set_post('email1','').'" autocomplete="off" maxlength="255" placeholder="wordsworth@email.com" required>
				</div>
			</div>
			<div class="flex_tr">
				<div class="flex_td flex_small">
					<label for="_email2">
						Confirm Email:'.create_tag_required().'
					</label>
				</div>
				<div class="flex_td">
					<input type="email" name="email2" id="_email2" value="'.set_post('email2','').'" autocomplete="off" maxlength="255" placeholder="wordsworth@email.com" required>
				</div>
			</div>
			<div class="flex_tr">
				<div class="flex_td flex_small">
					<label for="_password1">
						Password:'.create_tag_required().'
					</label>
				</div>
				<div class="flex_td">
					<input type="password" name="password1" id="_password1" autocomplete="off" minlength="'.REQ_PASSWORD_LENGTH.'" maxlength="255" required>
				</div>
			</div>
			<div class="flex_tr">
				<div class="flex_td flex_small">
					<label for="_password2">
						Confirm Password:'.create_tag_required().'
					</label>
				</div>
				<div class="flex_td">
					<input type="password" name="password2" id="_password2" autocomplete="off" minlength="'.REQ_PASSWORD_LENGTH.'" maxlength="255" required>
				</div>
			</div>
			<div class="flex_tr">
				<input type="submit" class="col-bg-blue" value="Create Account">
			</div>
		</div>
	</form>
</article>';
?>