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

function change_dropdown_text( $cat_args ) {
    $cat_args['show_option_none'] = 'Select Artist';
    return $cat_args;
}
add_filter( 'widget_categories_dropdown_args', 'change_dropdown_text' );

function customize_recent_comments_widget($args) {
    $args['callback'] = 'custom_recent_comments_output';
    return $args;
}
add_filter('widget_comments_args', 'customize_recent_comments_widget');

function custom_recent_comments_output($comment, $args, $depth) {
    $GLOBALS['comment'] = $comment;
    ?>
    <li id="comment-<?php comment_ID(); ?>">
        <div class="comment-content"><?php comment_text(); ?></div>
    </li>
    <?php
}

add_filter( 'post_thumbnail_html', 'my_post_image_html', 10 );
function my_post_image_html( $html ) {
  if ( is_front_page() ) {
    $html = str_replace( 'full', 'medium', $html );
  }
  return $html;
}
