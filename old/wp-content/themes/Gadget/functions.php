<?php

include('functions/images.php');
include('functions/widgets.php');
include('functions/widgets/flickr.php');
include('functions/comments.php');

// Enable WordPress 3.0+ Features
if (function_exists('wp_nav_menu')) {
	register_nav_menus( 
		array( 'top-nav' => __( 'Top Navigation', 'Gadget' ))
	 );
} 

// Limit post excerpts word count
function new_excerpt_length($length) {
	return 40;
}
add_filter('excerpt_length', 'new_excerpt_length');

// Theme Options Page
$themename = "Gadget";
$shortname = "gt";

$tj_categories_obj = get_categories('hide_empty=0');
$tj_categories = array();
foreach ($tj_categories_obj as $tj_cat) {
	$tj_categories[$tj_cat->cat_ID] = $tj_cat->cat_name;
}
$categories_tmp = array_unshift($tj_categories, "");

$options = array (


// General Options ================================= //

array(    
	"type" => "set-open",
	"class" => "general",
	"name" => "General Options"),

		array(    
			"type" => "text",
			"name" => "Feedburner URL",
		    "desc" => "Enter your Feedburner URL here.  Leave it blank to disable the RSS icon.",
		    "id" => $shortname."_feedburner_url",
		    "std" => ""),
		
		array(
			"type" => "textarea",
			"name" => "Google Analytics",
		    "desc" => "Paste your Google Analytics tracking code here",
		    "id" => $shortname."_google_analytics"),
		    
		array(	
			"name" => "Upload a Logo",
			"desc" => "Upload a logo, copy the file URL, and paste it in the box above.",
			"id" => $shortname."_logo_image",
			"std" => "",
			"type" => "upload"),
			
		array(  
			"type" => "select",
			"name" => "Color scheme",
		    "desc" => "Select the color scheme.",
		    "id" => $shortname."_stylesheet",
		    "options" => array("black-orange", "black-green", "silver-blue"),
		    "std" => "black-orange"),
	
array(    
	"type" => "set-close"),
	



// Featured Slider ================================= //

array(    
	"type" => "set-open",
	"class" => "slider",
	"name" => "Featured Slider"),
	
		array(
			"type" => "sub-header",
			"instructions" => "The following options control the featured posts slider on the home page."),	
	
		array(  
			"type" => "select",
			"name" => "Featured category",
		    "desc" => "Choose the category for the home page featured posts slider.",
		    "id" => $shortname."_featured_category",
		    "options" => $tj_categories,
		    "std" => ""),
		
		array(    
			"type" => "text",
			"name" => "Featured posts count",
		    "desc" => "Enter the number of posts to display in the home page featured slider.",
			    "id" => $shortname."_featured_count",
		    "std" => "3"),
		    
array(    
	"type" => "set-close"),
	

// Social Media ================================= //

array(    
	"type" => "set-open",
	"class" => "social-media",
	"name" => "Social Media"),

	// Twitter
	
			
			array(  
				"type" => "checkbox",
				"name" => "Enable Twitter icon in header",
			    "desc" => "Check this box to display the twitter icon in the header.",
			    "id" => $shortname."_enable_twitter_icon",
			    "std" => "true"),
					
			array(    
				"type" => "text",
				"name" => "Twitter Username",
			    "desc" => "Enter your Twitter username here.  Leave it blank to disable Twitter.",
			    "id" => $shortname."_twitter_username",
			    "std" => ""),

		
	// Facebook

							
			array(    
				"type" => "text",
				"name" => "Facebook URL",
				   "desc" => "Enter your Facebook page URL here.  Leave it blank to disable Facebook icon in the header.",
			    "id" => $shortname."_facebook_url",
			    "std" => ""),
		
		
array(    
	"type" => "set-close"),
	
// Earn Money! ================================= //


array(    
	"type" => "set-open",
	"class" => "footer",
	"name" => "Footer"),
		
		array(    
			"type" => "text",
			"name" => "<b>EARN MONEY!</b>",
		    "desc" => "Enter your ThemeJam Affiliate link URL<br /><br />Use your ThemeJam affiliate link as the URL for the footer credit and earn 30% of every sale it generates!  To become a ThemeJam affiliate, visit <a href='http://www.themejam.com/affiliates'>themejam.com/affiliates</a>.",
			"id" => $shortname."_affiliate_url",
		    "std" => "http://www.themejam.com"),
		
		array(  
			"type" => "checkbox",
			"name" => "Disable ThemeJam Credit",
		    "desc" => "Check this box if you would like to DISABLE the ThemeJam credit in the footer.",
		    "id" => $shortname."_disable_tj_credit",
		    "std" => "false"),
	
		
array(    
	"type" => "set-close")

);

