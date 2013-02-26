<?php
global $options;
foreach ($options as $value) {
    if (get_settings( $value['id'] ) === FALSE) { $$value['id'] = $value['std']; } else { $$value['id'] = get_settings( $value['id'] ); }
}
?>
	
	</div><!-- END: #container -->
	
	<div id="footer">
		
		<p>&copy; 2009 Gadget &nbsp;&nbsp; // &nbsp;&nbsp; Powered by <a href="http://www.wordpress.org" title="WordPress">WordPress</a></p>
		
		<?php if ($gt_disable_tj_credit == "true") { } else { ?>
		<p id="credit"><span>Designed by</span> <a href="<?php echo get_option("gt_affiliate_url"); ?>" title="ThemeJam"></a></p>
		<?php } ?>
					
	</div><!-- END #footer -->
	
</div><!-- END #wrap -->	

<?php wp_footer(); ?>

<?php echo stripslashes($gt_google_analytics); ?>

</body>
</html>