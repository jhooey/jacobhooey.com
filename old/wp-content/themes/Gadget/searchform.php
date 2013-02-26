<form id="searchform" action="<?php bloginfo( 'url' ) ?>/index.php" method="get">
	<input id="s" type="text" value="Search Keywords" onblur="this.value=!this.value?'Search Keywords':this.value;" onfocus="this.select()" onclick="this.value='';" name="s"/>
	<button id="searchsubmit" type="submit">
		<span>Search</span>
	</button>
</form>
