<?php
$page = \Taco\Post\Factory::create($post);
get_header();
?>
<h2><?php echo $page->getTheTitle(); ?></h2>
<?php echo $page->getTheContent(); ?>
<?php get_footer(); ?>