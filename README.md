# TacoWordpress Boilerplate 2015
## By Vermilion

coming soon on how to use...

This project uses [tacowordpress](https://github.com/tacowordpress/tacowordpress).

### Requirements
*sass
*composer

###Setting up the repo locally in terminal:

* First Make a copy of app-template.php and rename it app.php. Here you can set you db info, table prefix and salts.

##### run composer to get tacowordpress and other vendor requirements
*```cd``` into the ```/html``` directory
*run ```composer install```

##### setup localhost to point to ```html```

### Setting up WordPress locally:

* create an empty database
* update the ```/app.php``` table_prefix and salts
* update the app.php (not committed through .git) with db creds
* edit ```RewriteRule ^ - [E=HTTP_WP_VERSION_FOLDER_NAME:wordpress-x.x.x]``` to reflect the version of WordPress the setup is using. Anytime WordPress gets upgraded, change this too.
* IMPORTANT: go here for the WordPress install [yoursite.com]/wp-admin/install.php
  * If you don't, you will see the WordPress version folder in the path and it will mess up your install.
* run the wp install
* once logged into the dashboard, activate the theme

### Directory Structure
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

### Deploying the website:

* deploy files under version control
* FTP or setup composer on production server to get the /vendor directory deployed
  * [See this link for an example](https://forum.mediatemple.net/topic/6927-here-is-how-to-install-and-use-composer/)
* FTP uploads

### Upgrading WordPress
* Download, unzip, and rename "wordpress" to "wordpress-x.x.x"
* Move the new wordpress folder to where the current version resides
* Delete the "wp-content" folder in the new version of WordPress
* Create a new wp-config.php in html/[new-wordpress-x.x.x]
* Copy the contents out of html/[current-wordpress-x.x.x]/wp-config.php and paste it in the new version's wp-config.php
* Open ".htaccess" in the "html" folder and change the version number [E=HTTP_WP_VERSION_FOLDER_NAME:wordpress-x.x.x] in the rewrite


### More Documentation
* The theme is setup to have more documentation, seen when logged into WP, under ```/docs```
* The theme is setup with a Sample Page for general wysiwyg and content entry, seen when logged into WP, under ```/sample-page```
