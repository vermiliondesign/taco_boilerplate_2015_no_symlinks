<?php


/**
 * Register the CSS
 */
function app_get_css() {
  return array(
    'all'=>array(
      'main' => '_/css/main.css'
    )
  );
}


/**
 * Register the JS
 */
function app_get_js() {
  return array(
    'jquery'=>'_/lib/jquery/dist/jquery.min.js',
    'main'=>'_/js/app.js'
  );
}


/**
 * Register menus
 */
add_theme_support('menus');
define('MENU_PRIMARY', 'menu_primary');
function app_menus() {
  $locations = array(
    MENU_PRIMARY => __('Primary'),
  );
  register_nav_menus($locations);
}
add_action('init', 'app_menus');

/**
 * Add editor styles for Page Inserts
*/
//add_editor_style('style-wysiwyg.css');

/**
 * Add new thumbnail size
*/
// if ( function_exists( 'add_image_size' ) ) {
//   add_image_size( 'hero', 680, 450, true ); //(cropped)
// }


/**
 * Get an image
 * @param string $path
 * @param size string $size (size keys that you've passed to add_image_size)
 * @return string Relative URL
 */
function app_image_path($path, $size) {
  // Which image size was requested?
  global $_wp_additional_image_sizes;
  $image_size = $_wp_additional_image_sizes[$size];
  
  // Get the path info
  $pathinfo = pathinfo($path);
  $fname = $pathinfo['basename'];
  $fext = $pathinfo['extension'];
  $dir = $pathinfo['dirname'];
  $fdir = realpath(str_replace('//', '/', ABSPATH.$dir)).'/';
  
  // Filename without any size suffix or extension (e.g. without -144x200.jpg)
  $fname_prefix = preg_replace('/(-[\d]{1,}x[\d]{1,})?.'.$fext.'$/i', '', $fname);
  $out_fname = sprintf(
    '%s-%sx%s.%s',
    $fname_prefix,
    $image_size['width'],
    $image_size['height'],
    $fext
  );
  
  // See if the file that we're predicting exists
  // If so, we can avoid a call to the database
  $fpath = $fdir.$out_fname;
  if(file_exists($fpath)) {
    return sprintf(
      '%s/%s',
      $pathinfo['dirname'],
      $out_fname
    );
  }
  
  // Can't find the file? Figure out the correct path from the database
  global $wpdb;
  $guid = site_url().$dir.'/'.$fname_prefix.'.'.$fext;
  $sql = "
    select
      pm.meta_value
    from $wpdb->posts p
    inner join $wpdb->postmeta pm
      on p.ID = pm.post_id
    where p.guid = %s
    and pm.meta_key = '_wp_attachment_metadata'
    limit 1";
  $prepared = $wpdb->prepare($sql, $guid);
  $row = $wpdb->get_row($prepared);
  if(is_object($row)) {
    $meta = unserialize($row->meta_value);
    if(isset($meta['sizes'][$size]['file'])) {
      $meta_fname = $meta['sizes'][$size]['file'];
      return sprintf(
        '%s/%s',
        $pathinfo['dirname'],
        $meta_fname
      );
    }
  }
  
  // Still nothing? Just return the path given
  return $path;
}


/**
 * Get the asset path
 * @param string $relative_path
 * @return string
 */
function get_asset_path($relative_path) {
  $clean_relative_path = $relative_path;
  $clean_relative_path = preg_replace('/^[\/]{1,}/', '', $clean_relative_path);
  $clean_relative_path = preg_replace('/^_[\/]{1,}/', '', $clean_relative_path);
  return sprintf(
    '%s/_/%s%s',
    get_template_directory_uri(),
    $clean_relative_path,
    THEME_SUFFIX
  );
}


/**
 * Get an html string of all links to app icons
 * @return string
 */
function get_app_icons() {
  
  $app_dir = $_SERVER['DOCUMENT_ROOT'].'/app';

  $files = scandir($app_dir.'/wp-content/app-icons');
  $paths = [];
  foreach($files as $file)  {
    if(!preg_match('/\.png/', $file)) continue;
    preg_match('/(\d+x\d+)/', $file, $sizes);

    $file = '/app/wp-content/app-icons/'.$file;
    if(preg_match('/apple-icon|android/', $file)) {
      $paths[] = '<link rel="apple-touch-icon" sizes="'.$sizes[0].'" href="'.$file.'">';
      continue;
    }
    if(preg_match('/favicon/', $file) && !preg_match('/(\d+)/', $file)) {
      $paths[] = '<link rel="icon" type="image/ico" sizes="'.$sizes[0].'" href="'.$file.'">';
      continue;
    }
  }
  $paths[] = '<link rel="icon" href="/app/wp-content/app-icons/favicon.ico">';
  return join('', $paths);
}

// admin lockdown
add_action('init', function() {
  if(!is_admin()) return;
  if(wp_get_current_user()->data->user_login === USER_SUPER_ADMIN) return;
  $array_of_regex_restricted_admin_pages = array(
    '/plugins\.php/',
    '/edit-comments\.php/',
    '/tools.php/',
    '/options-general\.php/',
    '/themes\.php/',
    '/users\.php/'
  );
  foreach($array_of_regex_restricted_admin_pages as $p) {
    if(preg_match($p, $_SERVER['SCRIPT_NAME'])) {
      header('Location: /wp-admin/');
    }
  }
});

// get rid of admin pages we don't need for non admin users
add_action('admin_menu', 'remove_non_vermilion_admin_menu_items', 999);
function remove_non_vermilion_admin_menu_items() {
 if(wp_get_current_user()->data->user_login != USER_SUPER_ADMIN) {
   remove_menu_page('plugins.php');
   remove_menu_page('edit-comments.php');
   remove_menu_page('tools.php');
   remove_menu_page('options-general.php');
   remove_menu_page('themes.php');
   remove_menu_page('users.php');
   remove_action('admin_notices', 'update_nag', 3);
 }
}
// Because we removed appearance and its sub menus, we need to re-enable menus here
add_action('admin_menu', 'add_non_vermilion_admin_menu_items', 999);
function add_non_vermilion_admin_menu_items() {
  if(wp_get_current_user()->data->user_login != USER_SUPER_ADMIN) {
   add_menu_page( 'Menus', 'Menus', 'manage_options', 'nav-menus.php', '', null, 6);
  }
}

// add admin.css for various things
add_action('admin_enqueue_scripts', function() {
  wp_enqueue_style(
    'custom-admin-styles',
    get_template_directory_uri() . '/_/css/admin.css'
  );
});
