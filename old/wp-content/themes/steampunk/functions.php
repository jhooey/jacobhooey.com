<?php
add_theme_support('menus');
add_theme_support('automatic-feed-links');

if (function_exists('register_sidebar'))
    register_sidebar();

if (!isset($content_width))
	$content_width = 631;

if (function_exists('register_nav_menu'))
	register_nav_menu('menu', 'Header Menu');
?>