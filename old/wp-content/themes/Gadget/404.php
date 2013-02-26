<?php get_header(); ?>
	
	<div id="main">
		
		<h1>Not Found</h1>
		
		<p>Try searching</p>
		
		<form id="searchform" action="http://themejam.com/demos/gadget/index.php" method="get">
			<input id="s" type="text" value="Search Keywords" onblur="this.value=!this.value?'Search Keywords':this.value;" onfocus="this.select()" onclick="this.value='';" name="s"/>
			<button id="searchsubmit" type="submit">
				<span>Search</span>
			</button>
		</form>
	
	</div><!-- END: #main -->		
		
<?php get_sidebar(); ?>	

<?php get_footer(); ?>