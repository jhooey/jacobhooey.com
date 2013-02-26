<!DOCTYPE html>
<html <?php language_attributes(); ?>>
    <head>
        <meta charset="<?php bloginfo('charset'); ?>" />
        <title>
            <?php global $page, $paged; ?>
            <?php wp_title('|', true, 'right'); ?>
            <?php bloginfo('name'); ?>
            <?php $site_description = get_bloginfo('description', 'display'); ?>
            <?php if ($site_description && (is_home() || is_front_page())) : ?>
                <?php echo " | $site_description"; ?>
            <?php endif; ?>
            <?php if ($paged >= 2 || $page >= 2) : ?>
                <?php echo ' | '.sprintf(__('Page %s'), max($paged, $page)); ?>
            <?php endif; ?>
        </title>
        <link rel="profile" href="http://gmpg.org/xfn/11" />
        <link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo('stylesheet_url'); ?>" />
        <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
        <?php if (is_singular() && get_option('thread_comments')) : ?>
			<?php wp_enqueue_script('comment-reply'); ?>
        <?php endif; ?>
        <?php wp_head(); ?>
    </head>
    <body <?php body_class(); ?>>
    <div id="wrapper" class="hfeed">
    	<div id="header-frame">
            <div id="header">
                <div id="access">
                    <?php wp_nav_menu(array('menu_class' => 'menu')); ?>
                </div><!-- #access -->
                <div id="site-title">
                    <a href="<?php echo home_url('/'); ?>" title="<?php echo esc_attr(get_bloginfo('name', 'display')); ?>"><?php bloginfo('name'); ?></a>
                </div><!-- #site-title -->
                <div id="site-description">
                    <?php bloginfo('description'); ?>
                </div><!-- #site-description -->
            </div><!-- #header -->
        </div><!-- #header-frame -->
        <div id="maingraphic"></div>
        <div id="main-top-frame">
        	<div id="main-bottom-frame">
        		<div id="main">