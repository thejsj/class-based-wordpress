<?php 

	class Book extends CustomPostType {

		const CLASS_NAME = 'book';
		const NAME = 'Book';

		public function __construct($post_id_or_object = false) {
			parent::__construct($post_id_or_object);	
		}

	}

	Book::register_post_type(new Book());