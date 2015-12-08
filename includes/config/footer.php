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
	$('.notice').click(function(){ //user clicked notice
		$(this).fadeOut('fast', function(){ //fade notice out
			$(this).remove(); //destroy notice
		});
	});

</script>