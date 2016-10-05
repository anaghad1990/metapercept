<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the
 * installation. You don't have to use the web site, you can
 * copy this file to "wp-config.php" and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * MySQL settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://codex.wordpress.org/Editing_wp-config.php
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'wordpress');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', '');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8mb4');

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
define('AUTH_KEY',         'gv3YPB*,moV2;^)r($B$$nsCh60kRAq^~MNMC#_??-AYb<c[(Q5gsqUEA?l,#|4%');
define('SECURE_AUTH_KEY',  's9E8=9a&rCC65||_*#:3`p54A#CW_*K%L_)W(Bk~q9bfnZ^LeG7g =ZxcP-rc9gt');
define('LOGGED_IN_KEY',    ' @IN*<MSCgdc.C9rGX/bz2^>&J2^,j>uN{w,WJA<_i+>7o5;M+!e$8(PufGR[m8g');
define('NONCE_KEY',        '3u[8W`g{}iw<8KvAV_F;5V<y#f7wlj(?kS5|D{E/1~f?8pkhg_/[ie/>[e`=c&Ni');
define('AUTH_SALT',        '&(*Iqh?Qe/z#$K,}%yW>;xbMG|^H0c8AR1M8JJ7!/,c4IDx~Qcp30$/jSOfKb~i#');
define('SECURE_AUTH_SALT', '>Q!u9f2RMhs$:gh5GRzn)cZ==fvg;iE*wCe@o@Jpv@f`t;U`JU[`8xPLkD>.Zv(b');
define('LOGGED_IN_SALT',   ' kTmNt,MOBy:Yj4~W?8BHCK_f97sRU}GLw49JcE*/;^W@bxK$RZa#vZa6HjB^i]~');
define('NONCE_SALT',       '1}2C{E#SDFs~$C@2Y*>C/im#;w:0s![_wGK,8YjX[:I{ev-sgvVQwo [B96R>~FA');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 *
 * For information on other constants that can be used for debugging,
 * visit the Codex.
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */
define('WP_DEBUG', false);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
