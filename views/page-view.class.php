<?php 

	class PageView extends View {

		const NAME = 'PageView';

		public function __construct($post_id_or_object) {
			parent::__construct($post_id_or_object);
			$this->post = new Page($post_id_or_object);
		}

	}