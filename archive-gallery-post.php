<?php $view = new GalleryPostArchiveView(); ?>
<?php get_header(); ?>

	<?php foreach($view->posts as $post): ?>
	<div class="row">
		<div class="small-12 columns">
			<h1><?php echo $post->post_title; ?></h1>
		</div>
	</div>

	<div class="row">
		<div class="small-10 columns entry-content">
			<ul class="clearing-thumbs" data-clearing>
			<?php foreach($post->images as $image): ?>
				<?php //echo json_encode($image); die(); ?>
	 			<li><a href='<?php echo $image->url; ?>'><img src='<?php echo $image->sizes->thumbnail; ?>'></a></li>
			<?php endforeach; ?>
			</ul>
		</div>
	</div>
	<?php endforeach; ?>

<?php get_footer(); ?>