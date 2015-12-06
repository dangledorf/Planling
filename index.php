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
						
						<div id="header-drop" class="fa fa-bars"></div>
						<ul class="dropdown">
							<li class="home"><a href=""><div class="fa fa-home"></div>Home</a></li>
							<li class="create"><a href=""><div class="fa fa-book"></div>Create</a></li>
							<li class="explore"><a href=""><div class="fa fa-star"></div>Explore</a></li>
							<li class="alerts"><a href=""><div class="fa fa-envelope"></div>Alerts</a></li>
							<li class="account"><a href=""><div class="fa fa-user"></div>Account</a></li>
							<li class="help"><a href=""><div class="fa fa-question"></div>Help</a></li>
							<li class="logout"><a href=""><div class="fa fa-sign-out"></div>Logout</a></li>
						</ul>
					</nav>
				</article>
			</div>

			<div id="latest-shell">
				<article id="latest">
					<h1>Your upcoming lessons</h1>
					<table>
						<tr>
							<th class="tab"></th>
							<th>day</th>
							<th>time</th>
							<th>class</th>
							<th class="lesson">lesson</th>
							<th class="description">description</th>
							<th class="view"></th>
						</tr>

						<tr>
							<td class="tab col-bg-orange-red"><div class="fa fa-pencil"></div></td>
							<td>Monday<div class="date">October 14th, 2015</div><div class="date-small">10-15-2015</div></td>
							<td>1:00pm - 2:00pm</td>
							<td>Algebra I</td>
							<td class="lesson">Learning the basics</td>
							<td class="description">Much description, wow!</td>
							<td class="view"><a href="" class="btn col-bg-orange-red">View <div class="fa fa-arrow-circle-right"></div></td></td>
						</tr>
						<tr>
							<td class="tab col-bg-green"><div class="fa fa-pencil"></div></td>
							<td>Monday<div class="date">October 14th, 2015</div><div class="date-small">10-15-2015</div></td>
							<td>1:00pm - 2:00pm</td>
							<td>Algebra I</td>
							<td class="lesson">Learning the basics</td>
							<td class="description">Much description, wow!</td>
							<td class="view"><a href="" class="btn col-bg-green">View <div class="fa fa-arrow-circle-right"></div></td></td>
						</tr>
						<tr>
							<td class="tab col-bg-blue"><div class="fa fa-pencil"></div></td>
							<td>Monday<div class="date">October 14th, 2015</div><div class="date-small">10-15-2015</div></td>
							<td>1:00pm - 2:00pm</td>
							<td>Algebra I</td>
							<td class="lesson">Learning the basics</td>
							<td class="description">Much description, wow!</td>
							<td class="view"><a href="" class="btn col-bg-blue">View <div class="fa fa-arrow-circle-right"></div></td></td>
						</tr>
						<tr>
							<td class="tab col-bg-orange"><div class="fa fa-pencil"></div></td>
							<td>Monday<div class="date">October 14th, 2015</div><div class="date-small">10-15-2015</div></td>
							<td>1:00pm - 2:00pm</td>
							<td>Algebra I</td>
							<td class="lesson">Learning the basics</td>
							<td class="description">Much description, wow!</td>
							<td class="view"><a href="" class="btn col-bg-orange">View <div class="fa fa-arrow-circle-right"></div></td></td>
						</tr>
					</table>
					<a href="" class="btn btn-simple col-bg-sky-blue view-all full">View All</a>
				</article>
			</div>
			<div id="footer-push"></div>
		</div>

		<footer>
			<article>
				Footer Foo!
			</article>
		</footer>
	</body>
</html>
<script>
	//site control
	$('#header-drop, .more').click(function(){
		$(this).toggleClass('active');
		if($(this).hasClass('more')) $(this).parent('ul').next('.dropdown:first').stop().toggle(0);
		else $(this).next('.dropdown:first').stop().toggle(0);
	}).mouseover(function(){
		$(this).addClass('hover');
	}).mouseout(function(){
		$(this).removeClass('hover');
	});
	//close on other click
	$(document).mouseup(function(e){
		var boss = $('#header nav');
		if(!boss.is(e.target) && boss.has(e.target).length === 0) navigation_close();
	});
	//close on window resize
	$(window).resize(function(){ navigation_close(); });
	//
	function navigation_close(){
		$('#header-drop, .more').removeClass('hover active');
		$('#header nav .dropdown').stop().hide(0);
	}
</script>