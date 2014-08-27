<?php

    class Image {

        private $all_sizes;

        public function __construct( $post_id, $attachment_id = false, $image_size = false ){

            global $_wp_additional_image_sizes; 
            $this->all_sizes = get_intermediate_image_sizes();

            if($post_id !== false){
                $this->post_id = $post_id;
                $this->attachment_id = get_post_thumbnail_id($this->post_id);
                if( !isset($this->attachment_id) || empty($this->attachment_id) || $this->attachment_id === "" ){
                    $this->exists = false; 
                }
                else {
                    $this->exists = true; 
                }
            }
            else {
                $this->attachment_id = $attachment_id;
            }

            // Populate Image Size
            $this->image_size = $image_size;

            // Get Metadata
            $this->metadata = $this->get_metadata();

            // Get Sizes
            $this->sizes = $this->get_all_sizes(); 

            // Get Image URL
            $this->url = $this->get_url( (isset($this->image_size)) ? $this->image_size : 'large' );
        }

        /**
         * Get Main Image Url
         *
         * @return string
         */
        public function get_url( $size = false){
            if( !isset( $size ) || $size === false ){
                $size = 'large';
            }
            $url = wp_get_attachment_image_src(
                $this->attachment_id,
                $size
            );
            return $url[0];
        }

        /**
         * Get all image sizes and all urls
         *
         * @return array
         */ 
        public function get_all_sizes(){
            $sizes = (object) array(); 
            foreach( $this->all_sizes as $image_size ){
                $sizes->{$image_size} = $this->get_url($image_size);
            }
            return $sizes; 
        }

        /** 
         * Get Image Metadata
         *
         * @return object
         */
        public function get_metadata(){
            return (object) wp_prepare_attachment_for_js( $this->attachment_id ); 
        }
    }