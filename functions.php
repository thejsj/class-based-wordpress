<?php

/* Funcitons
---------------------------------------------------------------------- */
require_once(trailingslashit( get_stylesheet_directory()) . 'includes/utilities.php');
require_once(trailingslashit( get_stylesheet_directory()) . 'includes/class-loader.php');

register_nav_menus( array(
	'primary' => 'Primary Menu',
));