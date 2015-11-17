<?php include __DIR__.'/incl-head.php'; ?>
<!-- page-wrap used for sticky footer -->
<div class="page-wrap">
<?php include __DIR__.'/incl-breakpoint-labels.php'; ?>
  <header class="header" role="banner" id="header-main">
    <div class="logo">
      <?php
      echo (is_front_page())
        ? '<h1>Taco</h1>'
        : '<a href="'.get_bloginfo('url').'/">Taco - Home</a>';
      ?>
    </div>
    <nav class="main-menu" id="main-menu" role="navigation" aria-label="Main Menu">
    <?php
    wp_nav_menu(array(
      'theme_location' => 'menu_primary',
      'container' => false
    ));
    ?>
    </nav>
  </header>

  <main class="main" role="main" id="content">