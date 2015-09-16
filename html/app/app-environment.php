<?php

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