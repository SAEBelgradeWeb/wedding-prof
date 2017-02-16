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
define('DB_NAME', 'wedding');

/** MySQL database username */
define('DB_USER', 'homestead');

/** MySQL database password */
define('DB_PASSWORD', 'secret');

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
define('AUTH_KEY',         '+y>IW3b^I:0Y3t5+jveDDBtJYlO?{9Ge?1GuVo+g?pdDXC$>2*^@ALS)zS=klbN^');
define('SECURE_AUTH_KEY',  '.Pf%GmjlH$hnKm;*Ho4.)?ltetq]U-?$DBLJDEqT4Hs[.t~&WV02vp0I$AKK)2(f');
define('LOGGED_IN_KEY',    'B)/p39+U.<rV.O-g+b5o5O]D])Y80<0 ~[:nq&Uz9Jz`?7wEyPW|B[Rr!a_l$0a?');
define('NONCE_KEY',        '2a{&HFtD(@)%?ho{kN]<~7UI:0pt,CL3-fDTm:a,|&[#cmadp[H/(bn z]N#&>9u');
define('AUTH_SALT',        '&z^;Q<4=fMt2@,sf*`Oe]|p)$p-z0:F*ROLAjTO>uKH>Rj?(9W8]vqh?;c1(02Rg');
define('SECURE_AUTH_SALT', ';oUK,q0[uPSOQLmmed5K4M5OGu!i/95n0A@b<O9RIvn4M+pEe[*%JQa/]WU4`_g_');
define('LOGGED_IN_SALT',   'uKKe|@/Aa_3Qrl,Y%<4FkC%z5NFXe&UyizeGvqH~YCG9Lj!@KXTNNleBr0a67Do*');
define('NONCE_SALT',       't5U0)ZlcEYereV~6yVQ6kWb!B,QHH/g=u*|ZHT$oM74P^}{%imy|Q0^H/L}UcdEh');

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
define('WP_DEBUG', true);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
