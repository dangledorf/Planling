<?php 
require('includes/config/config.php');
page_type_set(PAGE_TYPE_CONTENT);

if(!is_logged_in()) do_redirect(); //cannot be here unless logged in

echo '
<article class="boxed">
	<h1>My Account</h1>
	<hr>
	<div class="col name">
		<label for="_username">
			Username:
		</label>
	</div>
	<div class="col data">
		<input type="text" name="username" class="short" id="_username" value="'.$main_data['username'].'" autocomplete="off" maxlength="255" placeholder="wordsworth">
		<div class="description">Lorem Ipsum is simply dummy text of the printing and typesetting industry.</div>
	</div>

	<div class="col name">
		<label for="_email">
			Email:
		</label>
	</div>
	<div class="col data">
		<input type="email" name="email" id="_email" value="'.$main_data['email'].'" autocomplete="off" maxlength="255" placeholder="wordsworth@email.com">
		<div class="description">Lorem Ipsum is simply dummy text of the printing and typesetting industry.</div>
	</div>

	<div class="col name">Password</div>
	<div class="col data">
		<a href="password">Change Password <div class="fa fa-arrow-circle-right"></div></a>
		<div class="description">Lorem Ipsum is simply dummy text of the printing and typesetting industry.</div>
	</div>

	<hr>
	<div class="col name">
		<label for="_newsletter">
			Newsletter:
		</label>
	</div>
	<div class="col data">
		<input type="checkbox" name="newsletter" id="_newsletter" value="1">
		<div class="description">Lorem Ipsum is simply dummy text of the printing and typesetting industry.</div>
	</div>

	<hr>
	<div class="col name">Last Login:</div>
	<div class="col data">'.date( DATE_FULL.' \a\t '.TIME_FULL, strtotime($main_data['last_login']) ).'</div>

	<div class="col name">Joined:</div>
	<div class="col data">'.date( DATE_FULL, strtotime($main_data['joined']) ).'</div>

	<hr>
	<input type="submit" class="col-bg-blue" value="Save Changes" disabled>
</article>'
?>