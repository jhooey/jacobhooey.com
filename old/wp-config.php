<?php
/**
 * The base configurations of the WordPress.
 *
 * This file has the following configurations: MySQL settings, Table Prefix,
 * Secret Keys, WordPress Language, and ABSPATH. You can find more information
 * by visiting {@link http://codex.wordpress.org/Editing_wp-config.php Editing
 * wp-config.php} Codex page. You can get the MySQL settings from your web host.
 *
 * This file is used by the wp-config.php creation script during the
 * installation. You don't have to use the web site, you can just copy this file
 * to "wp-config.php" and fill in the values.
 *
 * @package WordPress
 */

define('RELOCATE',true);


// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'jacobhoo_wrd1');

/** MySQL database username */
define('DB_USER', 'jacobhoo_wrd1');

/** MySQL database password */
define('DB_PASSWORD', 'DdePfSa10a');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8');

/** The Database Collate type. Don't change this if in doubt. */
define('DB_COLLATE', '');

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         'LsC2t3ehcOZP59S3qzZ08My27F0JLj61rFtgix6vqjT4isgVlze7OycfBirk0mMA');
define('SECURE_AUTH_KEY',  'G3fRggr9X6znVlKvgOathhDF8CzHZWeToT14eZjSkZjBfqUjBelyo3NSWysPUqLa');
define('LOGGED_IN_KEY',    'IbFQ1lEsTBLkDz5LxctngZmGgWEdmgoCTsD7Rg9s8iF12lTLbXidPcOQBNYJDVxv');
define('NONCE_KEY',        'D0WF8Bb5DmRyQpsMpnKFv5Xsf71tXlBwdV5yS2jTqBjfK1LGKGWddCRMlvCQSTQn');
define('AUTH_SALT',        'TksPFQQ99HHWYBELapr0wLPjzzbSNjT1dJPZH4YkwtB5P5FTKmkMiUlc79PccTEo');
define('SECURE_AUTH_SALT', '8NgLoGtudOGTaDregMfOl6s29nXMhCHD6QicmjEG6c0xNTB5rBzBky9jSLnQsZ9p');
define('LOGGED_IN_SALT',   '4t74hYrKqZNyP6gzH4GCDDqoGTPalbHqmnN7VAnrLrnBjk6FDcH2DAiZpQoJMYfQ');
define('NONCE_SALT',       '3tC9ztpnjvquBIXMgKPQClch0ofsT2CPubcZcmtM5zjDN7wnCwBmQjKDfXO4cVAI');


define('WP_HOME','http://www.jacobhooey.com/old');
define('WP_SITEURL','http://www.jacobhooey.com/old');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

/**
 * WordPress Localized Language, defaults to English.
 *
 * Change this to localize WordPress. A corresponding MO file for the chosen
 * language must be installed to wp-content/languages. For example, install
 * de_DE.mo to wp-content/languages and set WPLANG to 'de_DE' to enable German
 * language support.
 */
define('WPLANG', '');

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 */
define('WP_DEBUG', false);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
