<?php

// Register widget area 1
if ( function_exists('register_sidebar') )
register_sidebar(array(
'name' => 'Sidebar Widgets',
'before_widget' => '<div class="box clearfix %2$s">',
'after_widget' => '</div>',
'before_title' => '<h4><span>',
'after_title' => '</span></h4>',
));

?>