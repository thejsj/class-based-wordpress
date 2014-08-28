<?php 

global $mustache;

// Load Mustache PHP
/*
 * Documentation:
 *
 * https://github.com/bobthecow/mustache.php/wiki
 * https://github.com/bobthecow/mustache.php/wiki/Mustache-Tags
 */
require dirname(dirname(__FILE__)) . '/Mustache/Autoloader.php';

Mustache_Autoloader::register();

$mustache = new Mustache_Engine(array(
	'cache' => dirname(dirname(__FILE__)).'/mustache_cache',
	'cache_file_mode' => 0666, // Please, configure your umask instead of doing this :)
	'cache_lambda_templates' => true,
	'loader' => new Mustache_Loader_FilesystemLoader(dirname(dirname(__FILE__)).'/templates'),
	'partials_loader' => new Mustache_Loader_FilesystemLoader(dirname(dirname(__FILE__)).'/templates/partials'),
));

?>