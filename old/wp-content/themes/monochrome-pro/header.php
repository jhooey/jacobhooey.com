<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes(); ?>> 
<head profile="http://gmpg.org/xfn/11">
	<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
	<title><?php wp_title(''); ?><?php if ( !(is_404()) && (is_single()) or (is_page()) or (is_archive()) ) { ?> :: <?php } ?>
<?php bloginfo('name'); ?></title>

	<meta name="generator" content="WordPress <?php bloginfo('version'); ?>" />
	
	<link rel="stylesheet" type="text/css" href="<?php bloginfo('stylesheet_url'); ?>" />
	<link rel="stylesheet" href="<?php bloginfo('template_directory'); ?>/css/print.css" type="text/css" media="print" />
	
<!--[if IE]><link rel="stylesheet" href="<?php bloginfo('template_directory'); ?>/css/lib/ie.css" type="text/css" media="screen, projection" /><![endif]--> 

<!--[if lt IE 7]>
	<script defer type="text/javascript" src="<?php bloginfo('template_directory'); ?>/js/pngfix.js"></script>
	<![endif]-->
<!--[if gte IE 5.5]>
   <script language="javaScript" src="<?php bloginfo('template_directory'); ?>/js/dhtml.js" type="text/javaScript"></script>
<script language="javaScript" src="<?php bloginfo('template_directory'); ?>/js/dhtml2.js" type="text/javaScript"></script>
   <![endif]-->
<!-- Show the grid and baseline  -->
<style type="text/css">
/*		.container { background: url(<?php bloginfo('template_directory'); ?>/css/lib/img/grid.png); }*/
	</style> 
	<link rel="alternate" type="application/rss+xml" title="<?php bloginfo('name'); ?> RSS Feed" href="<?php bloginfo('rss2_url'); ?>" />
	<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
	<?php wp_head(); ?>
	<script type="text/javascript">
	   jQuery(document).ready(
				function(){		
					jQuery('ul#portfolio').innerfade({
						speed: 1000,
						timeout: 5000,
						type: 'sequence',
						containerheight: '480px'
					});					
			});

  	</script>
</head>
<body>
<div class="container">
<div class="container-bg">

<!-- Top Navigation -->
<?php if (function_exists('wp_nav_menu') && has_nav_menu('top-menu')) {
		wp_nav_menu( 'sort_column=menu_order&container=&menu_id=navmenu-h-r&theme_location=top-menu&fallback_cb=' );
	} else { ?>
	<ul id="navmenu-h-r">
		<?php wp_list_categories('title_li='); ?>
	</ul>
<?php } ?>
<!-- Search -->
	<?php get_template_part('searchform.php'); ?>
<!-- Logo -->
<div class="logo"><h1><a href="<?php echo get_option('home'); ?>/" title="Return to the frontpage"><?php bloginfo('name'); ?></a></h1></div>
<?php
		if ( is_singular() &&
				has_post_thumbnail( $post->ID ) &&
				( /* $src, $width, $height */ $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), array( '950', '400' ) ) ) &&
				$image[1] >= HEADER_IMAGE_WIDTH ) :
			// Houston, we have a new header image!
			echo get_the_post_thumbnail( $post->ID, '950x400' );
		elseif ( get_header_image() ) : ?>
			<img src="<?php header_image(); ?>" width="<?php echo HEADER_IMAGE_WIDTH; ?>" height="<?php echo HEADER_IMAGE_HEIGHT; ?>" alt="<?php bloginfo('name'); ?>" class="headerimg" />
	<?php endif; ?>

<!-- Navigation -->
<div class="column span-24 large" id="nav">
<div class="content">
<?php if (function_exists('wp_nav_menu') && has_nav_menu('main-menu')) {
		wp_nav_menu( 'sort_column=menu_order&container=&menu_id=navmenu-h&theme_location=main-menu&fallback_cb=' );
	} else { ?>
	<ul id="navmenu-h">
		<li><a href="<?php echo get_option('home'); ?>">Home</a></li>
		<?php wp_list_pages('sort_column=menu_order&depth=2&title_li='); ?>
		<li class="alignright"><a href="<?php bloginfo('rss2_url'); ?>">Subscribe via RSS</a></li>
	</ul>
<?php } ?>
</div>
</div>
