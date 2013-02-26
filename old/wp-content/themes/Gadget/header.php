<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes(); ?>>
<head profile="http://gmpg.org/xfn/11">
    <title>
        <?php if ( is_single() ) { single_post_title(); }       
        elseif ( is_home() || is_front_page() ) { bloginfo('name'); print ' | '; bloginfo('description'); }
        elseif ( is_page() ) { single_post_title(''); }
        elseif ( is_search() ) { bloginfo('name'); print ' | Search results for ' . wp_specialchars($s); }
        elseif ( is_404() ) { bloginfo('name'); print ' | Not Found'; }
        else { bloginfo('name'); wp_title('|'); } ?>
    </title>
	
	<meta http-equiv="content-type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
	
	<link rel="stylesheet" type="text/css" href="<?php bloginfo('stylesheet_url'); ?>" />
	<?php $style = $_GET['style'];
	if ($style != '') { ?>	
		<link rel="stylesheet" type="text/css" href="<?php bloginfo('template_directory'); ?>/styles/<?php echo $_GET['style']; ?>.css" />
	<?php } else { ?> 
		<link rel="stylesheet" type="text/css" href="<?php bloginfo('template_directory'); ?>/styles/<?php echo get_option("gt_stylesheet"); ?>.css" />
	<?php } ?>
		
	<?php wp_enqueue_script('jquery'); ?>	
	<?php wp_enqueue_script('superfish', get_bloginfo('template_directory').'/js/superfish.js', array('jquery'), '1.0'); ?>	
	<?php wp_enqueue_script('cycle', get_bloginfo('template_directory').'/js/jquery.cycle.js', array('jquery'), '1.0'); ?>
	
	<?php wp_head(); ?>
	
	<script type="text/javascript"> 
 		
	    jQuery(function($){
	        
	        //Navigation drop downs
	        $('.main-nav ul').superfish({
	        	autoArrows: true,
	        	speed: 'fast',
	        	delay: 0,
	        	dropShadows: false
	        });
	        
	        //sliding content
	        $('#feature-slides').cycle({
				timeout: 5000,
				fx: 'scrollHorz',
				speed: 500,
				speedIn: 700,
				next:   '#next', 
	    		prev:   '#prev'
			});
				        
	    });   
	 	
	</script>
		
	
	<link rel="alternate" type="application/rss+xml" href="<?php bloginfo('rss2_url'); ?>" title="<?php printf( __( '%s latest posts', 'FrameJam' ), wp_specialchars( get_bloginfo('name'), 1 ) ); ?>" />
	<link rel="alternate" type="application/rss+xml" href="<?php bloginfo('comments_rss2_url') ?>" title="<?php printf( __( '%s latest comments', 'FrameJam' ), wp_specialchars( get_bloginfo('name'), 1 ) ); ?>" />
	<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
	
	<?php
	global $options;
	foreach ($options as $value) {
	    if (get_settings( $value['id'] ) === FALSE) { $$value['id'] = $value['std']; } else { $$value['id'] = get_settings( $value['id'] ); }
	}
	?>
	
</head>

<body <?php body_class(); ?>>

<div id="wrap">

	<div id="header" class="clearfix">
		
		<?php if ( is_home() || is_front_page() ) { ?>
		<h1 id="branding"><a href="<?php bloginfo( 'url' ) ?>/" title="<?php bloginfo( 'name' ) ?>" rel="home">
		<?php if ( get_option("gt_logo_image") ) { ?><img src="<?php echo get_option("gt_logo_image"); ?>" alt="<?php bloginfo( 'name' ) ?>" border="0" /><?php } else { ?><img src="<?php bloginfo('template_directory'); ?>/images/logo.png" alt="<?php bloginfo( 'name' ) ?>" /><?php } ?></a></h1>
		<?php } else { ?>	
		<div id="branding"><a href="<?php bloginfo( 'url' ) ?>/" title="<?php bloginfo( 'name' ) ?>" rel="home">
		<?php if ( get_option("gt_logo_image") ) { ?><img src="<?php echo get_option("gt_logo_image"); ?>" alt="<?php bloginfo( 'name' ) ?>" border="0" /><?php } else { ?><img src="<?php bloginfo('template_directory'); ?>/images/logo.png" alt="<?php bloginfo( 'name' ) ?>" /><?php } ?></a></div>
		<?php } ?>
		
		<div id="header-links">
			
			<div id="search"><form id="searchform" method="get" action="<?php bloginfo( 'url' ) ?>/index.php"><input type="text" name="s" id="s" onclick="this.value='';" onfocus="this.select()" onblur="this.value=!this.value?'Type and hit enter':this.value;" value="Type and hit enter" /></form></div>
			
			<?php $enable_menus_top = get_option("gt_enable_menus_top");
				if ( (function_exists('wp_nav_menu')) && ($enable_menus_top == "true") ) { 
					wp_nav_menu( array('menu' => 'top', 'sort_column' => 'menu_order', 'container_class' => 'secondary-nav clearfix' )); 
				} ?>
			
			
			
			<ul id="social-links">
				<?php if ( get_option("gt_feedburner_url") ) : ?>
				<li><a href="<?php echo stripslashes($gt_feedburner_url); ?>" title=""><img src="<?php bloginfo('template_directory'); ?>/images/icon-rss.png" width="30" height="30" alt="RSS" border="0" /></a></li>
				<?php endif ?>
				<?php if ( get_option("gt_facebook_url") ) : ?>
				<li><a href="<?php echo get_option("gt_facebook_url"); ?>" title="Facebook"><img src="<?php bloginfo('template_directory'); ?>/images/icon-facebook.png" width="30" height="30" alt="Facebook" border="0" /></a></li>
				<?php endif ?>
				<?php if ( get_option("gt_enable_twitter_icon") ) : ?>
				<li><a href="http://www.twitter.com/<?php echo get_option("gt_twitter_username"); ?>" title="@<?php echo get_option("gt_twitter_username"); ?> on Twitter"><img src="<?php bloginfo('template_directory'); ?>/images/icon-twitter.png" width="30" height="30" alt="Twitter" border="0" /></a></li>
				<?php endif ?>
			</ul>
		
		</div><!-- END: #header-links -->
		
		
		<div class="main-nav clearfix">
			<?php if (function_exists('wp_nav_menu')) {
			 	wp_nav_menu( array( 'sort_column' => 'menu_order', 'container_class' => 'clearfix', 'theme_location' => 'top-nav' ) ); } else { ?>
				<ul>
			  		<?php wp_list_pages('title_li='); ?>			
			  	</ul>
			<?php } ?>
		</div><!--/ .main-nav -->
		
				
	</div><!-- END: #header -->
	
	<div id="container" class="clearfix">	
	