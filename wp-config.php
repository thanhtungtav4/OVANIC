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
define( 'DB_NAME', 'ovanic2' );

/** Database username */

define( 'DB_USER', 'root' );



/** Database password */
define( 'DB_PASSWORD', '' );



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

define('AUTH_KEY',         'q:l+Zmwfj-7!H_VdYy-p~dfQs&V+T0vbAS0alfzCr~Jfh/mH*p5t#Yhd`KSn*4m6');

define('SECURE_AUTH_KEY',  'R?*O8hYNHJ0W+),N+i=L-+hd//b2+Huc0NAh2%dA6,L<>IAIAfWqc~<wI&N9z`c ');

define('LOGGED_IN_KEY',    't_;msDtg/s:cbtuihh@4}m,8Anjf>T6|R)8gwi.EdgxQ=p>Ko@Xd,UaR`RWH+3z+');

define('NONCE_KEY',        'GI#C)-,x[=L|fa%TFoeSn|,jfqSe3--<5|_djn@dfk&fgY%ZR`y=C|inZ/Pej8T?');

define('AUTH_SALT',        'g=x6<jqCM]k@>rFgIsR7WAXsgRiUBu-0wbmhqK|<Ejz.+yZ}I].Fn(V9?-Ow6S6E');

define('SECURE_AUTH_SALT', 'zo:uks4_W6U#q(qx6h-he$xYV6C~Qtz0[bA(Qi91i&e9GeB@|}K,^MWo$:pB|0sm');

define('LOGGED_IN_SALT',   'W=OBm6V|pNEemH,nJ$j4u09[[*3T|Ygj5<Ry/PYYVcQ$I|J.vYGxWh*]O.0,^-A{');

define('NONCE_SALT',       'y~T#!G^Z4.V2u5t2/~]9!{-]iG5dW@Z32P|RT?FcfOj6GGI2$Yp1&QB`Tt;t0B2x');



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
define( 'WP_DEBUG', true);

/* Add any custom values between this line and the "stop editing" line. */







/* That's all, stop editing! Happy publishing. */



/** Absolute path to the WordPress directory. */

if ( ! defined( 'ABSPATH' ) ) {

	define( 'ABSPATH', __DIR__ . '/' );

}



/** Sets up WordPress vars and included files. */

require_once ABSPATH . 'wp-settings.php';

