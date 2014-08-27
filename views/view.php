<?php 

    /**
     * Use Views for templates that use multiple classes or require extra data processing, cleaning, etc. 
     * A View should be tied to a template and should be used to output HTML.
     * If you don't need to used a view (and a class is enough), don't use it and stick to the view.
     *
     * Example: Blog View (uses a Post class), Stuff View (uses a Stuff Single class)
     */
    abstract class View extends Content {

        public function __construct($post_id_or_object) {
            $this->images_directory = get_bloginfo('stylesheet_directory') . "/dist/img/sections/" . $this::NAME;
            $this->template_directory = get_bloginfo('template_directory'); 
            add_action('wp_enqueue_scripts', array(&$this, 'append_view_styles') );
            add_action('wp_enqueue_scripts', array(&$this, 'append_view_scripts') );
            add_action('wp_enqueue_scripts', array(&$this, 'append_localized_scripts') );
        }

        public function get_tags( $post_types = array('post') ){
            global $wp_query;
            $_tags = get_tags();
            $tags  = array(); 
            foreach( $_tags as $tag ){
                $args = array(
                    'post_type' => $post_types,
                    'posts_per_page' => -1,
                    'tag_id' => $tag->term_id,
                );
                $the_query = new WP_Query( $args );
                wp_reset_query(); 
                if( sizeof($the_query->posts) > 0 ){
                    $tag->permalink = get_term_link( $tag );
                    array_push( $tags, $tag );
                }
            }
            return $tags; 
        }

        public function get_taxonomy_terms( $taxonomies = array( 'type' ) ){
            $args = array(
                'orderby'       => 'name', 
                'order'         => 'ASC',
                'hide_empty'    => true, 
            );
            $taxonomy_terms = array();
            foreach( get_terms( $taxonomies, $args ) as $type ){
                $type->permalink = get_term_link( $type );
                array_push( $taxonomy_terms, $type );
            }
            return $taxonomy_terms;
        }

        public function append_view_scripts(){
            if (!is_admin()) {
                wp_enqueue_script($this::NAME, get_bloginfo('template_directory').'/dist/js/'.$this::NAME.'-app.js', array(), false, true);
            }
        }

        /**
         * Append scripts to WordPress
         *
         * @return null
         */
        public function append_localized_scripts(){
            if (!is_admin()) {
                wp_localize_script( $this::NAME, 'ViewOptions', array( 
                    'ajaxurl'            => admin_url( 'admin-ajax.php' ),
                    'WP_SITEURL'         => WP_HOME,
                    'view'               => $this,
                    'theme_directory'    => get_bloginfo('template_directory'),
                    'template_directory' => get_bloginfo('template_directory'),
                ));
            }
        }

        public function append_view_styles() {
            $random = rand();
            global $is_IE;

            if (!is_admin()) {
                wp_register_style($this::NAME.'-styles', get_bloginfo('stylesheet_directory').'/dist/css/sections/'.$this::NAME.'/section.css', false, $random);
                wp_register_style($this::NAME.'_ie8_below', get_bloginfo('stylesheet_directory').'/dist/css/sections/'.$this::NAME.'/section_nomq.css', false, $random);
                wp_register_style($this::NAME.'_ie9_up', get_bloginfo('stylesheet_directory').'/dist/css/sections/'.$this::NAME.'/section.css', false, $random);
                // 'ie9_up' This is tied to neg_conditional function located in global-functions.php

                wp_style_add_data($this::NAME.'_ie8_below', 'conditional', '(lt IE 9) & (!IEMobile)');
                wp_style_add_data($this::NAME.'_ie9_up', 'conditional', '(gt IE 8) | (IEMobile)');
                if($is_IE) {
                    wp_enqueue_style($this::NAME.'_ie8_below');
                    wp_enqueue_style($this::NAME.'_ie9_up');
                } else {
                    wp_enqueue_style($this::NAME.'-styles');
                }
            }
        }

    }

?>