<?php
// Load JS
if (!is_admin()) add_action( 'init', 'load_js' );
function load_js( ) {
	wp_enqueue_script('jquery');
	wp_enqueue_script('innerfade', get_bloginfo('stylesheet_directory').'/js/jquery.innerfade.js', array('jquery'));
	wp_enqueue_script('functions', get_bloginfo('stylesheet_directory').'/js/functions.js', array('jquery'));
}

function getPost($post = NULL) {
	include('post.php');
}

// Add Menu Theme Support
if ( function_exists( 'add_theme_support' ) ) { 
	add_theme_support( 'nav-menus' );
	add_action( 'init', 'register_gpp_menus' );
	add_theme_support('automatic-feed-links');
	add_theme_support( 'post-thumbnails' );
	set_post_thumbnail_size( 128, 128, true );
	add_image_size( '575x350', 575, 350, true); // 575x350 image size
	add_image_size( '950x200', 950, 200, true); // 950x200 image size

	function register_gpp_menus() {
		register_nav_menus(
			array(
				'main-menu' => __( 'Main Menu' ),
				'top-menu' => __( 'Top Menu' )
			)
		);
	}
}

// Allow Custom Background Image
// add_custom_background();

// Set Content Width
if(!isset($content_width)) $content_width = 575;

// Add Custom Header
define('HEADER_TEXTCOLOR', '');
define('HEADER_IMAGE', '%s/images/headers/arrow.jpg'); // %s is the template dir uri
// The height and width of your custom header. You can hook into the theme's own filters to change these values.
// Add a filter to gpp_base_header_image_width and gpp_base_header_image_height to change these values.
define( 'HEADER_IMAGE_WIDTH', apply_filters( 'gpp_base_header_image_width', 940 ) );
define( 'HEADER_IMAGE_HEIGHT', apply_filters( 'gpp_base_header_image_height', 200 ) );
define( 'NO_HEADER_TEXT', true );

	// Default custom headers packaged with the theme. %s is a placeholder for the theme template directory URI.
	register_default_headers( array(
		'bottles' => array(
			'url' => '%s/images/headers/bottles.jpg',
			'thumbnail_url' => '%s/images/headers/bottles-thumbnail.jpg',
			/* translators: header image description */
			'description' => __( 'Bottles', 'gpp_base_lang' )
		),
		'brush' => array(
			'url' => '%s/images/headers/brush.jpg',
			'thumbnail_url' => '%s/images/headers/brush-thumbnail.jpg',
			/* translators: header image description */
			'description' => __( 'Brush', 'gpp_base_lang' )
		),
		'clouds' => array(
			'url' => '%s/images/headers/clouds.jpg',
			'thumbnail_url' => '%s/images/headers/clouds-thumbnail.jpg',
			/* translators: header image description */
			'description' => __( 'Clouds', 'gpp_base_lang' )
		),
		'arrow' => array(
			'url' => '%s/images/headers/arrow.jpg',
			'thumbnail_url' => '%s/images/headers/arrow-thumbnail.jpg',
			/* translators: header image description */
			'description' => __( 'Arrow', 'gpp_base_lang' )
		),
		'surf' => array(
			'url' => '%s/images/headers/surf.jpg',
			'thumbnail_url' => '%s/images/headers/surf-thumbnail.jpg',
			/* translators: header image description */
			'description' => __( 'Surf', 'gpp_base_lang' )
		),
		'wood' => array(
			'url' => '%s/images/headers/wood.jpg',
			'thumbnail_url' => '%s/images/headers/wood-thumbnail.jpg',
			/* translators: header image description */
			'description' => __( 'Wood', 'gpp_base_lang' )
		)
	) );


// Add Custom Header CSS to Admin
function gpp_mpro_admin_header_style() {
	$header_height = HEADER_IMAGE_HEIGHT;
	$header_width = HEADER_IMAGE_WIDTH;
    ?><style type="text/css">
        #headimg {
            width: <?php echo $header_width; ?>px !important;
            height: <?php echo $header_height; ?>px !important;
            padding: 3em 0 2em 2em;
            background-repeat: no-repeat;
        }
    </style><?php
}

// Add Custom Header CSS to Admin
function gpp_mpro_header_style() {
	$header_height = HEADER_IMAGE_HEIGHT;
	$header_width = HEADER_IMAGE_WIDTH;
    ?><style type="text/css">
        .headerimg {
            width: <?php echo $header_width; ?>px !important;
            height: <?php echo $header_height; ?>px !important;
            background-repeat: no-repeat;
            border-top: 5px solid #000;
            border-right: 5px solid #000;
            border-left: 5px solid #000;
        }
    </style><?php
}

add_custom_image_header('gpp_mpro_header_style', 'gpp_mpro_admin_header_style');



