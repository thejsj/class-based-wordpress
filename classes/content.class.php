<?php

    /**
     * Use Class should be used to extend and enhance the default WordPress content types.
     * Classes should be used to query and manipulate data. HTML outputting should be left to Views.
     * Some Views are simple enough to be kept in a class. (See no misspellings!)
     *
     * Example: Blog View (uses a Post class), Stuff View (uses a Stuff Single class)
     */
    abstract class Content {

        public function __construct($post_id_or_object){

        }

        /**
         * Parse and filter the relational permalink
         *
         * @return string
         */
        public function get_relational_permalink( $permalink ){
            $relational_permalink = str_replace( get_bloginfo('url'), '', $permalink );
            if( $relational_permalink[0] == "/") {
                $relational_permalink = substr($relational_permalink, 1);
            }
            return $relational_permalink;
        }
    }