<?php
function mw_recent_comments(
	$no_comments = 10,
	$show_pass_post = false,
	$title_length = 100, 	// shortens the title if it is longer than this number of chars
	$author_length = 30,	// shortens the author if it is longer than this number of chars
	$wordwrap_length = 50, // adds a blank if word is longer than this number of chars
	$type = 'all', 	// Comments, trackbacks, or both?
	$format = '<li>%date%: <a href="%permalink%" title="%title%">%title%</a> (von %author_full%)</li>',
	$date_format = 'd.m',
	$none_found = '<li>No Comments.</li>',	// None found
	$type_text_pingback = 'Pingback of',
	$type_text_trackback = 'Trackback of',
	$type_text_comment = 'of'
	) {
	//Language...
	$mwlang_anonymous = 'Anonym'; // Anonymous
	$mwlang_authorurl_title_before = 'Website of &lsaquo;';
	$mwlang_authorurl_title_after = '&rsaquo; visit';
    global $wpdb;
    $request = "SELECT ID, comment_ID, comment_content, comment_author, comment_author_url, comment_date, post_title, comment_type
				FROM $wpdb->comments LEFT JOIN $wpdb->posts ON $wpdb->posts.ID=$wpdb->comments.comment_post_ID
				WHERE post_status IN ('publish','static')";
	switch($type) {
		case 'all':
			// add nothing
			break;
		case 'comment_only':
			//
			$request .= "AND $wpdb->comments.comment_type='' ";
			break;
		case 'trackback_only':
			$request .= "AND ( $wpdb->comments.comment_type='trackback' OR $wpdb->comments.comment_type='pingback' ) ";
			break;
	 default:
 		//
			break;
	}
	if (!$show_pass_post) $request .= "AND post_password ='' ";
	$request .= "AND comment_approved = '1' ORDER BY comment_ID DESC LIMIT $no_comments";
	$comments = $wpdb->get_results($request);
    $output = '';
	if ($comments) {
    	foreach ($comments as $comment) {
			// Permalink to post/comment
			$loop_res['permalink'] = get_permalink($comment->ID). '#comment-' . $comment->comment_ID;
			// Title of the post
			$loop_res['post_title'] = stripslashes($comment->post_title);
			$loop_res['post_title'] = wordwrap($loop_res['post_title'], $wordwrap_length, ' ' , 1);
			if (strlen($loop_res['post_title']) >= $title_length) {
				$loop_res['post_title'] = substr($loop_res['post_title'], 0, $title_length) . '&#8230;';
			}
			// Author's name only
        	$loop_res['author_name'] = stripslashes($comment->comment_author);
			$loop_res['author_name'] = wordwrap($loop_res['author_name'], $wordwrap_length, ' ' , 1);
			if ($loop_res['author_name'] == '') $loop_res['author_name'] = $mwlang_anonymous;
			if (strlen($loop_res['author_name']) >= $author_length) {
				$loop_res['author_name'] = substr($loop_res['author_name'], 0, $author_length) . '&#8230;';
			}
			// Full author (link, name)
			$author_url = $comment->comment_author_url;
			if (empty($author_url)) {
				$loop_res['author_full'] = $loop_res['author_name'];
			} else {
				$loop_res['author_full'] = '<a href="' . $author_url . '" title="' . $mwlang_authorurl_title_before . $loop_res['author_name'] . $mwlang_authorurl_title_after . '">' . $loop_res['author_name'] . '</a>';
			}
/*
			// Comment excerpt
			$comment_excerpt = strip_tags($comment->comment_content);
			$comment_excerpt = stripslashes($comment_excerpt);
			if (strlen($comment_excerpt) >= $comment_length) {
				$comment_excerpt = substr($comment_excerpt, 0, $comment_length) . '...';
			}
*/
			// Comment type
			if ( $comment->comment_type == 'pingback' ) {
				$loop_res['comment_type'] = $type_text_pingback;
			} elseif ( $comment->comment_type == 'trackback' ) {
				$loop_res['comment_type'] = $type_text_trackback;
			} else {
				$loop_res['comment_type'] = $type_text_comment;
			}
			// Date of comment
			$loop_res['comment_date'] = mysql2date($date_format, $comment->comment_date);
			// Output element
			$element_loop = str_replace('%permalink%', $loop_res['permalink'], $format);
			$element_loop = str_replace('%title%', $loop_res['post_title'], $element_loop);
			$element_loop = str_replace('%author_name%', $loop_res['author_name'], $element_loop);
			$element_loop = str_replace('%author_full%', $loop_res['author_full'], $element_loop);
			$element_loop = str_replace('%date%', $loop_res['comment_date'], $element_loop);
			$element_loop = str_replace('%type%', $loop_res['comment_type'], $element_loop);
			$output .= $element_loop . "\n";
		} //foreach
		$output = convert_smilies($output);
	} else {
		$output .= $none_found;
    }
    echo $output;
}
if ( function_exists('register_sidebars') )
    register_sidebars(2, array(
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget' => '</ul></div>',
        'before_title' => '<h2>',
        'after_title' => '</h2><ul>',
    ));
