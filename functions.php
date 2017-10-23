<?php
/**
 * Default functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package WordPress
 * @subpackage Default
 * @since 1.0
 */
define('THEME_URI', get_template_directory_uri());
add_theme_support('post-thumbnails');
add_theme_support( 'menus' );
add_theme_support( 'title-tag' );
add_theme_support( 'automatic-feed-links' );
add_theme_support( 'custom-header' );
add_theme_support( 'custom-background' );
add_theme_support( 'html5' );

// Option Page
if( function_exists('acf_add_options_page') ) {
    acf_add_options_page();
}
// Option Page

// Enqueue scripts and styles
function default_scripts()
{
    wp_enqueue_style('default-screen', 'https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css', array());
    wp_enqueue_style('default-screen1', 'https://cdnjs.cloudflare.com/ajax/libs/normalize/7.0.0/normalize.min.css', array());
    wp_enqueue_style('default-screen2', 'https://fonts.googleapis.com/css?family=Open+Sans:400,700|Vollkorn:400,700', array());
    wp_enqueue_style('default-screen3', THEME_URI . '/assets/css/style.css', array());
    wp_enqueue_style('default-screen4', THEME_URI . '/style.css', array());

    wp_enqueue_script('default-script', 'https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js', array('jquery'), false, true); 
    wp_enqueue_script('default-script1', 'https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js', array('jquery'), false, true);
    wp_enqueue_script('default-script2', 'https://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.3/modernizr.min.js', array('jquery'), false, true);
    wp_enqueue_script('default-script3', THEME_URI . '/assets/js/script.js', array('jquery'), false, true);   
}

add_action('wp_enqueue_scripts', 'default_scripts');
// Enqueue scripts and styles

// Pagination Setup
function custom_pagination() {
    global $wp_query;
    $big = 999999999;
    $pages = paginate_links( array(
            'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
            'format' => '?paged=%#%',
            'current' => max( 1, get_query_var('paged') ),
            'total' => $wp_query->max_num_pages,
            'prev_next' => false,
            'type'  => 'array',
            'prev_next'   => TRUE,
            'prev_text'    => __('<span aria-hidden="true">prev</span>'),
            'next_text'    => __('<span aria-hidden="true">next</span>'),
        ) );
        if( is_array( $pages ) ) {
            $paged = ( get_query_var('paged') == 0 ) ? 1 : get_query_var('paged');
            echo '<ul class="pagination mb-30">';
            foreach ( $pages as $page ) {
                if (strpos($page, 'current') !== false) {
                    echo "<li class='active'>$page</li>"; }
                 else {
                    echo "<li>$page</li>"; 
                 }
            }
           echo '</ul>';
        }
}
// Pagination Setup

// Menu Setup
function setup_menu() {
    register_nav_menus(array(
        'main_menu' => 'Home',
        'footer_menu' => 'Footer',
        'mobile_menu' => 'Mobile',
    ), '');
}
setup_menu();
// Menu Setup

// remove wp version in css and js
add_filter( 'style_loader_src', 'sdt_remove_ver_css_js', 9999 );
add_filter( 'script_loader_src', 'sdt_remove_ver_css_js', 9999 );
function sdt_remove_ver_css_js( $src ) {
    if ( strpos( $src, 'ver=' ) )
        $src = remove_query_arg( 'ver', $src );
    return $src;
}
// remove wp version
remove_action('wp_head', 'wp_generator');

/**
 * Disable the emoji's
 */
function disable_emojis() {
    remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
    remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
    remove_action( 'wp_print_styles', 'print_emoji_styles' );
    remove_action( 'admin_print_styles', 'print_emoji_styles' );    
    remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
    remove_filter( 'comment_text_rss', 'wp_staticize_emoji' );  
    remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );
    add_filter( 'tiny_mce_plugins', 'disable_emojis_tinymce' );
}
add_action( 'init', 'disable_emojis' );

/**
 * Filter function used to remove the tinymce emoji plugin.
 * 
 * @param    array  $plugins  
 * @return   array             Difference betwen the two arrays
 */
function disable_emojis_tinymce( $plugins ) {
    if ( is_array( $plugins ) ) {
        return array_diff( $plugins, array( 'wpemoji' ) );
    } else {
        return array();
    }
}

// Remove comment-reply.min.js from footer
function comments_clean_header_hook(){
    wp_deregister_script( 'comment-reply' ); 
}
add_action('init','comments_clean_header_hook');