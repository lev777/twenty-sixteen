<?php
/*
 * This is the child theme for Twenty Sixteen theme
 */

add_action( 'wp_enqueue_scripts', 'twenty_sixteen_enqueue_styles' );
function twenty_sixteen_enqueue_styles() {
    wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css' );
    wp_enqueue_style( 'child-style',  get_stylesheet_directory_uri() . '/style.css', array('parent-style') );
}

/*
 * Override autosuggest max 
 */

wp_register_script(
  'fep-script',
  get_stylesheet_directory_uri() . '/assets/js/script.js',
  array('jquery'),
  '1.0.0', 
  true  
);

/*
 * Override category dropdown text 
 */
function change_dropdown_text( $cat_args ) {
    $cat_args['show_option_none'] = 'Select Artist';
    return $cat_args;
}
add_filter( 'widget_categories_dropdown_args', 'change_dropdown_text' );