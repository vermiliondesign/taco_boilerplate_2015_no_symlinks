<?php
// NOTE: Copy this file and make it app.php

define('ENVIRONMENT_DEV', 'dev');
define('ENVIRONMENT_STAGING', 'staging');
define('ENVIRONMENT_PROD', 'prod');

// NOTE: "HTTP_APP_ENVIRONMENT" is defined in .htaccess
if($_SERVER['HTTP_APP_ENVIRONMENT'] == 'dev') {
  define('ENVIRONMENT', ENVIRONMENT_DEV);
}
if($_SERVER['HTTP_APP_ENVIRONMENT'] == 'staging') {
  define('ENVIRONMENT', ENVIRONMENT_STAGING);
}
if($_SERVER['HTTP_APP_ENVIRONMENT'] == 'prod') {
  define('ENVIRONMENT', ENVIRONMENT_PROD);
}

require_once __DIR__.'/html/app/app-environment.php';
switch(ENVIRONMENT) {
  case ENVIRONMENT_DEV:
    define('DB_USER',     '');
    define('DB_PASSWORD', '');
    define('DB_HOST',     '');
    define('DB_NAME',     '');
    define('SAVEQUERIES', true);
    break;
  case ENVIRONMENT_STAGING:
    define('DB_USER',     '');
    define('DB_PASSWORD', '');
    define('DB_HOST',     '');
    define('DB_NAME',     '');
    define('SAVEQUERIES', true);
    break;
  default:
    define('DB_USER',     '');
    define('DB_PASSWORD', '');
    define('DB_HOST',     '');
    define('DB_NAME',     '');
    break;
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

define('AUTH_KEY',         '');
define('SECURE_AUTH_KEY',  '');
define('LOGGED_IN_KEY',    '');
define('NONCE_KEY',        '');
define('AUTH_SALT',        '');
define('SECURE_AUTH_SALT', '');
define('LOGGED_IN_SALT',   '');
define('NONCE_SALT',       '');
/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = '';