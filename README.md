# TacoWordpress Boilerplate 2015
## By Vermilion

coming soon on how to use...

This project uses [tacowordpress](https://github.com/tacowordpress/tacowordpress).

### Requirements
*sass
*composer

###Setting up the repo locally in terminal:

##### run composer to get tacowordpress and other vendor requirements
*```cd``` into the ```/public``` directory
*run ```composer install```

##### setup localhost to point to ```html```

### Setting up WordPress locally:

* create an empty database
* update the ```/html/app/wp-app-config.php``` table_prefix and salts
* update the db.php (not committed through .git) with db creds
* go to your localhost url, setup to run the project
* edit ```RewriteRule ^ - [E=HTTP_WP_VERSION_FOLDER_NAME:wordpress-4.2.2]``` to reflect the version of WordPress the setup is using. Anytime WordPress gets upgraded change this too.
* run the wp install
* once logged into the dashboard, first activate the theme
* next, activate taco_app, then taco_theme_options

### Directory Structure
* assets
* composer.json
* sql
* vendor - added after composer install (not to be committed)
* README.md
* LICENSE
* html
  * wordpress-version-number-folder
  * app
    * app-environment.php
    * app-wp-config.php
    * wp-content
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
* FTP uploads

### More Documentation
* The theme is setup to have more documentation, seen when logged into WP, under ```/docs```
* The theme is setup with a Sample Page for general wysiwyg and content entry, seen when logged into WP, under ```/sample-page```
