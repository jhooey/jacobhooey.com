<ul>
	<?php if ( function_exists('dynamic_sidebar') && dynamic_sidebar(2) ) : else : ?>	
    <li>
      		  <h2><?php _e('Recent Posts'); ?></h2>
              <ul>
              <?php get_archives('postbypost', '10', 'custom', '<li>', '</li>'); ?>
              </ul>
           	 </li>
                                       
              
        <li>
        <h2><?php _e('Meta'); ?></h2>
            <ul>
            <?php wp_register(); ?>
            <li><?php wp_loginout(); ?></li>
            <?php wp_meta(); ?>
            </ul>
        </li>
		<?php endif; ?>
</ul>