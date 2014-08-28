<?php 

	class ImagePostArchiveView extends ArchiveView {

		const NAME = 'ImagePostArchiveView';

		public function __construct($post_id_or_object = false) {
			parent::__construct($post_id_or_object);
			if ($post_id_or_object) {
				$this->post = new Page($post_id_or_object);
			}			
			$this->posts = $this->get_posts('ImagePost');
		}

	}