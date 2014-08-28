<?php $view = new ImagePostArchiveView(); ?>
<?php get_header(); ?>

	<?php foreach($view->posts as $post): ?>
	<div class="row">
		<div class="small-12 columns">
			<h1><?php echo $post->post_title; ?></h1>
		</div>
	</div>

	<div class="row">
		<div class="small-4 columns entry-content">
			<img src='<?php echo $post->image->url; ?>' />
		</div>
		<div class="small-8 columns entry-content">
			<?php echo $post->post_content; ?>
		</div>
	</div>
	<?php endforeach; ?>

<?php get_footer(); ?>