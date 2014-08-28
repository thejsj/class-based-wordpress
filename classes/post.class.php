<?php 

	class Post extends Single {

		// Custom Meta Tags will get queried just by declaring them in this array
		// These can be set with ACF
		public $field_names = array();

		const CLASS_NAME = 'post';

		public function __construct($post_id_or_object) {
			parent::__construct($post_id_or_object);
		}

	}