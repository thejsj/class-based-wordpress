<?php 

	abstract class CustomPostType extends Post {

		const CLASS_NAME = 'custom-post-type';
		const NAME = 'Custom Post Type';

		protected $labels;
		protected $settings;

		public function __construct() {
			$this->labels = array(
				'name'               => sprintf('%ss', $this::NAME),
				'singular_name'      => sprintf('%s', $this::NAME),
				'menu_name'          => sprintf('%ss', $this::NAME),
				'name_admin_bar'     => sprintf('%s', $this::NAME),
				'add_new'            => sprintf('Add New %s', $this::NAME),
				'add_new_item'       => sprintf('Add New %s', $this::NAME),
				'new_item'           => sprintf('New %s', $this::NAME),
				'edit_item'          => sprintf('Edit %s', $this::NAME),
				'view_item'          => sprintf('View %s', $this::NAME),
				'all_items'          => sprintf('All %ss', $this::NAME),
				'search_items'       => sprintf('Search %ss', $this::NAME),
				'parent_item_colon'  => sprintf('Parent %ss:', $this::NAME),
				'not_found'          => sprintf('No %ss Found:', $this::NAME),
				'not_found_in_trash' => sprintf('No %ss found in Trash.', $this::NAME),
			);

			$this->settings = array(
				'public'             => true,
				'publicly_queryable' => true,
				'show_ui'            => true,
				'show_in_menu'       => true,
				'query_var'          => true,
				'rewrite'            => array( 'slug' => $this::CLASS_NAME ),
				'capability_type'    => 'post',
				'has_archive'        => true,
				'hierarchical'       => false,
				'menu_position'      => null,
				'supports'           => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'comments' )
			);
			parent::__construct();	
			$this->register_post_type();
		}

		private function register_post_type() {
			if (post_type_exists( $this::CLASS_NAME )) {
				$this->settings['labels'] = $this->labels;
				register_post_type( $this::CLASS_NAME , $this->settings );
			}
		}

	}