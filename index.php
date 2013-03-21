<?php
  
  /****************************************************************************
   * Title: index.php                                                         *
   * Author: Jacob Hooey                                                      *
   * URL: http://www.jacobhooey.com                                           *
   * Description: This is the index page for jacobhooey.com, a website        *
   *              use to demonstrate my skill in webdesign as well as         *
   *              a means to digitize my resume, as well as post info         *
   *              relating to projects I am currently working on.             *
   * Created: March 16th, 2012                                                *
   ****************************************************************************/
  
  
  
require( "admin/config.php" );
session_start();
$action = isset( $_GET['action'] ) ? $_GET['action'] : "";
 
  /* each link in the navigation bar of the website will point to a different action, 
   * the following switch statement uses the $nav variable to store a string relating to the action received.
   * This variable will then be used to populate the page with the appropriate content
   */
switch ( $action ) {
  case 'home':
    $nav = "home";
    break;
  case 'resume':
    $nav = "resume";
    break;
  case 'artwork':
    $nav = "artwork";
    break;
  case 'thesis':
    $nav = "thesis";
    break;
  case 'projects':
    $nav = "projects";
    break;
  case 'contact':
    $nav = "contact";
    break;
  default:
    $nav = "home";
}  

/*******************************************************************************
 * Summary:      This function is used to populate the webpage with content 
 *               relating to the users choice (ie what links he clicks)
 *
 * Parameters:   $nav: String - this holds the users choice
 * 
  *Added: March 16th, 2012
 ********************************************************************************/
function content($nav) {
  
  $results = array();
  
  //use getList from the Article class to collect all the articles relating to the users choice
  $data = Article::getList( 1000, "menu_order ASC", $nav ); 
  
  //now put the results into our results array
  $results['articles'] = $data['results'];
  
  //record the total number of articles (not used, but may be needed in the future
  $results['totalRows'] = $data['totalRows'];  
  
  //use the content template to output the required html
  require( "templates/content.php" ); 
  
}


content($nav);
    
?>
