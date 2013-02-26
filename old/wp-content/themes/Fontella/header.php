<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head profile="http://gmpg.org/xfn/11">

	<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />

	<title><?php bloginfo('name'); ?><?php wp_title(); ?></title>
	
	<meta name="generator" content="WordPress <?php bloginfo('version'); ?>" />

	<style type="text/css" media="screen">
		@import url(<?php bloginfo('stylesheet_url'); ?>);
	</style>

	<link rel="alternate" type="application/rss+xml" title="RSS 2.0" href="<?php bloginfo('rss2_url'); ?>" />
	<link rel="alternate" type="text/xml" title="RSS .92" href="<?php bloginfo('rss_url'); ?>" />
	<link rel="alternate" type="application/atom+xml" title="Atom 0.3" href="<?php bloginfo('atom_url'); ?>" />
	
	<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />

    <?php wp_get_archives('type=monthly&format=link'); ?>
	<?php //comments_popup_script(); // off by default ?>
	<?php wp_head(); ?>

</head>

<body>

<?php
$numposts = $wpdb->get_var("SELECT COUNT(*) FROM $wpdb->posts WHERE post_status = 'publish'");
if (0 < $numposts) $numposts = number_format($numposts); 

$numcomms = $wpdb->get_var("SELECT COUNT(*) FROM $wpdb->comments WHERE comment_approved = '1'");
if (0 < $numcomms) $numcomms = number_format($numcomms);

$numcats = $wpdb->get_var("SELECT COUNT(*) FROM $wpdb->categories");
if (0 < $numcats) $numcats = number_format($numcats);
?>

<div id="topbarmax"> <!--This layer is for the elastic design-->

	<div id="topbar"><span><?php bloginfo('name'); ?> / <?php printf(__('%1$s posts / %5$s categories / %3$s comments'), $numposts, 'edit.php',  $numcomms, 'edit-comments.php', $numcats, 'categories.php'); ?> / <a class="icon" href="<?php bloginfo('rss2_url'); ?>">feed</a> / <a class="icon" href="<?php bloginfo('comments_rss2_url'); ?>">comments feed</a></span></div>

</div>
	
	<div id="header">

		<div id="navbar"><ul><li><a href="<?php echo get_settings('home'); ?>">Home</a></li><?php wp_list_pages('title_li'); ?></ul></div>

	</div>
