<?php
ini_set( "display_errors", true );
date_default_timezone_set( "Canada/Eastern" );  // http://www.php.net/manual/en/timezones.php
define( "DB_DSN", "mysql:host=localhost;dbname=k24848_jh" );
define( "DB_USERNAME", "k24848_jh" );
define( "DB_PASSWORD", "V1cdnad1" );
define( "CLASS_PATH", "classes" );
define( "TEMPLATE_PATH", "templates" );
define( "HOMEPAGE_NUM_ARTICLES", 5 );
define( "ADMIN_USERNAME", "jhooey" );
define( "ADMIN_PASSWORD", "password" );
require( CLASS_PATH . "/Article.php" );
 
function handleException( $exception ) {
  echo "Sorry, a problem occurred. Please try later.";
  error_log( $exception->getMessage() );
}
 
set_exception_handler( 'handleException' );
?>
