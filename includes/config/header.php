<!doctype html>
<html dir="ltr" lang="en-US">
    <head>
        <meta charset='utf-8'>
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
        <meta name="author" content="Planling">

        <title>Planling</title>

        <link href="styles/reset.css" rel="stylesheet" type="text/css" />
        <link href="styles/main.css" rel="stylesheet" type="text/css" />
        <link href="styles/responsive.css" rel="stylesheet" type="text/css" />
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js" type="text/javascript"></script>
    </head>
	<body>
		<div id="main-wrapper">
			<div id="header">
				<article>
					<a class="logo" href=""><img src="images/header_logo.png" alt="Planling"></a>
					<nav>
						<?php
						if(is_logged_in()){ //user logged in
							echo '
							<ul class="inline">
								<li class="home"><a href=""><div class="fa fa-home"></div></a></li>
								<li class="create"><a href=""><div class="fa fa-book"></div>&nbsp;&nbsp;Create</a></li>
								<li class="explore"><a href=""><div class="fa fa-star"></div>&nbsp;&nbsp;Explore</a></li>
								<li class="alerts"><a href="" class="fa fa-envelope"></a></li>
								<li class="help"><a href="" class="fa fa-question"></a></li>
								<li class="more">
									<img src="images/test_avatar.jpg">
									<div class="fa fa-bars"></div>
								</li>
							</ul>

							<ul id="main-drop" class="dropdown">
								<li class="account"><a href=""><div class="fa fa-user"></div>Account</a></li>
								<li class="logout"><a href=""><div class="fa fa-sign-out"></div>Logout</a></li>
							</ul>

							<div id="header-drop">
								<img src="images/test_avatar.jpg">
								<div class="fa fa-bars"></div>
							</div>
							<ul class="dropdown">
								<li class="home"><a href=""><div class="fa fa-home"></div>Home</a></li>
								<li class="create"><a href=""><div class="fa fa-book"></div>Create</a></li>
								<li class="explore"><a href=""><div class="fa fa-star"></div>Explore</a></li>
								<li class="alerts"><a href=""><div class="fa fa-envelope"></div>Alerts</a></li>
								<li class="account"><a href=""><div class="fa fa-user"></div>Account</a></li>
								<li class="help"><a href=""><div class="fa fa-question"></div>Help</a></li>
								<li class="logout"><a href=""><div class="fa fa-sign-out"></div>Logout</a></li>
							</ul>';

						}else{ //user not logged in
							echo '
							<ul class="inline">
								<li class="home"><a href=""><div class="fa fa-home"></div></a></li>
								<li class="create"><a href=""><div class="fa fa-book"></div>&nbsp;&nbsp;Create</a></li>
								<li class="explore"><a href=""><div class="fa fa-star"></div>&nbsp;&nbsp;Explore</a></li>
								<li><a href="">Login</a></li>
								<li><a href="">Register<div class="mini-tag col-bg-blue">Free!</div></a></li>
							</ul>

							<div id="header-drop"><div class="fa fa-bars"></div></div>
							<ul class="dropdown">
								<li class="home"><a href=""><div class="fa fa-home"></div>Home</a></li>
								<li class="create"><a href=""><div class="fa fa-book"></div>Create</a></li>
								<li class="explore"><a href=""><div class="fa fa-star"></div>Explore</a></li>
								<li class="alerts"><a href=""><div class="fa fa-sign-in"></div>Login</a></li>
								<li class="help"><a href=""><div class="fa fa-user"></div>Register<div class="mini-tag col-bg-blue">Free!</div></a></li>
							</ul>';
						}
						?>

					</nav>
				</article>
			</div>