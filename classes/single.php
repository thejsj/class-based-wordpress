<?php 

    abstract class Single extends Content {

        const CLASS_NAME = 'single';

        public $default_fields_names = array();

        public function __construct( $post_id_or_object = false, $get_post_content = true, $field_names = false) {

            // Extend Object
            if ($post_id_or_object) {
                $post = get_post($post_id_or_object);
                if ($post) {
                    $vars = get_object_vars($post);
                    foreach ($vars as $var => $value) {
                        $this->$var = $value;
                    }

                    // Get Fields
                    $this->field_names = (isset($this->field_names) ? $this->field_names : array());
                    $this->field_names = ($field_names ? array_merge($this->field_names, $field_names) : $this->field_names);
                    $this->field_names = array_merge($this->field_names, $this->default_fields_names);

                    if( isset( $this->field_names ) ){
                        $this->fields = $this->get_fields( $this->field_names );
                    }

                    // Apply Filters
                    $this->post_content_unfiltered = $this->post_content; 
                    if($get_post_content){
                       $this->post_content         = apply_filters('the_content', $this->post_content); 
                    }
                    $this->post_excerpt            = $this->get_excpert($this->post_excerpt, $this->post_content);
                    $this->post_short_excerpt      = $this->get_short_excpert($this->post_excerpt);
                    $this->template                = $this->get_template_name($this); 

                    // Get HTML Title
                    $this->html_title              = $this->get_wp_title($this->post_title);

                    // Add Permalink
                    $this->permalink = get_permalink( $this->ID );
                    $this->relational_permalink = $this->get_relational_permalink( $this->permalink );

                    // Get Featured Image
                    $this->featured_image = new Image( $this->ID, false, (isset($this->image_size)) ? $this->image_size : false);

                    // Get adjacent posts
                    $this->adjacent = $this->get_adjacent_links($this);

                    // Get Category 
                    $this->category = get_the_category( $this->ID );
                }
            }
        }

        /**
         * Get ACF fields for stuff singles
         *
         * @return array
         */
        public function get_fields( $field_names ){
            $fields = array(); 
            foreach($field_names as $field_name){
                $fields[$field_name] = get_field($field_name, $this->ID);
            }
            return $fields;
        }

        /** 
         * Trim excerpt
         *  
         *  @param string
         *  @return string
         */
        public function get_excpert( $post_excerpt, $post_content ){
            if( $post_excerpt && $post_excerpt !== "" ){
                return $post_excerpt;
            }
            $post_excerpt = ($post_excerpt ? $post_excerpt : wp_trim_words($post_content));
            return strip_shortcodes( wp_strip_all_tags( $post_excerpt ) );
        }

        /**
         * Get a short 15 word excerpt
         *
         * @return <string>
         */
        public function get_short_excpert( $post_excerpt, $length = 15 ){
            return wp_trim_words( $post_excerpt, $length );
        }

        /**
         * Get page template in a string
         *
         * @return string
         */
        private function get_template_name($queried_post) {
            global $post;
            $_query_post = $post; 
            $post = $queried_post;

            // Get Template Name
            $template_name = false;
            if ($queried_post !== false && $post->post_type === 'page') {
                // Notice:  Undefined property: stdClass::$post_name in wp-includes/template.php on line 317
                $template_name = @basename( get_page_template() ); 
            }

            $post = $_query_post; 
            return $template_name;
        }

        /**
         * Get next and previous posts
         *
         * @param <$post>
         * @return <object>
         */ 
        public function get_adjacent_links($queried_post, $previous_post = false, $next_post = false){

            global $post;
            $_query_post = $post; 
            $post = $queried_post;   

            /**
             * When in PHP mode, show the next and previous post link, inside 
             */
            $adjacent_posts         = new stdClass();

            $previous_post          = (!$previous_post) ? (($previous_post === false ) ? false : get_previous_post() ) : $previous_post;
            $next_post              = (!$next_post) ? (($next_post === false ) ? false : get_next_post() ) : $next_post;

            $previous_post_template = $this->get_template_name($previous_post);
            $next_post_template     = $this->get_template_name($next_post);

            $adjacent_posts->prev   = ($previous_post && $this->template === $previous_post_template) ? get_permalink( $previous_post->ID ) : false;
            $adjacent_posts->next   = ($next_post && $this->template === $next_post_template) ? get_permalink( $next_post->ID ) : false;

            $post = $_query_post; 
            return $adjacent_posts;
        }

        /**
         * Using WP's wp_title, generate the HTML title for this single
         *
         * @return <string>
         */
        private function get_wp_title($post_title) {
            $title_segments = preg_split("/[|]/", wp_title('|', false, 'right'));
            if (count($title_segments) > 1) {
                return $post_title . " | " . $title_segments[1];
            } else {
                return $post_title . " | " . $title_segments[0];
            }
        }
    }