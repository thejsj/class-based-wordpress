<?php 

	class ImagePostView extends View {

		const NAME = 'ImagePostView';

		public function __construct($post_id_or_object) {
			parent::__construct($post_id_or_object);
			$this->post = new ImagePost($post_id_or_object);
		}

	}