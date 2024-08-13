<?php
$uri = explode('/', trim($_SERVER['REQUEST_URI'], '/'));
$username = array_pop($uri);
?>

<?php get_header(); ?>

<h1>
	Hello World
</h1>


<div>This is some stuff for <?php echo esc_html($username) ?></div>

<?php get_footer() ?>