if ( function_exists('register_sidebar') )
{
    register_sidebar
    (   array
        (
          'name' => 'Sidebar',
          'before_widget' => '<div class="bottombar">',
          'after_widget' => '</div>',
          'before_title' => '<h2 class="widgettitle">',
          'after_title' => '</h2>',
        )
    );
   	register_sidebar
    (   array
        (
          'name' => 'Sidebar-Single',
          'before_widget' => '<div class="bottombar">',
          'after_widget' => '</div>',
          'before_title' => '<h2 class="widgettitle">',
          'after_title' => '</h2>',
        )
    );
    register_sidebar
    (   array
        (
          'name' => 'Sidebar-Home',
          'before_widget' => '<div class="bottombar">',
          'after_widget' => '</div>',
          'before_title' => '<h2 class="widgettitle">',
          'after_title' => '</h2>',
        )
    );  
    register_sidebar
    (   array
        (
          'name' => 'Bottom-Left',
          'before_widget' => '<div class="bottombar">',
          'after_widget' => '</div>',
          'before_title' => '<h2 class="widgettitle">',
          'after_title' => '</h2>',
        )
    );  
    register_sidebar
    (   array
        (
          'name' => 'Bottom-Middle',
          'before_widget' => '<div class="bottombar">',
          'after_widget' => '</div>',
          'before_title' => '<h2 class="widgettitle">',
          'after_title' => '</h2>',
        )
    );   
 register_sidebar
    (   array
        (
          'name' => 'Bottom-Right',
          'before_widget' => '<div class="bottombar">',
          'after_widget' => '</div>',
          'before_title' => '<h2 class="widgettitle">',
          'after_title' => '</h2>',
        )
    );   
}
// THEME OPTIONS - DO NOT EDIT
$themename = "Monochrome";
$shortname = "dt";
$options = array (
	array("name" => "Top Left Category",
		"id" => $shortname."_top_left_cat",
		"std" => "1",
		"type" => "text"),
	array("name" => "Top Right Category",
		"id" => $shortname."_top_right_cat",
		"std" => "",
		"type" => "text"),
	array("name" => "Middle Left Category",
		"id" => $shortname."_mid_left_cat",
		"std" => "",
		"type" => "text"),
	array("name" => "Middle Right Category",
		"id" => $shortname."_mid_right_cat",
		"std" => "",
		"type" => "text"),
	array("name" => "Bottom 1st Category",
		"id" => $shortname."_bot_1st_cat",
		"std" => "",
		"type" => "text"),
	array("name" => "Bottom 2nd Category",
		"id" => $shortname."_bot_2nd_cat",
		"std" => "",
		"type" => "text"),
	array("name" => "Bottom 3rd Category",
		"id" => $shortname."_bot_3rd_cat",
		"std" => "",
		"type" => "text"),
	array("name" => "Bottom 4th Category",
		"id" => $shortname."_bot_4th_cat",
		"std" => "",
		"type" => "text"),
	array("name" => "Bottom 5th Category",
		"id" => $shortname."_bot_5th_cat",
		"std" => "",
		"type" => "text")
);

add_action('admin_menu', 'theme_add_admin');

function theme_add_admin() { 

	global $themename, $shortname, $options;
	
	if ( $_GET['page'] == basename(__FILE__) ) {
	
		if ( 'save' == $_REQUEST['action'] ) {
			foreach ($options as $value) {
				update_option( $value['id'], $_REQUEST[ $value['id'] ] );
			}
			
			foreach ($options as $value) {
				if( isset( $_REQUEST[ $value['id'] ] ) ) {
					update_option( $value['id'], $_REQUEST[ $value['id'] ]  );
				} else { 
					delete_option( $value['id'] );
				}
			}
			
			header("Location: themes.php?page=functions.php&saved=true");
			die;
			
		} else if( 'reset' == $_REQUEST['action'] ) {
			foreach ($options as $value) {
				delete_option( $value['id'] );
			}
			header("Location: themes.php?page=functions.php&reset=true");
			die;
		}
	}
	
	add_theme_page($themename." Options", "Theme Options", 'edit_themes', basename(__FILE__), 'theme_admin');
}

function theme_admin() {

	global $themename, $shortname, $options;
	
	if ( $_REQUEST['saved'] )
		echo '<div id="message" class="updated fade"><p><strong>'.$themename.' settings saved.</strong></p></div>';
	if ( $_REQUEST['reset'] )
		echo '<div id="message" class="updated fade"><p><strong>'.$themename.' settings reset.</strong></p></div>';
	?>
	
	<div class="wrap">
	
		<h2><?php echo $themename; ?> settings</h2>
		
		<div id="currenttheme">
			<img src="<?php bloginfo('stylesheet_directory'); ?>/images/options.jpg" alt"" />
		</div>
		
		<form method="post">
		
			<table class="optiontable">
			<?php foreach ($options as $value) { if ($value['type'] == "text") { ?>
				<tr valign="top">
					<th scope="row"><?php echo $value['name']; ?>:</th>
					<td><input name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>" type="<?php echo $value['type']; ?>" value="<?php if ( get_option( $value['id'] ) != "") { echo get_option( $value['id'] ); } else { echo $value['std']; } ?>" /></td>
				</tr>
				<?php } elseif ($value['type'] == "select") { ?>
				<tr valign="top">
					<th scope="row"><?php echo $value['name']; ?>:<br /><small><?php echo $value['desc']; ?></small></th>
					<td><select name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>"><?php foreach ($value['options'] as $option) { ?><option<?php if ( get_option( $value['id'] ) == $option) { echo ' selected="selected"'; } elseif ($option == $value['std']) { echo ' selected="selected"'; } ?>><?php echo $option; ?></option><?php } ?></select></td>
				</tr>
				<?php } } ?>
			</table>
			
			<p class="submit">
				<input name="save" type="submit" value="Save changes" /><input type="hidden" name="action" value="save" />
			</p>
			
		</form>
		
		<form method="post">
			<p class="submit">
				<input name="reset" type="submit" value="Reset" />
				<input type="hidden" name="action" value="reset" />
			</p>
		</form>
		
<?php } ?>