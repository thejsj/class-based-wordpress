<!DOCTYPE html><?php global $view; ?>
<html>
<head>

<!-- Meta Information -->
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <?php echo(is_search()) ? '<meta name="robots" content="noindex, nofollow" />' : ''; ?>
    <title><?php echo $view->post->html_title; ?></title>
    
    <!-- HTML Meta Tags -->
    <meta name="title" content="<?php wp_title( '|', true, 'right' ); ?>">
    <meta name="author" content="Jorge Silva-jetter, jorge.silva@thejsj.com">
    <meta name="copyright" content="<?php echo ' Copyright' . bloginfo('name') . '. All Rights Reserved.';?>">
    <!-- <meta name="google-site-verification" content=""/> -->
    <meta name="viewport" id="viewport" content="width=device-width,minimum-scale=1.0,maximum-scale=10.0,initial-scale=1.0" />
    <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />

    <link href="<?php echo $view->template_directory; ?>/css/_normalize.css" rel="stylesheet" type="text/css" />
  	<link href="<?php echo $view->template_directory; ?>/css/app.css" media="screen, projector, print" rel="stylesheet" type="text/css" />
  	<script src="<?php echo $view->template_directory; ?>/js/vendor/custom.modernizr.js"></script>
    <!-- WP Head -->
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>> 
   <!-- Header and Nav -->
    <header class="top-header">
    	<nav class="top-bar" data-topbar role="navigation">
			<ul class="title-area">
				<!-- Remove the class "menu-icon" to get rid of menu icon. Take out "Menu" to just have icon alone -->
				<li class="toggle-topbar menu-icon"><a href="#"><span>Menu</span></a></li>
			</ul>

			<section class="top-bar-section">
				<!-- Right Nav Section -->
				<ul class="right">
					<li class="has-dropdown">
						<a href="#">Custom Post Types</a>
						<ul class="dropdown">
							<li><a href="?post_type=image-post">Image Post Archive</a></li>
							<li><a href="?post_type=gallery-post">Gallery Post Archive</a></li>
						</ul>
					</li>
				</ul>

				<!-- Left Nav Section -->
				<ul class="left">
					<li><a href="<?php echo $view->site_url; ?>">Home</a></li>
				</ul>
			</section>
		</nav>
    </header>
