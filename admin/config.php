<?php
ini_set( "display_errors", true );
date_default_timezone_set( "Canada/Eastern" );  // http://www.php.net/manual/en/timezones.php
define( "DB_DSN", "mysql:host=localhost;dbname=DATABASE NAME HERE" ); //
define( "DB_USERNAME", "DATABASE USERNAME HERE" );
define( "DB_PASSWORD", "DATABASE PASSWORD HERE" );
define( "CLASS_PATH", "classes" );
define( "TEMPLATE_PATH", "templates" );
define( "HOMEPAGE_NUM_ARTICLES", 5 );
define( "ADMIN_USERNAME", "CMS USERNAME HERE" );
define( "ADMIN_PASSWORD", "CMS PASSWORD HERE" );
require( CLASS_PATH . "/Article.php" );
 
function handleException( $exception ) {
  echo "Sorry, a problem occurred. Please try later.";
  error_log( $exception->getMessage() );
}
 
set_exception_handler( 'handleException' );
?>
