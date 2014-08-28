<?php 

	abstract class ArchiveView extends View {

		const NAME = 'ArchiveView';

		public function __construct($post_id_or_object = false) {
			parent::__construct($post_id_or_object);
		}

	}