<?php 

	class GalleryPostView extends View {

		const NAME = 'GalleryPostview';

		public function __construct($post_id_or_object) {
			parent::__construct($post_id_or_object);
			$this->post = new GalleryPost($post_id_or_object);
		}

	}