function themejam_options() {
    global $themename, $shortname, $options;
    if ( $_GET['page'] == basename(__FILE__) ) {
        if ( 'save' == $_REQUEST['action'] ) {
                foreach ($options as $value) {
                    update_option( $value['id'], $_REQUEST[ $value['id'] ] ); }
                foreach ($options as $value) {
                    if( isset( $_REQUEST[ $value['id'] ] ) ) { update_option( $value['id'], $_REQUEST[ $value['id'] ]  ); } else { delete_option( $value['id'] ); } }
                header("Location: themes.php?page=functions.php&saved=true");
                die;
        } else if( 'reset' == $_REQUEST['action'] ) {
            foreach ($options as $value) {
                delete_option( $value['id'] ); }
            header("Location: themes.php?page=functions.php&reset=true");
            die;
        }
    }
    
    add_theme_page($themename."", "".$themename." Options", 'edit_themes', basename(__FILE__), 'mytheme_admin');
}
function mytheme_admin() {
    global $themename, $shortname, $options;
    if ( $_REQUEST['saved'] ) echo '<div id="message" class="updated fade"><p><strong>'.$themename.' settings saved.</strong></p></div>';
    if ( $_REQUEST['reset'] ) echo '<div id="message" class="updated fade"><p><strong>'.$themename.' settings reset.</strong></p></div>';
?>

<link rel="stylesheet" type="text/css" href="<?php bloginfo('template_directory'); ?>/functions/tj-options-panel.css" />

<?php wp_enqueue_script('jquery'); ?>
<script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/scripts/tj-options-panel.js"></script>

</head>

<body>

<div class="wrap">
  <div id="poststuff">
  
	<h2><?php echo $themename; ?> Options</h2>
	
	<div class="postbox options-nav clearfix">
	
		<ul class="clearfix" id="nav">
			<?php foreach ($options as $value) {
					switch ( $value['type'] ) {
						case "set-open": ?>
							<li><a href="#<?php echo $value['class']; ?>"><?php echo $value['name']; ?></a></li>
						<?php break; 
					}
				  } ?>
		</ul>
		
		<ul class="clearfix" id="themejam">
			<li class="last"><a href="http://www.themejam.com/">ThemeJam.com</a></li>
		</ul>
	
	</div><!--/ .postbox -->

<form method="post">

<?php foreach ($options as $value) {

switch ( $value['type'] ) {

case "set-open": ?>
	<a name="<?php echo $value['class']; ?>"></a>
	<div class="postbox">
		<h3><?php echo $value['name']; ?></h3>
		<div class="inside">
<?php break;

case "set-close": ?>
		</div><!--/ .inside -->
	</div><!--/ .postbox -->
	
	<div class="actions clearfix">

		<div class="action">
			<input class="button-primary" name="save" type="submit" value="Save changes" />
		</div>
		<div class="action back-to-top">
			<a href="#">Back to top</a>
		</div>
	
	</div><!--/ .actions -->
	
<?php break;

case "sub-header": ?>
	<div class="sub-header">
		<h4><?php echo $value['name']; ?></h4>
		<?php if ( $value['instructions'] ) : ?><p><?php echo $value['instructions']; ?></p><?php endif ?>
	</div><!--/ .option -->
<?php break;

case 'text': ?>

<div class="option clearfix">
    <div class="option-title"><label><?php echo $value['name']; ?></label></div>
    <div class="option-input"><input name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>" type="<?php echo $value['type']; ?>" value="<?php if ( get_settings( $value['id'] ) != "") { echo stripslashes(get_settings( $value['id'] )); } else { echo $value['std']; } ?>" />
    	<div class="description"><?php echo $value['desc']; ?></div>
    </div><!--/ .option-input -->
</div><!--/ .option -->

<?php
break;

case 'textarea': ?>

<div class="option clearfix">
    <div class="option-title"><label><?php echo $value['name']; ?></label></div>
    <div class="option-input"><textarea name="<?php echo $value['id']; ?>" type="<?php echo $value['type']; ?>" cols="" rows=""><?php if ( get_settings( $value['id'] ) != "") { echo stripslashes(get_settings( $value['id'] )); } else { echo $value['std']; } ?></textarea>
    	<div class="description"><?php echo $value['desc']; ?></div>
    </div><!--/ .option-input -->
</div><!--/ .option -->

<?php
break;

case 'select': ?>
<div class="option clearfix">
    <div class="option-title"><label><?php echo $value['name']; ?></label></div>
    <div class="option-input"><select name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>"><?php foreach ($value['options'] as $option) { ?><option<?php if ( get_settings( $value['id'] ) == $option) { echo ' selected="selected"'; } elseif ($option == $value['std']) { echo ' selected="selected"'; } ?>><?php echo $option; ?></option><?php } ?></select>
    	<div class="description"><?php echo $value['desc']; ?></div>
    </div><!--/ .option-input -->
</div><!--/ .option -->

<?php
break;

case 'checkbox': ?>
<div class="option checkbox clearfix">
    <div class="option-title"><label><?php echo $value['name']; ?></label></div>
    <div class="option-input"><?php if(get_settings($value['id'])){ $checked = "checked=\"checked\""; }else{ $checked = ""; } ?><input type="checkbox" name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>" value="true" <?php echo $checked; ?> />
    	<div class="description"><?php echo $value['desc']; ?></div>
    </div><!--/ .option-input -->
</div><!--/ .option -->

<?php 
break;

case 'upload': ?>
<div class="option upload clearfix">
    <div class="option-title"><label><?php echo $value['name']; ?></label></div>
    <div class="option-input">
		<a class="button thickbox" href="media-upload.php?KeepThis=true&TB_iframe=true&width=640&height=700">Upload file</a>
		<input name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>" type="text" value="<?php if ( get_settings( $value['id'] ) != "") { echo get_settings( $value['id'] ); } else { echo $value['std']; } ?>" />
    	<div class="description"><?php echo $value['desc']; ?></div>
    </div><!--/ .option-input -->
</div><!--/ .option -->

<?php 
break;

}
}

?>

<input type="hidden" name="action" value="save" />
</form>

<div class="actions">

	<form method="post">
		<input class="button-secondary" name="reset" type="submit" value="Reset All Options" />
		<input type="hidden" name="action" value="reset" />
	</form>

</div><!--/ .actions -->

</div><!--/ #poststuff -->

<?php
}

if (function_exists('wp_enqueue_style')) {		
		wp_enqueue_script('thickbox');
		wp_enqueue_style('thickbox');
	}

add_action('admin_menu', 'themejam_options');  


?>