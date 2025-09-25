<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the installation.
 * You don't have to use the website, you can copy this file to "wp-config.php"
 * and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * Database settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://developer.wordpress.org/advanced-administration/wordpress/wp-config/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'wordpress' );

/** Database username */
define( 'DB_USER', 'wpuser' );

/** Database password */
define( 'DB_PASSWORD', 'wp_secure_password_2024' );

/** Database hostname */
define( 'DB_HOST', 'localhost' );

/** Database charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

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
define( 'AUTH_KEY',         'f`?~S&WqTRrw0*CateG-~@PD+EUglAHtB/@`)?dKzOoe+%Yq05VBt[XyPM+w:WuQ' );
define( 'SECURE_AUTH_KEY',  'D(O!B`w[7-0?sXO|?t87yRb;J#X2u4iOwfKZVN`zA!nZ1/o<Z$I!7kX3Po:d_POS' );
define( 'LOGGED_IN_KEY',    '9N%)&&<rA| U^4h!6*0M.&Yq9@8W4-lTzQk7}!6NC7:3/?bQg!:?Na3f:o$m9&sQ' );
define( 'NONCE_KEY',        'h{?Yq,R@b<[gE}`EgiG N}KD4k{.1e/y<}KBMW8,/BDnt]mPJ0Xh-?,?tgG|C1y^' );
define( 'AUTH_SALT',        '|#8>#DvGn-kEQU_=Rg.+Y`E/d85UZ4!qrL>,aIbD)|4Uh; wk%vl6uN@P%CiQb  ' );
define( 'SECURE_AUTH_SALT', 'Iz(}-,G,KL&qB]&8OU7w=F4@dXbHapwB^vLvl7H^d,A;F#_EU rSEW3CqT:YBld%' );
define( 'LOGGED_IN_SALT',   '8%V*8.fJBUuMrzjr;Hx%+$Zzv9Go:mC*P-[U<&~T599bRIhz)R^>4jGag,{*kT1A' );
define( 'NONCE_SALT',       '{JBe`x;9$1BS{L-h~?^wW,hcid-O6;15b0]tmX8=y{fP(n?>r|tJ;j@pbZQ;CHLP' );

/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 *
 * At the installation time, database tables are created with the specified prefix.
 * Changing this value after WordPress is installed will make your site think
 * it has not been installed.
 *
 * @link https://developer.wordpress.org/advanced-administration/wordpress/wp-config/#table-prefix
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
 * @link https://developer.wordpress.org/advanced-administration/debug/debug-wordpress/
 */
define('WP_DEBUG', true);
define('WP_DEBUG_LOG', true);

/* Add any custom values between this line and the "stop editing" line. */




/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';

define("DISALLOW_FILE_EDIT", false);
define("WP_HTTP_BLOCK_EXTERNAL", false);
define("WP_ACCESSIBLE_HOSTS", "polaris-launchpad.com,*.polaris-launchpad.com");
