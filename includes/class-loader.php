<?php

	function __autoload($class_name) {
		if (!class_exists($class_name)) {
			$class_filename = trailingslashit( get_stylesheet_directory()) . 'models/'. camel2dashed($class_name) . '.class.php';
			$view_filename = trailingslashit( get_stylesheet_directory()) . 'views/'. camel2dashed($class_name) . '.class.php';
			if (file_exists($class_filename)) {
				include_once($class_filename);
			} else if (file_exists($view_filename)) {
				include_once($view_filename);
			}
		}	    
	}

	// Register Post Type
	$class = new ImagePost();
	$class->register_post_type();

	// Register Post Type
	$class = new GalleryPost();
	$class->register_post_type();