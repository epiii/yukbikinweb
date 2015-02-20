<?php
/**
 * The base configurations of the WordPress.
 *
 * This file has the following configurations: MySQL settings, Table Prefix,
 * Secret Keys, and ABSPATH. You can find more information by visiting
 * {@link http://codex.wordpress.org/Editing_wp-config.php Editing wp-config.php}
 * Codex page. You can get the MySQL settings from your web host.
 *
 * This file is used by the wp-config.php creation script during the
 * installation. You don't have to use the web site, you can just copy this file
 * to "wp-config.php" and fill in the values.
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'yukbikinweb');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', '');

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
define('AUTH_KEY',         '~4|CY5^9[ur#(kHC>~w$+7-p3Dy$;rTF|$3R>}$I!_#H=Ivgv.UiF#B4/.6D &uv');
define('SECURE_AUTH_KEY',  'eSk(JSNYQGi57iA:Bn)t0x|+Bu0NHZ(-r7:It?~~JVs;SN0wwR7~%[6(8j:?j/Fh');
define('LOGGED_IN_KEY',    '^Wwl:1Z7@sGoU[RY6RS%C-w0<q9GfGA.|<o{V3sr;No&ULP*ikB}kSv+Tur@s&ZJ');
define('NONCE_KEY',        'n,)8%T:R1HaOcG5ZhU,Q14oq;dihf(hpAl$Zal-!>zatK+p8H5RkT;1W.;YakgG.');
define('AUTH_SALT',        '@f]@ETEIQG;jD-;P2B$L+{F{@`b+Ym ?#^!F`(|^w0j@z813)&h*Jl! UvK+$D0{');
define('SECURE_AUTH_SALT', 'fw#c(WCig=DM-f!D[z3FCN>k+e8+Ci}G{iy_fqX7P-%Cx*e?^g:TbxP,~ ~n,kQI');
define('LOGGED_IN_SALT',   '5<YWj5hZ`/]gA6Wv2~kq3;WGXO|^$ -Zr|mmE `hm+PY7,Tz5YQBYgz <XC5QV1e');
define('NONCE_SALT',       ':e1P0X4P@I[}*a12v4*jE.Gej9Ev|/}dBl<~o> d}<^K]1y;h&X3#|eo[|T>d|+U');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'ybw_';

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
