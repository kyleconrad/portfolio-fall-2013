<?php
// GET CORRECT JQUERY
if( !is_admin() ){
  wp_deregister_script('jquery');
  wp_register_script('jquery', ("//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"), false, '');
  wp_enqueue_script('jquery');
}


// IMPROVED EXCERPTS
function improved_trim_excerpt($text) {
  global $post;
  if ( '' == $text ) {
    $text = get_the_content('');
    $text = apply_filters('the_content', $text);
    $text = str_replace('\]\]\>', ']]&gt;', $text);
$text = strip_tags($text, '<p>');
    $excerpt_length = 55;
    $words = explode(' ', $text, $excerpt_length + 1);
    if (count($words)> $excerpt_length) {
      array_pop($words);
      array_push($words, '[...]');
      $text = implode(' ', $words);
    }
  }
return $text;
}
remove_filter('get_the_excerpt', 'wp_trim_excerpt');
add_filter('get_the_excerpt', 'improved_trim_excerpt');

function replace_ellipsis($text) {
	$return = str_replace('[...]', '', $text);
	return $return;
}
add_filter('get_the_excerpt', 'replace_ellipsis');


// GETTING THE SLUG
function the_slug() {
	$post_data = get_post($post->ID, ARRAY_A);
	$slug = $post_data['post_name'];
	return $slug;
}


// THUMBNAIL SIZES
if ( function_exists( 'add_image_size' ) ) add_theme_support( 'post-thumbnails' );
if ( function_exists( 'add_image_size' ) ) {
	set_post_thumbnail_size( 300, 300 );
	add_image_size( 'social-thumb', 400, 400 );
	add_image_size( 'banner-image', 1000, 1000 );
  add_image_size( 'front-banner', 1000, 350, true );
}


// EDITING TINYMCE
function make_mce_awesome( $init ) {
	$init['theme_advanced_blockformats'] = 'p';
	$init['theme_advanced_disable'] = 'underline,spellchecker,wp_help';
    return $init;
}

add_filter('tiny_mce_before_init', 'make_mce_awesome');


// ADD HR
function enable_more_buttons($buttons) {
  $buttons[] = 'hr';
  return $buttons;
}
add_filter("mce_buttons", "enable_more_buttons");


// REMOVE INLINE HEIGHT AND WIDTH
function remove_thumbnail_dimensions( $html ) {
	$html = preg_replace( '/(width|height)=\"\d*\"\s/', "", $html );
	return $html;
}

add_filter( 'post_thumbnail_html', 'remove_thumbnail_dimensions', 10 );
add_filter( 'image_send_to_editor', 'remove_thumbnail_dimensions', 10 );


// ADD LAZY LOAD TO IMAGES
function add_lazyload($content) {
     $dom = new DOMDocument();
     @$dom->loadHTML($content);

     foreach ($dom->getElementsByTagName('img') as $node) {
         $oldsrc = $node->getAttribute('src');
         $node->setAttribute("data-original", $oldsrc );
         $newsrc = ''.get_template_directory_uri().'/IMG/gray.gif';
         $node->setAttribute("src", $newsrc);
     }
     $newHtml = $dom->saveHtml();
     return $newHtml;
}

add_filter('the_content', 'add_lazyload');

?>