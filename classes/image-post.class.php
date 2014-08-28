<?php 

	class ImagePost extends CustomPostType {

		const CLASS_NAME = 'image-post';
		const NAME = 'Image Post';

		public $field_names = ['main_image'];

		public function __construct($post_id_or_object = false) {
			$this->settings['supports'] = array( 'title', 'author' );
			parent::__construct($post_id_or_object);

			if ($post_id_or_object) {
				$this->image = new Image(false, $this->fields['main_image']);
			}			
		}
	}