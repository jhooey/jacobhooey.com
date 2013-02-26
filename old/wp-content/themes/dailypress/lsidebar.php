<ul>
   <?php if ( function_exists('dynamic_sidebar') && dynamic_sidebar(1) ) : else : ?>    	
      <li>
      		  <h2><?php _e('Recent Posts'); ?></h2>
              <ul>
              <?php get_archives('postbypost', '10', 'custom', '<li>', '</li>'); ?>
              </ul>
           	 </li>
                        <li>
        <h2><?php _e('Links'); ?></h2>
            <ul>
             <?php get_links('-1', '<li>', '</li>', '', TRUE, 'url', FALSE); ?>
             </ul>
        </li>   
    <?php endif; ?>
</ul>
