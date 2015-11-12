# TacoWordPress Boilerplate 2015
## By Vermilion

This project uses [tacowordpress](https://github.com/tacowordpress/tacowordpress).


### Requirements
- Sass
- Composer


### Getting started
1. Download a fresh copy of this repository
2. Rename `app-template.php` to `app.php`
3. In `app.php`:
  * Set $table_prefix
  * Add salts
  * Add DB credentials
*Note: `app.php` is in `.gitignore`, and should not be added to source control.*

### Installing dependencies through Composer
1. `cd` into the `html` directory
2. Run `composer install`

*Note: The `vendor` directory is in `.gitignore`, and should not be added to source control.*


### Setting up the WordPress directory structure locally
1. [Download](https://wordpress.org/download/) a fresh copy of WordPress
2. Append the WordPress version number to the `wordpress` directory name, as `wordpress-x.x.x`
3. In the `wordpress-x.x.x` directory, delete `wp-content` and `wp-config-sample.php`
4. Move the `wordpress-x.x.x` directory into `html`
5. Move `html/wp-config.php` into the `wordpress-x.x.x` directory, or copy it from a previous version
6. In `html/.htaccess`, update the version number in `RewriteRule ^ - [E=HTTP_WP_VERSION_FOLDER_NAME:wordpress-x.x.x]` to reflect the version of WordPress this setup is using

The entire contents of `wp-config.php` should always be:

```php
<?php
define('WP_CONTENT_DIR', ABSPATH . '/../app/wp-content');
require_once __DIR__.'/../app/app-wp-config.php';
```


### Installing WordPress locally
1. Set up your localhost to point to `html`
2. Create an empty database
3. Install WordPress by visiting this URL: `[yoursite.com]/wp-admin/install.php`
4. Go through the WordPress installation process
5. Log into the WordPress admin
6. Activate the "App" theme

*Note: when running the WordPress installation, do not use the standard install path. If you see the WordPress version number in the path, something went wrong. Use the URL specified above.*


### Deploying the website
- Deploy files under version control
- [Set up Composer on production server](#setting-up-composer-on-production) to deploy `vendor` directory, or use FTP (not recommended)
- FTP `uploads`
- FTP `app.php`


### Upgrading WordPress
Follow the instructions under [Setting up the WordPress directory structure locally](#setting-up-the-wordpress-directory-structure-locally), leaving the previous version of WordPress intact.


### Directory structure
* assets
* composer.json
* sql
* vendor - added after composer install (not to be committed)
* README.md
* LICENSE
* app-template.php > should become app.php
* html
  * wordpress-x.x.x (folder)
  * wp-config.php (Make sure to move this into [wordpress-x.x.x])
  * app
    * app-wp-config.php
    * wp-content
      * uploads (ignored in git)
      * app-icons
      * plugins
      * taco-app
        * _
        * lib
        * posts
          * example: Post.php
          * ThemeOptionBase.php (should be here by default)
          * ThemeOption.php (should be here by default)
        * taco-app.php
        * terms
        * traits
      * themes
        * app
          * _
            * css
            * js
              * app.js (requirejs loads files from the modules folder asynchronously)
              * modules
                * example: module-accordion.js
                * example: module-slider.js
            * lib
              * requirejs
                * requirejs.js
            * scss
        * all other theme files


### Setting up Composer on production
These instructions are for Media Temple. This assumes you've chosen *not* to include Composer's vendor directory in your Git repo, and will be installing dependencies manually on the production site, hosted through Media Temple.

1. SSH into the server
2. Change your directory to home: `cd ~`
3. Install Composer: `curl -s https://getcomposer.org/installer | php -d allow_url_fopen=1 -d suhosin.executor.include.whitelist=phar`
4. Check if `.profile` exists: `ls -al`
3. If `.profile` does not exist, create it: `touch .profile`
4. Get the path of where PHP is installed: `which php` (should output something like `/usr/bin/php`)
* Create a new wp-config.php in html/[new-wordpress-x.x.x]
5. Get the path of where Composer is installed: `pwd` (should contain `composer.phar` in the path, such as `/home/206841/users/.home/composer.phar`)
6. Open a text editor such as vim or nano to edit the file: `vim .profile` or `nano .profile`
7. Create an alias, using the appropriate PHP and Composer paths: `alias composer="[PHP path] -d memory_limit=512M -d allow_url_fopen=1 -d suhosin.executor.include.whitelist=phar [Composer path]"`
8. Save the file
9. Reload the file into memory: `source .profile`
10. Test that your alias to `composer.phar` works: `composer`


### More documentation
- The theme is setup to have more documentation, seen when logged into WordPress, under `/docs`
- The theme is setup with a sample page for general wysiwyg and content entry, seen when logged into WordPress, under `/sample-page`
