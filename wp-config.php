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
define('DB_NAME', 'smp_new');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', 'root');

/** MySQL hostname */
define('DB_HOST', '127.0.0.1:8889');

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
define('AUTH_KEY',         '?lM!fqS:BRu&{`J5jtz$Edq3J)bK>im12rvSScO*D}B#%?:)X/UarP<tnK<||*SF');
define('SECURE_AUTH_KEY',  'T{)S?HZU]War`L49kKplRPMN<s#Z}N;Fp^#@[K)3S4R25x_ZW@^+kMGo&vcT^wS#');
define('LOGGED_IN_KEY',    '}-DLD4`??}r#YC#*7(KaoU@c[tQdh,(]`qS8Pros{T/u _~XW9nw`SBmE^+Jar6k');
define('NONCE_KEY',        'bXc>)/Z/a,PL5/Z4@xCO<+J$0F}Se>Ghueye1joo0{dm%G6?C1ibIRsa5Q]H8hD!');
define('AUTH_SALT',        'B.vEoZIg?{.@&{j~V|N0:_h_2av%J-KPuC=N6$XBGTx6+cc[8IIb9n;X@(<h{,Fv');
define('SECURE_AUTH_SALT', '`hRmnE:U4Om!XB~@o>_LLe]g.Gs*56.ZG(nE.~d^iryF5MC*P29oX.%&PvU?DlNB');
define('LOGGED_IN_SALT',   '`v@QEuwO$y9Pt(hq$H&rdZj8tJQ3UPYSU%8(-#YQ?)2%QCa3@:k4yj]6g3WWmv2:');
define('NONCE_SALT',       'v{(s+Q9Senjx=^U*$h9`V]}Q~XkB@e[Gbk~h.7DtJ,MtdU}o<UQP]uWacT%o%j1m');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'new_';

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
