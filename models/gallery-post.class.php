<?php 

	class GalleryPost extends CustomPostType {

		const CLASS_NAME = 'gallery-post';
		const NAME = 'Gallery Post';

		public $field_names = ['images'];

		public function __construct($post_id_or_object = false) {
			$this->settings['supports'] = array( 'title', 'author' );
			parent::__construct($post_id_or_object);	

			if ($post_id_or_object) {
				$this->images = array();
				foreach($this->fields['images'] as $id) {
					$this->images[] = new Image(false, $id['single-image']);
				}
			}

		}
	}