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
define('DB_USER', 'wordpress');

/** MySQL database password */
define('DB_PASSWORD', 'PhohZaZie7zu');

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
define('AUTH_KEY',         'aiGhei7ohp1oonetooceeMahDa1Eu6ogh1ahx6ohhaeg9ree8eiShai3uVie9Gah2');
define('SECURE_AUTH_KEY',  'jeishoochiechei8Jooc7too6Nab6aiL5nei0phaweiph5quaixaixaetee5lu2eo');
define('LOGGED_IN_KEY',    'pi1aevah3meekiegoosee3iarooSaiv6ze9ohshae5unahph8chemichiengaiqua');
define('NONCE_KEY',        'thee8igiefiequohchacieghaicohxuulahch5AitopeiSh8uechaeree2Vee5cha');
define('AUTH_SALT',        'fead2ozunae4thizoovoovie8zoaph6uithuD5ma6oo6ohC5ohnah5ein2jaeCuzo');
define('SECURE_AUTH_SALT', 'phaizeez5mau4ieteeX6huf5Eechohw8ku4iot9thu0yahpheiKechae5Uch7ioqu');
define('LOGGED_IN_SALT',   'Yo4eethibo8Ezohma5to8maif8Ooz6yai2Thee6ohRechei1Eiyah0veegheevahb');
define('NONCE_SALT',       'Ei3xe3ahj1phocheeshokait2fae1lit3eiteiGoopheiyiemosiejigheHu0opoz');

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
$plugins = get_option( 'active_plugins' );
if ( count( $plugins ) === 0 ) {
  require_once(ABSPATH .'/wp-admin/includes/plugin.php');
  $wp_rewrite->set_permalink_structure( '/%postname%/' );
  $pluginsToActivate = array( 'nginx-helper/nginx-helper.php' );
  foreach ( $pluginsToActivate as $plugin ) {
    if ( !in_array( $plugin, $plugins ) ) {
      activate_plugin( '/usr/share/nginx/www/wp-content/plugins/' . $plugin );
    }
  }
}
