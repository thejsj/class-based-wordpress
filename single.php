<?php $view = new PostView(get_the_ID()); ?>
<?php get_header(); ?>

	<div class="row">
		<div class="small-12 columns">
			<h1><?php echo $view->post->post_title; ?></h1>
		</div>
	</div>

	<div class="row">
		<div class="small-4 columns entry-content">
			<?php echo $view->post->featured_image->url; ?>
		</div>
		<div class="small-8 columns entry-content">
			<?php echo $view->post->post_content; ?>
		</div>
	</div>

<?php get_footer(); ?>