<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the installation.
 * You don't have to use the web site, you can copy this file to "wp-config.php"
 * and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * Database settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'sitearac_wp3' );

/** Database username */
define( 'DB_USER', 'sitearac_wp3' );

/** Database password */
define( 'DB_PASSWORD', 'B.DcYiIWcLHgptnuuIN24' );

/** Database hostname */
define( 'DB_HOST', 'localhost' );

/** Database charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8' );

/** The database collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**#@+
 * Authentication unique keys and salts.
 *
 * Change these to different unique phrases! You can generate these using
 * the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}.
 *
 * You can change these at any point in time to invalidate all existing cookies.
 * This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         '1Rqd7QgbLczn7pw04V8GkMRHpCFyCDoiTBgTgFFvui7V1nFvzarS03TNckOGNQ2N');
define('SECURE_AUTH_KEY',  'Zy8nSbjCm2CDSpgQv8FbADLX1AWTZhnr0YjLyxXkcNRcs2HJcvmI3w9r0Q0NSGVp');
define('LOGGED_IN_KEY',    'B4r4otwRAKcfpPOmNbXus9TxsvQKoCyo5LshITbWNqtnLGXt6inRZt7VjrkJmfJi');
define('NONCE_KEY',        'PE2xbgBnH3l8vqZrdkYPLYLi3E6tsGOiRY9YwkCfFnCoRzRWidJI8Y3OIFu2zUIu');
define('AUTH_SALT',        '9jCUssu42zNZPJvpSZpwVbtqmgx6JflvllH6vJvFNA5JN3h5Xki5bOeRvUFZJCIM');
define('SECURE_AUTH_SALT', 'QG04PSLmOwD1nkEEIE94B0bIqqXUL1Ukqe1dsYle5jouBafRvBHpsyWWfuEYB0EE');
define('LOGGED_IN_SALT',   'EfGKZWNX8fPw9rPZygxgL7wrw1hwL1u6F99WwzW1hTOy4axh0wJUSlkEOh9u6GE0');
define('NONCE_SALT',       'KokNTfOegjp9HRSUxnF2xaH0fkOQutqHFm8WvPFjaIekvVsKZGgCdNwM7UtE5AkN');

/**
 * Other customizations.
 */
define('FS_METHOD','direct');
define('FS_CHMOD_DIR',0755);
define('FS_CHMOD_FILE',0644);
define('WP_TEMP_DIR',dirname(__FILE__).'/wp-content/uploads');


/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 *
 * For information on other constants that can be used for debugging,
 * visit the documentation.
 *
 * @link https://wordpress.org/support/article/debugging-in-wordpress/
 */
define( 'WP_DEBUG', false );

/* Add any custom values between this line and the "stop editing" line. */



/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
