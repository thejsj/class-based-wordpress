<?php

	function camel2dashed($className) {
	    return strtolower(preg_replace('/([a-zA-Z])(?=[A-Z])/', '$1-', $className));
	}

	function theme_name_scripts() {
		wp_enqueue_script('jquery');
	}

	add_action( 'wp_enqueue_scripts', 'theme_name_scripts' );