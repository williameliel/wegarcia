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

// Include local configuration
if (file_exists(dirname(__FILE__) . '/local-config.php')) {
	include(dirname(__FILE__) . '/local-config.php');
}

// Global DB config
if (!defined('DB_NAME')) {
	define('DB_NAME', 'wedb');
}
if (!defined('DB_USER')) {
	define('DB_USER', 'root');
}
if (!defined('DB_PASSWORD')) {
	define('DB_PASSWORD', 'root');
}
if (!defined('DB_HOST')) {
	define('DB_HOST', 'localhost');
}

/** Database Charset to use in creating database tables. */
if (!defined('DB_CHARSET')) {
	define('DB_CHARSET', 'utf8');
}

/** The Database Collate type. Don't change this if in doubt. */
if (!defined('DB_COLLATE')) {
	define('DB_COLLATE', '');
}

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         '[Lt^`ozqLR#mpP0iQkc6mw,{|] +ol!4k/*}jSeK4^9@ecAyc3y3#O=dr%^ETqCU');
define('SECURE_AUTH_KEY',  'luVr-1L.g~Y^ZTf;|-3KL:Xf=+{I[|*t|%P)&@V}muY[(!kw:Sls61)j7>ejIWc_');
define('LOGGED_IN_KEY',    '*+R7+H[Rh^|+pU>5yoGP=o xHL/6;SZg%toh[lg=H?Z:Uq~BQ[X9e|!hi@$rsA@-');
define('NONCE_KEY',        '7F!1qs=JBYLt%O)TKMc3?}WJa!x2C(6IDDW/E3$*fmCB5kE-.3$;T($IF0ikhg&-');
define('AUTH_SALT',        'Waq4+!^n%2*76O-+MHDJ{_2,<rQ9sRZK#+-Q1}C@.i3]G>U2Ftw2J+sE{K0TZ7<C');
define('SECURE_AUTH_SALT', '%G.cy651K-ZAx1NST`~jA7E&W8_;W<kue{l+AX7(Q4emIH2tLk&#C@1Q--ARBS@d');
define('LOGGED_IN_SALT',   '|{;G42or:z+`5aM*rybHD?W-12H!QPcG((G^tOPRT/d-Ot>}nw/JU.q|KE><r07W');
define('NONCE_SALT',       '@|+e^b|xAKQ(jDI@JjJFWX&[@qq3Q]bD++IX)`<!q5+jwU>*LEFpCA2x2w}#fXRU');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'we_';

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
 * Set custom paths
 *
 * These are required because wordpress is installed in a subdirectory.
 */
if (!defined('WP_SITEURL')) {
	define('WP_SITEURL', 'http://' . $_SERVER['SERVER_NAME'] . '/wp');
}
if (!defined('WP_HOME')) {
	define('WP_HOME',    'http://' . $_SERVER['SERVER_NAME'] . '');
}
if (!defined('WP_CONTENT_DIR')) {
	define('WP_CONTENT_DIR', dirname(__FILE__) . '/content');
}
if (!defined('WP_CONTENT_URL')) {
	define('WP_CONTENT_URL', 'http://' . $_SERVER['SERVER_NAME'] . '/content');
}


/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 */
if (!defined('WP_DEBUG')) {
	define('WP_DEBUG', true);
}

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
