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
	//set js vars
	var is_touch = is_touch_device(); //if its a touch device - no hovers
	function is_touch_device() {
		return (('ontouchstart' in window) || (navigator.MaxTouchPoints > 0) || (navigator.msMaxTouchPoints > 0));
	}

	//nav control
	$('#header-drop, .more').click(function() {
		$(this).toggleClass('active');
		if($(this).hasClass('more')) $(this).parent('ul').next('.dropdown:first').stop().toggle(0);
		else $(this).next('.dropdown:first').stop().toggle(0);
	}).mouseover(function() {
		if(!is_touch) $(this).addClass('hover');
	}).mouseout(function() {
		if(!is_touch) $(this).removeClass('hover');
	});

	$('nav li, nav li a').mouseover(function() {
		if(is_touch) $(this).addClass('touched');
	}).mouseout(function() {
		if(is_touch) $(this).removeClass('touched');
	});
	$(document).mouseup(function(e) { //close on other click
		var boss = $('#header nav');
		if(!boss.is(e.target) && boss.has(e.target).length === 0) navigation_close();
	});
	$(window).resize(function() { navigation_close(); }); //close on window resize
	function navigation_close() { //handles closing navigation
		$('#header-drop, .more').removeClass('hover active');
		$('#header nav .dropdown').stop().hide(0);
	}

	//flex table controls
	//label hover control
	$('label').on('mouseover', function(){
		var tid = $(this).prop('for');
		$('#'+tid).addClass('hover');
		$(this).addClass('hover');
	}).on('mouseout', function(){
		var tid = $(this).prop('for');
		$('#'+tid).removeClass('hover');
		$(this).removeClass('hover');
	});
	//input hover control
	$('input').on('mouseover', function(){
		var tid = $(this).prop('id');
		$('label[for="'+tid+'"]').addClass('hover');
		$(this).addClass('hover');
	}).on('mouseout', function(){
		var tid = $(this).prop('id');
		$('label[for="'+tid+'"]').removeClass('hover');
		$(this).removeClass('hover');
	});

	//add required styles
	$('input[required]').after('<div class="required fa fa-asterisk"></div>');

	//notices controls
	$('.notice').hide(0); //hide all notices
	$('.notice:first').fadeIn(0); //show first notice
	$('.notice > .fa').click(function(){ //user clicked notice
		$(this).parent('.notice').fadeOut('fast', function(){ //fade notice out
			$(this).next('.notice').fadeIn('fast'); //fade in next notice
			$(this).remove(); //destroy notice
		});
	});

	//parallax scrolling
	$(window).scroll(function(){
    	var scroll_offset = -($(window).scrollTop() / 10); 
		$('.parallax').css('background-position', '0 '+scroll_offset+'px'); 
		//$('.show_box_img img').css('margin-top', scroll_offset+'px');
    });
    
	/*
	//smooth scrolling
	if (window.addEventListener) window.addEventListener('DOMMouseScroll', wheel, false);
	window.onmousewheel = document.onmousewheel = wheel;
	 
	function wheel(event){
		var delta = 0;
		if (event.wheelDelta) delta = event.wheelDelta / 120;
		else if (event.detail) delta = -event.detail / 3;
	 
		handle(delta);
		if (event.preventDefault) event.preventDefault();
		event.returnValue = false;
	}
	function handle(delta){
		var time = 250; // delay time
		var distance = 300; // delta point 
		// Dom where it will apply 
		$('html, body').stop().animate({
			scrollTop: $(window).scrollTop() - (distance * delta)
		}, time );
	}
	*/

</script>