function wp_pagenavi($before = '', $after = '', $prelabel = '', $nxtlabel = '', $pages_to_show = 5, $always_show = false) {
	global $request, $posts_per_page, $wpdb, $paged;
	if(empty($prelabel)) {
		$prelabel  = '<strong>&laquo;</strong>';
	}
	if(empty($nxtlabel)) {
		$nxtlabel = '<strong>&raquo;</strong>';
	}
	$half_pages_to_show = round($pages_to_show/2);
	if (!is_single()) {
		if(!is_category()) {
			preg_match('#FROM\s(.*)\sORDER BY#siU', $request, $matches);		
		} else {
			preg_match('#FROM\s(.*)\sGROUP BY#siU', $request, $matches);		
		}
		$fromwhere = $matches[1];
		$numposts = $wpdb->get_var("SELECT COUNT(DISTINCT ID) FROM $fromwhere");
		$max_page = ceil($numposts /$posts_per_page);
		if(empty($paged)) {
			$paged = 1;
		}
		if($max_page > 1 || $always_show) {
			echo "$before <div class='Nav'><span>Pages ($max_page): </span>";
			if ($paged >= ($pages_to_show-1)) {
				echo '<a href="'.get_pagenum_link().'">&laquo; First</a> ... ';
			}
			previous_posts_link($prelabel);
			for($i = $paged - $half_pages_to_show; $i  <= $paged + $half_pages_to_show; $i++) {
				if ($i >= 1 && $i <= $max_page) {
					if($i == $paged) {
						echo "<strong class='on'>$i</strong>";
					} else {
						echo ' <a href="'.get_pagenum_link($i).'">'.$i.'</a> ';
					}
				}
			}
			next_posts_link($nxtlabel, $max_page);
			if (($paged+$half_pages_to_show) < ($max_page)) {
				echo ' ... <a href="'.get_pagenum_link($max_page).'">Last &raquo;</a>';
			}
			echo "</div> $after";
		}
	}
}
?><?php
function get_flickrRSS() {
	// the function can accept up to seven parameters, otherwise it uses option panel defaults 	
  	for($i = 0 ; $i < func_num_args(); $i++) {
    	$args[] = func_get_arg($i);
    	}
  	if (!isset($args[0])) $num_items = get_option('flickrRSS_display_numitems'); else $num_items = $args[0];
  	if (!isset($args[1])) $type = get_option('flickrRSS_display_type'); else $type = $args[1];
  	if (!isset($args[2])) $tags = trim(get_option('flickrRSS_tags')); else $tags = trim($args[2]);
  	if (!isset($args[3])) $imagesize = get_option('flickrRSS_display_imagesize'); else $imagesize = $args[3];
  	if (!isset($args[4])) $before_image = stripslashes(get_option('flickrRSS_before')); else $before_image = $args[4];
  	if (!isset($args[5])) $after_image = stripslashes(get_option('flickrRSS_after')); else $after_image = $args[5];
  	if (!isset($args[6])) $id_number = stripslashes(get_option('flickrRSS_flickrid')); else $id_number = $args[6];
  	if (!isset($args[7])) $set_id = stripslashes(get_option('flickrRSS_set')); else $set_id = $args[7];
	# use image cache & set location
	$useImageCache = get_option('flickrRSS_use_image_cache');
	$cachePath = get_option('flickrRSS_image_cache_uri');
	$fullPath = get_option('flickrRSS_image_cache_dest'); 
	if (!function_exists('MagpieRSS')) { // Check if another plugin is using RSS, may not work
		include_once (ABSPATH . WPINC . '/rss.php');
		error_reporting(E_ERROR);
	}
	// get the feeds
	if ($type == "user") { $rss_url = 'http://api.flickr.com/services/feeds/photos_public.gne?id=' . $id_number . '&tags=' . $tags . '&format=rss_200'; }
	elseif ($type == "favorite") { $rss_url = 'http://api.flickr.com/services/feeds/photos_faves.gne?id=' . $id_number . '&format=rss_200'; }
	elseif ($type == "set") { $rss_url = 'http://api.flickr.com/services/feeds/photoset.gne?set=' . $set_id . '&nsid=' . $id_number . '&format=rss_200'; }
	elseif ($type == "group") { $rss_url = 'http://api.flickr.com/services/feeds/groups_pool.gne?id=' . $id_number . '&format=rss_200'; }
	elseif ($type == "community" || $type == "public") { $rss_url = 'http://api.flickr.com/services/feeds/photos_public.gne?tags=' . $tags . '&format=rss_200'; }
	else { print "flickrRSS probably needs to be setup"; }
	# get rss file
	$rss = @ fetch_rss($rss_url);
	if ($rss) {
    	$imgurl = "";
    	# specifies number of pictures
		$items = array_slice($rss->items, 0, $num_items);
	    # builds html from array
    	foreach ( $items as $item ) {
       	 if(preg_match('<img src="([^"]*)" [^/]*/>', $item['description'],$imgUrlMatches)) {
            	$imgurl = $imgUrlMatches[1];
            #change image size         
           	if ($imagesize == "square") {
             	$imgurl = str_replace("m.jpg", "s.jpg", $imgurl);
           	} elseif ($imagesize == "thumbnail") {
             $imgurl = str_replace("m.jpg", "t.jpg", $imgurl);
           	} elseif ($imagesize == "medium") {
             $imgurl = str_replace("_m.jpg", ".jpg", $imgurl);
           	}
           #check if there is an image title (for html validation purposes)
           if($item['title'] !== "") $title = htmlspecialchars(stripslashes($item['title']));
           else $title = "Flickr photo";          
           $url = $item['link'];
	       preg_match('<http://farm[0-9]{0,3}\.static.flickr\.com/\d+?\/([^.]*)\.jpg>', $imgurl, $flickrSlugMatches);
	       $flickrSlug = $flickrSlugMatches[1];
	       # cache images 
	       if ($useImageCache) {   
               # check if file already exists in cache
               # if not, grab a copy of it
               if (!file_exists("$fullPath$flickrSlug.jpg")) {   
                 if ( function_exists('curl_init') ) { // check for CURL, if not use fopen
                    $curl = curl_init();
                    $localimage = fopen("$fullPath$flickrSlug.jpg", "wb");
                    curl_setopt($curl, CURLOPT_URL, $imgurl);
                    curl_setopt($curl, CURLOPT_CONNECTTIMEOUT, 1);
                    curl_setopt($curl, CURLOPT_FILE, $localimage);
                    curl_exec($curl);
                    curl_close($curl);
                   } else {
                 	$filedata = "";
                    $remoteimage = fopen($imgurl, 'rb');
                  	if ($remoteimage) {
                    	 while(!feof($remoteimage)) {
                         	$filedata.= fread($remoteimage,1024*8);
                       	 }
                  	}
                	fclose($remoteimage);
                	$localimage = fopen("$fullPath$flickrSlug.jpg", 'wb');
                	fwrite($localimage,$filedata);
                	fclose($localimage);
                 } // end CURL check
                } // end file check
                # use cached image
                print $before_image . "<a href=\"$url\" title=\"$title\"><img src=\"$cachePath$flickrSlug.jpg\" alt=\"$title\" /></a>" . $after_image;
            } else {
                # grab image direct from flickr
                print $before_image . "<a href=\"$url\" title=\"$title\"><img src=\"$imgurl\" alt=\"$title\" /></a>" . $after_image;      
            } // end use imageCache
       } // end pregmatch
     } // end foreach
  } // end if($rss)
} # end get_flickrRSS() function
function widget_flickrRSS_init() {
	if (!function_exists('register_sidebar_widget')) return;
	function widget_flickrRSS($args) {
		extract($args);
		$options = get_option('widget_flickrRSS');
		$title = $options['title'];
		$before_images = $options['before_images'];
		$after_images = $options['after_images'];
		echo $before_widget . $before_title . $title . $after_title . $before_images;
		get_flickrRSS();
		echo $after_images . $after_widget;
	}
	function widget_flickrRSS_control() {
		$options = get_option('widget_flickrRSS');
		if ( $_POST['flickrRSS-submit'] ) {
			$options['title'] = strip_tags(stripslashes($_POST['flickrRSS-title']));
			$options['before_images'] = $_POST['flickrRSS-beforeimages'];
			$options['after_images'] = $_POST['flickrRSS-afterimages'];
			update_option('widget_flickrRSS', $options);
		}
		$title = htmlspecialchars($options['title'], ENT_QUOTES);
		$before_images = htmlspecialchars($options['before_images'], ENT_QUOTES);
		$after_images = htmlspecialchars($options['after_images'], ENT_QUOTES);
		echo '<p style="text-align:right;"><label for="flickrRSS-title">Title: <input style="width: 180px;" id="gsearch-title" name="flickrRSS-title" type="text" value="'.$title.'" /></label></p>';
		echo '<p style="text-align:right;"><label for="flickrRSS-beforeimages">Before all images: <input style="width: 180px;" id="flickrRSS-beforeimages" name="flickrRSS-beforeimages" type="text" value="'.$before_images.'" /></label></p>';
		echo '<p style="text-align:right;"><label for="flickrRSS-afterimages">After all images: <input style="width: 180px;" id="flickrRSS-afterimages" name="flickrRSS-afterimages" type="text" value="'.$after_images.'" /></label></p>';
		echo '<input type="hidden" id="flickrRSS-submit" name="flickrRSS-submit" value="1" />';
	}		
	register_sidebar_widget('flickrRSS', 'widget_flickrRSS');
	register_widget_control('flickrRSS', 'widget_flickrRSS_control', 300, 100);
}
function flickrRSS_subpanel() {
     if (isset($_POST['save_flickrRSS_settings'])) {
       $option_flickrid = $_POST['flickr_id'];
       $option_tags = $_POST['tags'];
       $option_set = $_POST['set'];
       $option_display_type = $_POST['display_type'];
       $option_display_numitems = $_POST['display_numitems'];
       $option_display_imagesize = $_POST['display_imagesize'];
       $option_before = $_POST['before_image'];
       $option_after = $_POST['after_image'];
       $option_useimagecache = $_POST['use_image_cache'];
       $option_imagecacheuri = $_POST['image_cache_uri'];
       $option_imagecachedest = $_POST['image_cache_dest'];
       update_option('flickrRSS_flickrid', $option_flickrid);
       update_option('flickrRSS_tags', $option_tags);
       update_option('flickrRSS_set', $option_set);
       update_option('flickrRSS_display_type', $option_display_type);
       update_option('flickrRSS_display_numitems', $option_display_numitems);
       update_option('flickrRSS_display_imagesize', $option_display_imagesize);
       update_option('flickrRSS_before', $option_before);
       update_option('flickrRSS_after', $option_after);
       update_option('flickrRSS_use_image_cache', $option_useimagecache);
       update_option('flickrRSS_image_cache_uri', $option_imagecacheuri);
       update_option('flickrRSS_image_cache_dest', $option_imagecachedest);
       ?> <div class="updated"><p>flickrRSS settings saved</p></div> <?php
     }
	?>
	<div class="wrap">
		<h2>flickrRSS Settings</h2>
		<form method="post">
		<table class="form-table">
		 <tr valign="top">
		  <th scope="row">ID Number</th>
	      <td><input name="flickr_id" type="text" id="flickr_id" value="<?php echo get_option('flickrRSS_flickrid'); ?>" size="20" />
        		Use the <a href="http://idgettr.com">idGettr</a> to find your user or group id.</p></td>
         </tr>
         <tr valign="top">
          <th scope="row">Display</th>
          <td>
        	<select name="display_type" id="display_type">
        	  <option <?php if(get_option('flickrRSS_display_type') == 'user') { echo 'selected'; } ?> value="user">user</option>
        	  <option <?php if(get_option('flickrRSS_display_type') == 'set') { echo 'selected'; } ?> value="set">set</option>
        	  <option <?php if(get_option('flickrRSS_display_type') == 'favorite') { echo 'selected'; } ?> value="favorite">favorite</option>
		      <option <?php if(get_option('flickrRSS_display_type') == 'group') { echo 'selected'; } ?> value="group">group</option>
		      <option <?php if(get_option('flickrRSS_display_type') == 'community') { echo 'selected'; } ?> value="community">community</option>
		    </select>
		 	items using 
        	<select name="display_numitems" id="display_numitems">
		      <option <?php if(get_option('flickrRSS_display_numitems') == '1') { echo 'selected'; } ?> value="1">1</option>
		      <option <?php if(get_option('flickrRSS_display_numitems') == '2') { echo 'selected'; } ?> value="2">2</option>
		      <option <?php if(get_option('flickrRSS_display_numitems') == '3') { echo 'selected'; } ?> value="3">3</option>
		      <option <?php if(get_option('flickrRSS_display_numitems') == '4') { echo 'selected'; } ?> value="4">4</option>
		      <option <?php if(get_option('flickrRSS_display_numitems') == '5') { echo 'selected'; } ?> value="5">5</option>
		      <option <?php if(get_option('flickrRSS_display_numitems') == '6') { echo 'selected'; } ?> value="6">6</option>
		      <option <?php if(get_option('flickrRSS_display_numitems') == '7') { echo 'selected'; } ?> value="7">7</option>
		      <option <?php if(get_option('flickrRSS_display_numitems') == '8') { echo 'selected'; } ?> value="8">8</option>
		      <option <?php if(get_option('flickrRSS_display_numitems') == '9') { echo 'selected'; } ?> value="9">9</option>
		      <option <?php if(get_option('flickrRSS_display_numitems') == '10') { echo 'selected'; } ?> value="10">10</option>
		      <option <?php if(get_option('flickrRSS_display_numitems') == '11') { echo 'selected'; } ?> value="11">11</option>
		      <option <?php if(get_option('flickrRSS_display_numitems') == '12') { echo 'selected'; } ?> value="12">12</option>
		      <option <?php if(get_option('flickrRSS_display_numitems') == '13') { echo 'selected'; } ?> value="13">13</option>
		      <option <?php if(get_option('flickrRSS_display_numitems') == '14') { echo 'selected'; } ?> value="14">14</option>
		      <option <?php if(get_option('flickrRSS_display_numitems') == '15') { echo 'selected'; } ?> value="15">15</option>
		      <option <?php if(get_option('flickrRSS_display_numitems') == '16') { echo 'selected'; } ?> value="16">16</option>
		      <option <?php if(get_option('flickrRSS_display_numitems') == '17') { echo 'selected'; } ?> value="17">17</option>
		      <option <?php if(get_option('flickrRSS_display_numitems') == '18') { echo 'selected'; } ?> value="18">18</option>
		      <option <?php if(get_option('flickrRSS_display_numitems') == '19') { echo 'selected'; } ?> value="19">19</option>
		      <option <?php if(get_option('flickrRSS_display_numitems') == '20') { echo 'selected'; } ?> value="20">20</option>
		      </select>
            <select name="display_imagesize" id="display_imagesize">
		      <option <?php if(get_option('flickrRSS_display_imagesize') == 'square') { echo 'selected'; } ?> value="square">square</option>
		      <option <?php if(get_option('flickrRSS_display_imagesize') == 'thumbnail') { echo 'selected'; } ?> value="thumbnail">thumbnail</option>
		      <option <?php if(get_option('flickrRSS_display_imagesize') == 'small') { echo 'selected'; } ?> value="small">small</option>
		      <option <?php if(get_option('flickrRSS_display_imagesize') == 'medium') { echo 'selected'; } ?> value="medium">medium</option>
		    </select>
            images</p>
           </td> 
         </tr>
         <tr valign="top">
		  <th scope="row">Set</th>
          <td><input name="set" type="text" id="set" value="<?php echo get_option('flickrRSS_set'); ?>" size="40" /> Use number from the set url</p>
         </tr>
         <tr valign="top">
		  <th scope="row">Tags</th>
          <td><input name="tags" type="text" id="tags" value="<?php echo get_option('flickrRSS_tags'); ?>" size="40" /> Comma separated, no spaces</p>
         </tr>
         <tr valign="top">
          <th scope="row">HTML Wrapper</th>
          <td><label for="before_image">Before Image:</label> <input name="before_image" type="text" id="before_image" value="<?php echo htmlspecialchars(stripslashes(get_option('flickrRSS_before'))); ?>" size="10" />
        	  <label for="after_image">After Image:</label> <input name="after_image" type="text" id="after_image" value="<?php echo htmlspecialchars(stripslashes(get_option('flickrRSS_after'))); ?>" size="10" />
          </td>
         </tr>
         </table>      
        <h3>Cache Settings</h3>
		<p>This allows you to store the images on your server and reduce the load on Flickr. Make sure the plugin works without the cache enabled first. If you're still having
		trouble, try visiting the <a href="http://eightface.com/forum/viewforum.php?id=3">forum</a>.</p>
		<table class="form-table">
         <tr valign="top">
          <th scope="row">URL</th>
          <td><input name="image_cache_uri" type="text" id="image_cache_uri" value="<?php echo get_option('flickrRSS_image_cache_uri'); ?>" size="50" />
          <em>http://yoursite.com/cache/</em></td>
         </tr>
         <tr valign="top">
          <th scope="row">Full Path</th>
          <td><input name="image_cache_dest" type="text" id="image_cache_dest" value="<?php echo get_option('flickrRSS_image_cache_dest'); ?>" size="50" /> 
          <em>/home/path/to/wp-content/flickrrss/cache/</em></td>
         </tr>
		 <tr valign="top">
		  <th scope="row" colspan="2" class="th-full">
		  <input name="use_image_cache" type="checkbox" id="use_image_cache" value="true" <?php if(get_option('flickrRSS_use_image_cache') == 'true') { echo 'checked="checked"'; } ?> />  
		  <label for="use_image_cache">Enable the image cache</label></th>
		 </tr>
        </table>
        <div class="submit">
           <input type="submit" name="save_flickrRSS_settings" value="<?php _e('Save Settings', 'save_flickrRSS_settings') ?>" />
        </div>
        </form>
    </div>
<?php } // end flickrRSS_subpanel()
function flickrRSS_admin_menu() {
   if (function_exists('add_options_page')) {
        add_options_page('flickrRSS Settings', 'flickrRSS', 8, basename(__FILE__), 'flickrRSS_subpanel');
        }
}
add_action('admin_menu', 'flickrRSS_admin_menu'); 
add_action('plugins_loaded', 'widget_flickrRSS_init');
?><?php
/*     Variables     */
@define('CATEGORYTAGGING_VERSION', '2.4'); // Version
@define('CATEGORYTAGGING_BUILD', 1); // Build version
@define('CATEGORYTAGGING_ROOT', get_bloginfo('url') . '/' . PLUGINDIR . '/category-tagging/'); // Category Tagging directory
/*     Category Cloud Function <cattag_tagcloud>     */
function cattag_tagcloud(
	$min_scale = 10,
	$max_scale = 30,
	$min_include = 0,		// The minimum count to include a tag in the cloud. The default is 0 (include all tags).
	$sort_by = 'NAME_ASC',	// NAME_ASC | NAME_DESC | WEIGHT_ASC | WEIGHT_DESC
	$exclude = '',			// Tags to be excluded
	$include = '',			// Only these tags will be considered if you enter one ore more IDs
	$format = '<li><a rel="tag" href="%link%" title="%description% (%count%)" style="font-size:%size%pt">%title%<sub style="font-size:60%; color:#ccc;">%count%</sub></a></li>',
	$notfound = 'No tags found.'
	) {
	##############################################
	# Globals, variables, etc.
	##############################################
	$opt = array();
	$min_scale = (int) $min_scale;
	$max_scale = (int) $max_scale;
	$min_include = (int) $min_include;
	$exclude = preg_replace('/[^0-9,]/', '', $exclude);	// remove everything except 0-9 and comma
	$include = preg_replace('/[^0-9,]/', '', $include);	// remove everything except 0-9 and comma
	##############################################
	# Prepare order
	##############################################
	switch (strtoupper($sort_by)) {
		case 'NAME_DESC':
			$opt['$orderby'] = 'name';
			$opt['$ordertype'] = 'DESC';
	   		break;
		case 'WEIGHT_ASC':
			$opt['$orderby'] = 'count';
			$opt['$ordertype'] = 'ASC';
	   		break;
		case 'WEIGHT_DESC':
			$opt['$orderby'] = 'count';
			$opt['$ordertype'] = 'DESC';
	   		break;
		case 'RANDOM':	// Will be shuffled later 
			$opt['$orderby'] = 'name';
			$opt['$ordertype'] = 'ASC';
	   		break;
		default:	// 'NAME_ASC'
			$opt['$orderby'] = 'name';
			$opt['$ordertype'] = 'ASC';
	}
	##############################################
	# Retrieve categories
	##############################################	
	$catObjectOpt = array('type' => 'post', 'child_of' => 0, 'orderby' => $opt['$orderby'], 'order' => $opt['$ordertype'],
			'hide_empty' => true, 'include_last_update_time' => false, 'hierarchical' => 0, 'exclude' => $exclude, 'include' => $include,
			'number' => '', 'pad_counts' => false);
	$catObject = get_categories($catObjectOpt); // Returns an object of the categories
	##############################################
	# Prepare array
	##############################################
	// Convert object into array
	$catArray = cattag_aux_object_to_array($catObject); 
	// Remove tags
	$helper  = array_keys($catArray);	// for being able to unset 
	foreach( $helper as $cat ) { 
		if ( $catArray[$cat]['category_count'] < $min_include ) {
			unset($catArray[$cat]);
		}
	}
	// Exit if no tag found
	if (count($catArray) == 0) {
		return $notfound;
	}
	##############################################
	# Prepare font scaling
	##############################################
	// Get counts for calculating min and max values
	$countsArr = array();
	foreach( $catArray as $cat ) { $countsArr[] = $cat['category_count']; }
	$count_min = min($countsArr);
	$count_max = max($countsArr);
	// Calculate
	$spread_current = $count_max - $count_min; 
	$spread_default = $max_scale - $min_scale;
	if ($spread_current <= 0) { $spread_current = 1; };
	if ($spread_default <= 0) { $spread_default = 1; }
	$scale_factor = $spread_default / $spread_current;
	##############################################
	# Loop thru the values and create the result
	##############################################
	// Shuffle... -- thanks to Alex <http://www.artsy.ca/archives/159>
	if ( strtoupper($sort_by) == 'RANDOM') {
		$catArray = cattag_aux_shuffle_assoc($catArray);
	}
	$result = '';
	foreach( $catArray as $cat ) {
		// format
		$element_loop = $format;
		// font scaling		
		$final_font = (int) (($cat['category_count'] - $count_min) * $scale_factor + $min_scale);
		// replace identifiers
		$element_loop = str_replace('%link%', get_category_link($cat['cat_ID']), $element_loop);
		$element_loop = str_replace('%title%', $cat['cat_name'], $element_loop);
		$element_loop = str_replace('%description%', $cat['category_description'], $element_loop);
		$element_loop = str_replace('%count%', $cat['category_count'], $element_loop);
		$element_loop = str_replace('%size%', $final_font, $element_loop);
		// result
		$result .= $element_loop . "\n";	
	}
	$result = "\n" . '<!-- Tag Cloud, generated by \'Category Tagging\' plugin - http://blog.bull3t.me.uk/ -->' . "\n" . $result; // Please do not remove this line.
	return $result;
}
/*     Related Posts Function <cattag_related_posts>     */
function cattag_related_posts(
	$order = 'RANDOM',
	$limit = 5,
	$exclude = '',
	$display_posts = true,
	$display_pages = false,	
	$format = '<li><a href="%permalink%" title="%title%">%title%</a></li>',
	$dateformat = 'd.m',
	$notfound = '<li>No related posts found.</li>',
	$limit_days = 365
	) {
	##############################################
	# Globals, variables, etc.
	##############################################
	global $wpdb, $post, $wp_version;
	$limit = (int) $limit;
	$exclude = preg_replace('/[^0-9,]/','',$exclude);	// remove everything except 0-9 and comma
	##############################################
	# Prepare selection of posts and pages
	##############################################
	if ( ($display_posts === true) AND ($display_pages === true) ) {
		// Display both posts and pages
		$poststatus = "IN('publish', 'static')";
	} elseif ( ($display_posts === true) AND ($display_pages === false) ) {
		// Display posts only
		$poststatus = "= 'publish'";
	} elseif ( ($display_posts === false) AND ($display_pages === true) ) {
		// Display pages only
		$poststatus = "= 'static'";
	} else {
		// Nothing can be displayed
		return $notfound;
	}
	##############################################
	# Prepare exlusion of categories
	##############################################	
	$exclude_ids_sql = ($exclude == '') ? '' : 'AND post2cat.category_id NOT IN(' . $exclude . ')';
	##############################################
	# Put the category IDs into a comma-separated string
	##############################################
	$catsList = '';
	$count = 0;
	foreach((get_the_category()) as $loop_cat) { 
		// Add category id to list
		$catsList .= ( $catsList == '' ) ? $loop_cat->cat_ID : ',' . $loop_cat->cat_ID;
	}
	##############################################
	# Prepare order
	##############################################
	switch (strtoupper($order)) {
		case 'RANDOM':
			$order_by = 'RAND()';
			break;
		default:	// 'DATE_DESC'
			$order_by = 'posts.post_date DESC';
	}
	##############################################
	# Set limit of posting date. 86400 seconds = 1 day
	##############################################
	$timelimit = '';
	if ($limit_days != 0) $timelimit = 'AND posts.post_date > ' . date('YmdHis', time() - $limit_days*86400);
	##############################################
 	# SQL query. DISTINCT is here for getting a unique result without duplicates
	##############################################
	// since we support >= WP 2.1 only, stuff like AND posts.post_date < '" . current_time('mysql') . "'
	// is not necessary as future posts now gain the post_status of 'future' 
	if ($wp_version < "2.3") {
		// check wp version - if lower than 2.3 use old database format of 'categories' and 'post2cat'
		$queryresult = $wpdb->get_results("SELECT DISTINCT posts.ID, posts.post_title, posts.post_date, posts.comment_count
								FROM $wpdb->posts posts, $wpdb->post2cat post2cat
								WHERE posts.ID <> $post->ID
								AND posts.post_status $poststatus
								AND posts.ID = post2cat.post_id
								AND post2cat.category_id IN($catsList)
								$timelimit
								$exclude_ids_sql
								ORDER BY $order_by 
								LIMIT $limit
								");
	} else {
		// check wp version - if higher than 2.3 change to new database format of 'terms'
		$queryresult = $wpdb->get_results("SELECT DISTINCT posts.ID, posts.post_title, posts.post_date, posts.comment_count
								FROM $wpdb->posts posts, $wpdb->term_relationships term_relationships, $wpdb->term_taxonomy term_taxonomy
								WHERE posts.ID <> $post->ID
								AND posts.post_status $poststatus
								AND posts.ID = term_relationships.object_id
								AND term_relationships.term_taxonomy_id = term_taxonomy.term_taxonomy_id
								AND term_taxonomy.term_id IN($catsList)
								$timelimit
								$exclude_ids_sql
								ORDER BY $order_by 
								LIMIT $limit
								");
	}
	##############################################
	// Return the related posts
	##############################################
	$result = '';
	if (count($queryresult) > 0) {
		foreach($queryresult as $tag_loop) {
			// Date of post
			$loop_postdate = mysql2date($dateformat, $tag_loop->post_date);
			// Get format
			$element_loop = $format;
			// Replace identifiers
			$element_loop = str_replace('%date%', $loop_postdate, $element_loop);
			$element_loop = str_replace('%permalink%', get_permalink($tag_loop->ID), $element_loop);
			$element_loop = str_replace('%title%', $tag_loop->post_title, $element_loop);
			$element_loop = str_replace('%commentcount%', $tag_loop->comment_count, $element_loop);
			// Add to list
			$result .= $element_loop . "\n";
		}
		$result = "\n" . '<!--  -->' . "\n" . $result; 
		return $result;
	} else {
		return $notfound;
	}
}
################################################################################
# Additional functions
################################################################################
function cattag_aux_object_to_array($obj) {
	// dumps all the object properties and its associations recursively into an array
	// Source: http://de3.php.net/manual/de/function.get-object-vars.php#62470
       $_arr = is_object($obj) ? get_object_vars($obj) : $obj;
       foreach ($_arr as $key => $val) {
               $val = (is_array($val) || is_object($val)) ? cattag_aux_object_to_array($val) : $val;
               $arr[$key] = $val;
       }
       return $arr;
}
function cattag_aux_shuffle_assoc($input_array) {
	   if(!is_array($input_array) or !count($input_array))
	       return null;
	   $randomized_keys = array_rand($input_array, count($input_array));
	   $output_array = array();
	   foreach($randomized_keys as $current_key) {
	       $output_array[$current_key] = $input_array[$current_key];
	       unset($input_array[$current_key]);
	   }
	   return $output_array;
}
?><?php
function fb_replace_wp_version() {
	if ( !is_admin() ) {
		global $wp_version;
		// random value
		$v = intval( rand(0, 9999) );
		if ( function_exists('the_generator') ) {
			// eliminate version for wordpress >= 2.4
			add_filter( 'the_generator', create_function('$a', "return null;") );
			// add_filter( 'wp_generator_type', create_function( '$a', "return null;" ) );
			// for $wp_version and db_version
			$wp_version = $v;
		} else {
			// for wordpress < 2.4
			add_filter( "bloginfo_rss('version')", create_function('$a', "return $v;") );
			// for rdf and rss v0.92
			$wp_version = $v;
		}
	}
}
if ( function_exists('add_action') ) {
	add_action('init', fb_replace_wp_version, 1);
}
?><?php
function recent_cmts($num) {
	global $wpdb;
	$query = ("SELECT ID, post_title, comment_author, comment_id, comment_author_email, comment_date, comment_post_ID FROM  $wpdb->posts, $wpdb->comments WHERE $wpdb->posts.ID=$wpdb->comments.comment_post_ID AND $wpdb->comments.comment_approved = '1' AND $wpdb->comments.comment_type = '' AND comment_author != '' ORDER BY $wpdb->comments.comment_date DESC LIMIT $num");
	$result = mysql_query($query);
		while ($data = mysql_fetch_row($result)) {
		echo '<li class="recent-cmts">';
			echo '<img style="float: left; margin-right: 10px; padding: 3px; background:#fff;" src="http://www.gravatar.com/avatar.php?gravatar_id=';
			echo md5($data[4]);
			echo '&amp;size=20&amp;default=';
			echo bloginfo('template_url');
			echo '/images/24.gif';
			echo '" alt="';
			echo $data[2];
			echo '&#39;s Gravatar" height="20" width="20" class="recent_gravatars" />';
			echo '<div style="margin-left:22px;"><a href="';
			echo get_permalink($data[0]);
			echo "#comment-$data[3]";
			echo '" title="';
			echo 'commented on &raquo; ';
			echo $data[1];
			echo '"><strong>';
			echo $data[2];
			echo '</strong></a><br/><small>[';
			echo $data[5];
			echo ']</small></div>';
		echo '</li>';
		}
	}
?><?php
function gte_random_posts (){
global $wpdb, $post;
$current_title = get_the_title();
$randompostthis = $wpdb->get_results("SELECT $wpdb->posts.ID, post_title, post_name, post_date, post_type, post_status FROM $wpdb->posts WHERE post_type = 'post' AND post_status = 'publish' AND post_title != '$current_title' ORDER BY RAND() limit 5");
foreach ($randompostthis as $post) {
$post_title = htmlspecialchars(stripslashes($post->post_title));
echo "<li><a href=\"".get_permalink()."\">$post_title</a></li>";
}
}
function gte_recent_updated_posts(){
global $wpdb, $post;
$recentupdatethis = $wpdb->get_results("SELECT $wpdb->posts.ID, post_title, post_name, post_date, post_type, post_status, post_modified FROM $wpdb->posts WHERE post_type = 'post' AND post_status = 'publish' ORDER by post_modified_gmt DESC limit 5");
foreach ($recentupdatethis as $post) {
$post_title = htmlspecialchars(stripslashes($post->post_title));
echo "<li><a href=\"".get_permalink()."\">$post_title</a></li>";
}
}
function get_hottopics($limit = 10) {
    global $wpdb, $post;
    $mostcommenteds = $wpdb->get_results("SELECT  $wpdb->posts.ID, post_title, post_name, post_date, COUNT($wpdb->comments.comment_post_ID) AS 'comment_total' FROM $wpdb->posts LEFT JOIN $wpdb->comments ON $wpdb->posts.ID = $wpdb->comments.comment_post_ID WHERE comment_approved = '1' AND post_date_gmt < '".gmdate("Y-m-d H:i:s")."' AND post_status = 'publish' AND post_password = '' GROUP BY $wpdb->comments.comment_post_ID ORDER  BY comment_total DESC LIMIT $limit");
    foreach ($mostcommenteds as $post) {
			$post_title = htmlspecialchars(stripslashes($post->post_title));
			$comment_total = (int) $post->comment_total;
			echo "<li><a href=\"".get_permalink()."\">$post_title&nbsp;<strong>($comment_total)</strong></a></li>";
    }
}
function widget_mypopulartopic() {
?>
<?php if(function_exists("akpc_most_popular")) : ?>
<h3><?php _e('Most Popular'); ?></h3>
<ul class="list">
<?php akpc_most_popular(); ?>
</ul>
<?php endif; ?>
<?php
}
if ( function_exists('register_sidebar_widget') )
    register_sidebar_widget(__('Popular Post'), 'widget_mypopulartopic');
function widget_myhottopic() {
?>
<?php if(function_exists("get_hottopics")) : ?>
<h3><?php _e('Most Comments'); ?></h3>
<ul class="list">
<?php get_hottopics(); ?>
</ul>
<?php endif; ?>
<?php
}
if ( function_exists('register_sidebar_widget') )
    register_sidebar_widget(__('Most Comments'), 'widget_myhottopic');
function widget_myrecentcoms() {
?>
<h3><?php _e('Recent Comments'); ?></h3>
<ul class="list">
<?php if(function_exists("get_recent_comments")) : ?>
<?php get_recent_comments(); ?>
<?php else : ?>
<?php mw_recent_comments(10, false, 55, 35, 35, 'all', '<li><a href="%permalink%" title="%title%">%author_name%</a>&nbsp;in&nbsp;%title%</li>','d.m.y, H:i'); ?>
<?php endif; ?>
</ul>
<?php
}
if ( function_exists('register_sidebar_widget') )
    register_sidebar_widget(__('Recent Comments'), 'widget_myrecentcoms');
?>