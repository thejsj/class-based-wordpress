<?php 

	class PostView extends View {

		const NAME = 'PostView';

		public function __construct($post_id_or_object) {
			parent::__construct($post_id_or_object);
			$this->post = new Post($post_id_or_object);
		}

	}