<?php 

	class ExampleView extends View {

		const NAME = 'ExampleView';

		public function __construct($post_id_or_object) {
			parent::__construct($post_id_or_object);
			$this->post = new Page($post_id_or_object);
		}

	}