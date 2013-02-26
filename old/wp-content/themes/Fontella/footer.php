<?php get_sidebar(); ?>

<!-- begin footer -->

<div id="footermax"> <!--This layer is for the elastic design-->

<div id="footer">

	<div class="search">Search: 

		<form id="searchform" method="get" action="<?php echo $_SERVER['PHP_SELF']; ?>">
	
			<input type="text" name="s" id="s" size="20" />

		</form></div>
			
	<div class="textfooter">

		<?php bloginfo('name'); ?> is powered by <a href="http://wordpress.org">WordPress</a><br/>
		Theme <a href="http://granimpetu.com/fontella">Fontella</a> by <a href="http://granimpetu.com">Horacio Bella</a> / 
		<a href="http://jigsaw.w3.org/css-validator/validator?uri=<?php echo get_settings('home'); ?>">CSS</a> Valid / <a href="http://validator.w3.org/check?uri=referer">XHTML</a> Valid<br/>
		Sponsored by <a href="http://www.techtear.com">Techtear.com</a>
		<!--Dont delete my name please :( -->
	</div>

</div>

</div>

<?php do_action('wp_footer'); ?>

</body>

</html>