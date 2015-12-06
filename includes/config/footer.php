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