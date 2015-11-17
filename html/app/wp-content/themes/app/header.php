<!doctype html>
<?php
$theme = ThemeOption::getInstance();
?>
<html class="no-js" <?php language_attributes(); ?>>
<head>
  <meta charset="<?php bloginfo('charset'); ?>">
  <title><?php echo app_get_page_title(); ?></title>
  <?php include dirname(__FILE__).'/incl-open-graph-meta.php'; ?>
  <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <meta name="viewport" content="width=device-width">
  <?php echo get_app_icons(); ?>
  <script src="<?php echo get_asset_path('lib/modernizr/modernizr.js'); ?>"></script>
  <?php wp_head(); ?>
</head>
<?php global $body_class; ?>
<body <?php body_class((isset($body_class)) ? $body_class : null); ?>>
<?php include __DIR__.'/incl-google-tag-manager.php'; ?>
<!-- page-wrap used for sticky footer -->
<div class="page-wrap">
  <header class="header" role="banner" id="header-main">
    <div class="logo">
      <?php
      echo (is_front_page())
        ? '<h1>Taco</h1>'
        : '<a href="'.get_bloginfo('url').'/">Taco - Home</a>';
      ?>
    </div>
    <nav class="main-menu" id="main-menu" role="navigation" aria-label="Main Menu">
      <?php wp_nav_menu( array( 'theme_location' => 'menu_primary' ) ); ?>
    </nav>
  </header>

  <main class="main" role="main" id="content">