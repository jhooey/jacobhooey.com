<form id="setup" method="post" action="<?php echo esc_url(admin_url('index.php?social_controller=settings&social_action=index')); ?>">
<?php wp_nonce_field(); ?>
<input type="hidden" name="social_action" value="settings" />
<?php if (isset($_GET['saved'])): ?>
<div id="message" class="updated">
	<p><strong><?php _e('Social settings have been updated.', 'social'); ?></strong></p>
</div>
<?php endif; ?>
<div class="wrap" id="social_options_page">
	<div class="social-view-header cf-clearfix">
		<h2><?php _e('Social', 'social'); ?></h2>
		<div class="social-view-subtitle"><?php printf(__('Compliments of <a class="social-mailchimp-link" href="%s">MailChimp</a>', 'social'), 'http://mailchimp.com/'); ?></div>
	</div>
	<div class="social-view">
		<table class="form-table">
			<tr>
				<th><?php _e('Accounts', 'social'); ?></th>
				<td nowrap="nowrap">
					<?php
						$have_accounts = false;
						$items = $service_buttons = '';
						foreach ($services as $key => $service) {
							foreach ($service->accounts() as $account) {
								if ($account->universal()) {
									$have_accounts = true;
									$items .= $service->auth_output($account);
								}
							}

							$button = '<div class="social-connect-button cf-clearfix"><a href="'.esc_url($service->authorize_url()).'" id="'.esc_attr($key).'_signin" class="social-login" target="_blank"><span>'.sprintf(__('Sign in with %s.', 'social'), esc_html($service->title())).'</span></a></div>';
							$button = apply_filters('social_service_button', $button, $service);
							$service_buttons .= $button;
						}

						echo '
						<div id="social-accounts" class="social-accounts">
							<ul>
						';
						if (!empty($items)) {
							echo $items;
						}
						else {
							echo '
							<li class="social-accounts-item none">
								<div class="social-facebook-icon"><i style="background: url(http://www.gravatar.com/avatar/a06082e4f876182b547f635d945e744e?s=16&d=mm) no-repeat;"></i></div>
								<span class="name">'.__('No Accounts', 'social').'</span>
							</li>
							';
						}
						echo '
							</ul>
						</div>
						';
						echo '<div>'.$service_buttons.'</div>'
						   . '<p class="description">'.sprintf(__('Connected accounts are available to all blog authors. Add accounts that only you can use in <a href="%s">your profile</a>.', 'social'), admin_url('profile.php#social-accounts')).'</p>';

					?>
				</td>
			</tr>
			<?php if ($have_accounts): ?>
			<tr>
				<th><?php _e('Broadcasting is on by default', 'social'); ?></th>
				<td>
					<input type="radio" name="social_broadcast_by_default" id="social-broadcast-by-default-yes" value="1"<?php checked('1', Social::option('broadcast_by_default'), true); ?>
					<label for="social-broadcast-by-default-yes"><?php _e('Yes', 'social'); ?></label>

					<input type="radio" name="social_broadcast_by_default" id="social-broadcast-by-default-no" value="0"<?php checked('0', Social::option('broadcast_by_default'), true); ?>
					<label for="social-broadcast-by-default-no"><?php _e('No', 'social'); ?></label>
				</td>
			</tr>
			<tr>
				<th><?php _e('Default accounts', 'social'); ?></th>
				<td>
					<ul id="social-default-accounts">
						<?php
							$default_accounts = Social::option('default_accounts');
							foreach ($services as $key => $service) {
								foreach ($service->accounts() as $account_id => $account) {
									if ($key != 'pages') {
										if ($account->universal()) {

						?>
						<li class="social-accounts-item">
							<label class="social-broadcastable" for="<?php echo esc_attr($key.$account->id()); ?>" style="cursor:pointer">
								<input type="checkbox" name="social_default_accounts[]" id="<?php echo esc_attr($key.$account->id()); ?>" value="<?php echo esc_attr($key.'|'.$account->id()); ?>"<?php echo ((isset($default_accounts[$key]) and in_array($account->id(), array_values($default_accounts[$key]))) ? ' checked="checked"' : ''); ?> />
								<img src="<?php echo esc_attr($account->avatar()); ?>" width="24" height="24" />
								<span class="name">
									<?php
										$show_pages = false;
										$pages_output = '';

										echo esc_html($account->name());
										if ($service->key() == 'facebook') {
											$pages = $account->pages(null, false);

											if ($account->use_pages() and count($pages)) {
												$pages_output .= '<h5>'.__('Account Pages', 'social').'</h5><ul>';
												foreach ($pages as $page) {
													$checked = '';
													if (isset($default_accounts['facebook']) and
														isset($default_accounts['facebook']['pages']) and
														isset($default_accounts['facebook']['pages'][$account->id()]) and
														in_array($page->id, $default_accounts['facebook']['pages'][$account->id()])
													) {
														$show_pages = true;
														$checked = ' checked="checked"';
													}
													$pages_output .= '<li>'
														.'    <input type="checkbox" name="social_default_pages['.esc_attr($account->id()).'][]" value="'.esc_attr($page->id).'"'.$checked.' />'
														.'    <img src="'.esc_url($service->page_image_url($page)).'" width="24" height="24" />'
														.'    <span>'.esc_html($page->name).'</span>'
														.'</li>';
												}
												$pages_output .= '</ul>';

												if (!$show_pages) {
													echo '<span> - <a href="#" class="social-show-facebook-pages">'.__('Show Pages', 'social').'</a></span>';
												}
											}
										}
									?>
								</span>
							</label>
							<?php
								if (!empty($pages_output)) {
									echo '<div class="social-facebook-pages"'.($show_pages ? ' style="display:block"' : '').'>'
									   . $pages_output
									   . '</div>';
								}
							?>
						</li>
						<?php
										}
									}
								}
							}
						?>
					</ul>
					<p class="description"><?php _e('Accounts that will be selected by default; and will auto-broadcast in the default teaser format when you publish via XML-RPC or email.', 'social'); ?></p>
				</td>
			</tr>
			<?php endif ?>
			<tr>
				<th>
					<label for="social_broadcast_format"><?php _e('Post broadcast format', 'social'); ?></label>
				</th>
				<td>
					<input type="text" class="regular-text" name="social_broadcast_format" id="social_broadcast_format" value="<?php echo esc_attr(Social::option('broadcast_format')); ?>" />
					<p class="description"><?php _e('How you would like posts to be formatted when broadcasting to Twitter or Facebook?'); ?></p>

					<div class="description">
						<?php _e('Tokens:', 'social'); ?>
						<ul>
							<?php 
							foreach (Social::broadcast_tokens() as $token => $description): 
								if (!empty($description)) {
									$description = ' - '.$description;
								}
							?>
							<li><b><?php echo esc_html($token); ?></b><?php echo esc_html($description); ?></li>
							<?php endforeach; ?>
						</ul>
					</div>
				</td>
			</tr>
			<tr>
				<th>
					<label for="social_comment_broadcast_format"><?php _e('Comment broadcast format', 'social'); ?></label>
				</th>
				<td>
					<input type="text" class="regular-text" name="social_comment_broadcast_format" id="social_comment_broadcast_format" value="<?php echo esc_attr(Social::option('comment_broadcast_format')); ?>" />
					<p class="description"><?php _e('How you would like comments to be formatted when broadcasting to Twitter or Facebook?'); ?></p>

					<div class="description">
						<?php _e('Tokens:', 'social'); ?>
						<ul>
							<?php 
							foreach (Social::comment_broadcast_tokens() as $token => $description): 
								if (!empty($description)) {
									$description = ' - '.$description;
								}
							?>
							<li><b><?php echo esc_html($token); ?></b><?php echo esc_html($description); ?></li>
							<?php endforeach; ?>
						</ul>
					</div>
				</td>
			</tr>
			<tr>
				<th><?php _e('Twitter @anywhere', 'social'); ?></th>
				<td>
					<label for="social_twitter_anywhere_api_key"><?php _e('Consumer API Key', 'social'); ?></label><br />
					<input type="text" class="regular-text" name="social_twitter_anywhere_api_key" id="social_twitter_anywhere_api_key" value="<?php echo esc_attr(Social::option('twitter_anywhere_api_key')); ?>" />
					<p class="description"><?php printf(__('To enable Twitter\'s @anywhere hovercards for Twitter usernames, enter your application\'s Consumer API key here. (<a href="%1$s" target="_blank">Click here to get an API key</a>)', 'social'), 'https://dev.twitter.com/docs/anywhere'); ?></p>
				</td>
			</tr>
		</table>
		<?php
			$fetch = Social::option('fetch_comments');
			$toggle = ((!empty($fetch) and $fetch != '1') or Social::option('debug') == '1') ? ' social-open' : '';
		?>
		<div class="social-collapsible<?php echo $toggle; ?>">
			<h3 class="social-title"><a href="#social-advanced"><?php _e('Advanced Options', 'social'); ?></a></h3>
			<div class="social-content">
				<table id="social-advanced" class="form-table">
					<tr>
						<th><?php _e('Fetch new comments', 'social'); ?></th>
						<td>
							<ul>
								<li>
									<label for="fetch_comments_auto">
										<input type="radio" name="social_fetch_comments" value="1" id="fetch_comments_auto" style="position:relative;top:-1px"<?php echo Social::option('fetch_comments') == '1' ? ' checked="checked"' : ''; ?> />
										<?php _e('Automatically', 'social'); ?>
										<span class="description"><?php _e('(easiest)', 'social'); ?></span>
									</label>
								</li>
								<li>
									<label for="fetch_comments_never">
										<input type="radio" name="social_fetch_comments" value="0" id="fetch_comments_never" style="position:relative;top:-1px"<?php echo !in_array(Social::option('fetch_comments'), array('1', '2')) ? ' checked="checked"' : ''; ?> />
										<?php _e('Never', 'social'); ?>
										<span class="description"><?php _e('(disables fetching of comments)', 'social'); ?></span>
									</label>
								</li>
								<li>
									<label for="fetch_comments_cron">
										<input type="radio" name="social_fetch_comments" value="2" id="fetch_comments_cron" style="position:relative;top:-1px"<?php echo Social::option('fetch_comments') == '2' ? ' checked="checked"' : ''; ?> />
										<?php _e('Using a custom CRON job <span class="description">(advanced)</span>', 'social'); ?>
									</label>
									<p class="description"><?php _e('If you select this option, new tweets and Facebook posts will not be fetched unless you set up a system CRON job or fetch new items manually from the post edit screen. More help is also available in&nbsp;<code>readme.txt</code>.', 'social'); ?></p>
									<?php if (Social::option('fetch_comments') == '2'): ?>
									<div class="social-callout">
										<h3 class="social-title"><?php _e('CRON Setup', 'social'); ?></h3>
										<dl class="social-kv">
											<dt><?php _e('CRON API Key', 'social'); ?> <small>(<a href="<?php echo esc_url(wp_nonce_url(admin_url('options-general.php?page=social.php&social_controller=settings&social_action=regenerate_api_key'), 'regenerate_api_key')); ?>" rel="social_api_key" id="social_regenerate_api_key"><?php _e('regenerate', 'social'); ?></a>)</small></dt>
											<dd>
												<code class="social_api_key"><?php echo esc_html(Social::option('system_cron_api_key')); ?></code>
											</dd>
										</dl>
										<p><?php _e('For your system CRON to run correctly, make sure it is pointing towards a URL that looks something like the following:', 'social'); ?></p>
										<code><?php echo esc_url(site_url('?social_controller=cron&social_action=cron_15&api_key='.Social::option('system_cron_api_key'))); ?></code>
										<?php endif; ?>
									</div>
								</li>
							</ul>
						</td>
					</tr>
					<tr>
						<th>
							<?php _e('Debug Mode', 'social'); ?>
							<span class="description"><?php _e('(nerds only)', 'social'); ?></span>
						</th>
						<td>
							<p style="margin-top:0"><?php _e('If you turn debug on, Social will save additional information in <code>debug_log.txt</code> file. Not recommended for production environments.', 'social'); ?></p>
							<ul>
								<li>
									<label for="debug_mode_no">
										<input type="radio" name="social_debug" id="debug_mode_no" value="0"<?php echo Social::option('debug') != '1' ? ' checked="checked"' : ''; ?> />
										<?php _e('Off <span class="description">(recommended)</span>', 'social'); ?>
									</label>
								</li>
								<li>
									<label for="debug_mode_yes">
										<input type="radio" name="social_debug" id="debug_mode_yes" value="1"<?php echo Social::option('debug') == '1' ? ' checked="checked"' : ''; ?> />
										<?php _e('On <span class="description">(for troubleshooting)</span>', 'social'); ?>
									</label>
								</li>
							</ul>

							<strong><?php _e('Debug log location:', 'social'); ?></strong> <code><?php echo SOCIAL_PATH.'debug_log.txt'; ?></code>
						</td>
					</tr>
				</table>
			</div>
			<?php do_action('social_advanced_options'); ?>
		</div>
		<p class="submit" style="clear:both">
			<input type="submit" name="submit" value="Save Settings" class="button-primary" />
		</p>
	</div>
</div>
</form>
