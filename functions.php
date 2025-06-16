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
add_theme_support('menus');
add_theme_support('title-tag');
add_theme_support('automatic-feed-links');
add_theme_support('custom-header');
add_theme_support('custom-background');
add_theme_support('html5');

// Option Page
if (function_exists('acf_add_options_page')) {
  acf_add_options_page();
}
// Option Page

// Enqueue scripts and styles
function defaultScripts()
{
  wp_enqueue_style('default-screen', 'https://fonts.googleapis.com/css2?family=Lato:ital,wght@0,100;0,300;0,400;0,700;0,900;1,100;1,300;1,400;1,700;1,900&family=Roboto:wght@400;500;700&display=swap', array());
  wp_enqueue_style('default-screen1', THEME_URI . '/assets/css/style.min.css', array(), rand(111, 9999), 'all');
  wp_enqueue_style('default-screen2', THEME_URI . '/style.css', array());

  wp_enqueue_script('default-script', THEME_URI . '/assets/js/base.min.js', array('jquery'), false, true);
  wp_enqueue_script('default-script1', THEME_URI . '/assets/js/custom.js', array('jquery'), rand(111, 9999), true);
}

add_action('wp_enqueue_scripts', 'defaultScripts');
// Enqueue scripts and styles

// Pagination Setup
function custom_pagination()
{
  global $wp_query;
  $big = 999999999; // need an unlikely integer

  // Define the SVG for the previous button
  // The SVG content is kept as is; it will be passed directly as HTML.
  $prev_svg = '<svg width="40" height="40" viewBox="0 0 71 48" fill="none" xmlns="http://www.w3.org/2000/svg"><circle cx="24" cy="24" r="24" transform="rotate(-180 24 24)" fill="#E63946" /><path d="M30.3845 34.8674L30.0309 34.5139L30.3845 34.8674C30.8483 34.4034 30.8478 33.6512 30.3835 33.1878L23.6637 26.4818C23.3482 26.167 23.5712 25.6279 24.0169 25.6279L69.295 25.6279C69.9605 25.6279 70.5 25.0884 70.5 24.4229C70.5 23.7574 69.9605 23.2179 69.295 23.2179L24.0455 23.2179C23.6 23.2179 23.3769 22.6793 23.6919 22.3644L30.3915 15.6648C30.8594 15.1969 30.8568 14.4375 30.3857 13.9728C29.9191 13.5126 29.1686 13.5151 28.7052 13.9785L19.3215 23.3623C18.7357 23.948 18.7357 24.8978 19.3215 25.4836L28.7054 34.8676C29.1691 35.3312 29.9209 35.3312 30.3845 34.8674Z" fill="#F1FAEE" stroke="#F1FAEE" /></svg>';

  // Define the SVG for the next button
  // The SVG content is kept as is; it will be passed directly as HTML.
  $next_svg = '<svg width="40" height="40" viewBox="0 0 71 48" fill="none" xmlns="http://www.w3.org/2000/svg"><circle cx="47" cy="24" r="24" fill="#E63946" /><path d="M40.6155 13.1326L40.9691 13.4861L40.6155 13.1326C40.1517 13.5966 40.1522 14.3488 40.6165 14.8122L47.3363 21.5182C47.6518 21.833 47.4288 22.3721 46.9831 22.3721H1.705C1.0395 22.3721 0.5 22.9116 0.5 23.5771C0.5 24.2426 1.03949 24.7821 1.705 24.7821H46.9545C47.4 24.7821 47.6231 25.3207 47.3081 25.6356L40.6085 32.3352C40.1407 32.8031 40.1432 33.5625 40.6143 34.0272C41.0809 34.4874 41.8314 34.4849 42.2948 34.0215L51.6785 24.6377C52.2643 24.052 52.2643 23.1022 51.6785 22.5164L42.2946 13.1324C41.8309 12.6688 41.0791 12.6688 40.6155 13.1326Z" fill="#F1FAEE" stroke="#F1FAEE" /></svg>';

  // No need to escape SVGs with htmlentities here.
  // paginate_links expects raw HTML for prev_text/next_text.

  $pages = paginate_links(array(
    'base' => str_replace($big, '%#%', esc_url(get_pagenum_link($big))),
    'format' => '?paged=%#%',
    'current' => max(1, get_query_var('paged')),
    'total' => $wp_query->max_num_pages,
    'prev_next' => true, // Ensure prev_next is true to display the arrows
    'type'  => 'array',
    'prev_text'  => '<span aria-hidden="true">' . $prev_svg . '</span>', // Use raw SVG
    'next_text'  => '<span aria-hidden="true">' . $next_svg . '</span>', // Use raw SVG
  ));
  $output = '';

  if (is_array($pages)) {
    if (is_front_page()) {
      $paged = (get_query_var('page') == 0) ? 1 : get_query_var('page');
    } else {
      $paged = (get_query_var('paged') == 0) ? 1 : get_query_var('paged');
    }

    $output .=  '<ul class="pagination">';
    foreach ($pages as $page) {
      $output .= "<li class='page-item'>$page</li>";
    }
    $output .= '</ul>';

    // Load HTML into DOMDocument for modification
    $dom = new \DOMDocument();
    // Use LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD to prevent adding html/body/doctype tags
    $dom->loadHTML(mb_convert_encoding($output, 'HTML-ENTITIES', 'UTF-8'), LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);

    // Create an instance of DOMXpath and select all elements with the class 'page-numbers'
    $xpath = new \DOMXpath($dom);
    $page_numbers = $xpath->query("//*[contains(concat(' ', normalize-space(@class), ' '), ' page-numbers ')]");

    foreach ($page_numbers as $page_numbers_item) {
      // Replace the class 'current' with 'active'
      $current_class = $page_numbers_item->attributes->getNamedItem('class');
      if ($current_class) {
        $current_class->nodeValue = str_replace(
          'current',
          'active',
          $current_class->nodeValue
        );
      }

      // Replace the class 'page-numbers' with 'page-link'
      $page_numbers_class = $page_numbers_item->attributes->getNamedItem('class');
      if ($page_numbers_class) {
        $page_numbers_class->nodeValue = str_replace(
          'page-numbers',
          'page-link',
          $page_numbers_class->nodeValue
        );
      }

      // Removed the unescaping logic for SVGs here, as they should already be raw.
      // DOMDocument's saveHTML will handle its own encoding, but the browser will interpret the SVG.
    }
    $output = $dom->saveHTML();
  }
  return $output;
}
// Pagination Setup

// Menu Setup
function setupMenu()
{
  register_nav_menus(array(
    'main_menu' => 'Home',
    'footer_menu' => 'Footer',
  ), '');
}
setupMenu();
// Menu Setup

//remove ul in nav menu
function removeUl($menu)
{
  return preg_replace(array('#^<ul[^>]*>#', '#</ul>$#'), '', $menu);
}
add_filter('wp_nav_menu', 'removeUl');

//add class on li menu
function addClassesOnLi($classes, $item, $args)
{
  $classes[] = 'nav-item';
  return $classes;
}
add_filter('nav_menu_css_class', 'addClassesOnLi', 1, 3);

//add class on a menu
function addClassesOnA($ulclass)
{
  return preg_replace('/<a/', '<a class="nav-link"', $ulclass, -1);
}
add_filter('wp_nav_menu', 'addClassesOnA');

// //change class sub-menu
// function newSubmenuClass($menu) {    
//   $menu = preg_replace('/ class="sub-menu"/','/ class="dropdown-menu" /',$menu);        
//   return $menu;      
// }
// add_filter('wp_nav_menu','newSubmenuClass'); 

// //change class li sub-menu
// function newSubmenuLiClass($menu) {    
//   $menu = preg_replace('/ class="menu-item-has-children"/','/ class="dropdown" /',$menu);        
//   return $menu;      
// }
// add_filter('wp_nav_menu','newSubmenuLiClass'); 

//add class active menu
function removeActiveClass($class)
{
  return ($class == 'active') ? FALSE : TRUE;
}

function specialNavClass($classes, $item)
{
  if (in_array('current-menu-item', $classes)) {
    $classes[] = 'active ';
  } elseif (in_array('current-page-ancestor', $classes)) {
    $classes[] = 'active ';
  } elseif (is_single() && $item->title == 'News') {
    $classes[] = 'current-menu-item active';
  } elseif (is_single() && $item->title == 'Berita') {
    $classes[] = 'current-menu-item active';
  }
  // else if(is_singular( 'product' )){
  //   $classes = array_filter( $classes, 'remove_active_class' );

  //   if( in_array( 'product-menu', $classes) ) {
  //     $classes[] = 'current-menu-item active';
  //   }
  //    // add class product-menu in admin
  // }
  return $classes;
}
add_filter('nav_menu_css_class', 'specialNavClass', 10, 2);

// Hide content editor
add_action('admin_init', 'hideEditor');
function hideEditor()
{
  // Get the Post ID.
  $post_id = $_GET['post'] ? $_GET['post'] : $_POST['post_ID'];
  if (!isset($post_id)) return;
  // Hide the editor on the page titled 'Homepage'
  $pagename = get_the_title($post_id);
  if ($pagename == 'Home') {
    remove_post_type_support('page', 'editor');
  }
  // Hide the editor on a page with a specific page template
  // Get the name of the Page Template file.
  $template_file = get_post_meta($post_id, '_wp_page_template', true);
  if ($template_file == 'front-page.php') { // the filename of the page template
    remove_post_type_support('page', 'editor');
  }
  if ($template_file == 'page-about.php') {
    remove_post_type_support('page', 'editor');
  }
  if ($template_file == 'home.php') {
    remove_post_type_support('page', 'editor');
  }
}

// remove wp version in css and js
add_filter('style_loader_src', 'sdtRemoveVerCssJs', 9999);
add_filter('script_loader_src', 'sdtRemoveVerCssJs', 9999);
function sdtRemoveVerCssJs($src)
{
  if (strpos($src, 'ver='))
    $src = remove_query_arg('ver', $src);
  return $src;
}
// remove wp version
remove_action('wp_head', 'wp_generator');

/**
 * Disable the emoji's
 */

function disableEmojisTinymce($plugins)
{
  if (is_array($plugins)) {
    return array_diff($plugins, array('wpemoji'));
  } else {
    return array();
  }
}

function disableEmojis()
{
  remove_action('wp_head', 'print_emoji_detection_script', 7);
  remove_action('admin_print_scripts', 'print_emoji_detection_script');
  remove_action('wp_print_styles', 'print_emoji_styles');
  remove_action('admin_print_styles', 'print_emoji_styles');
  remove_filter('the_content_feed', 'wp_staticize_emoji');
  remove_filter('comment_text_rss', 'wp_staticize_emoji');
  remove_filter('wp_mail', 'wp_staticize_emoji_for_email');
  add_filter('tiny_mce_plugins', 'disableEmojisTinymce');
}
add_action('init', 'disableEmojis');

// Remove comment-reply.min.js from footer
function commentsCleanHeaderHook()
{
  wp_deregister_script('comment-reply');
}
add_action('init', 'commentsCleanHeaderHook');

// Remove some admin menu
function customMenuPageRemoving()
{
  // remove_menu_page( 'index.php' );                  //Dashboard
  // remove_menu_page( 'edit.php' );                   //Posts
  // remove_menu_page( 'upload.php' );                 //Media
  // remove_menu_page( 'edit.php?post_type=page' );    //Pages
  remove_menu_page('edit-comments.php');          //Comments
  // remove_menu_page( 'themes.php' );                 //Appearance
  // remove_menu_page( 'plugins.php' );                //Plugins
  // remove_menu_page( 'users.php' );                  //Users
  remove_menu_page('tools.php');                  //Tools
  // remove_menu_page( 'options-general.php' );        //Settings
}
add_action('admin_menu', 'customMenuPageRemoving');


function get_breadcrumb()
{
  global $post;

  echo '<li class="breadcrumb-item"><a href="' . home_url() . '" rel="nofollow">Home</a></li>';
  if (is_category() || is_single() || is_tax()) {
    $category_detail = get_the_category($post->ID);
    $terms = get_the_terms($post->ID, 'products');

    if (empty($category_detail)) {
      echo '<li class="breadcrumb-item">';
      foreach ($terms as $term) {
        echo '<a href="' . get_term_link($term) . '">';
        echo $term->name;
      }
      echo '</a></li>';
    } else {
      echo '<li class="breadcrumb-item">';
      foreach ($category_detail as $cd) {
        echo ' ';
        echo $cd->cat_name;
      }
      echo '</li>';
    }
    if (is_single()) {
      echo '<li class="breadcrumb-item">';
      the_title();
      echo '</li>';
    }
  } elseif (is_page()) {
    echo '<li class="breadcrumb-item">';
    echo the_title();
    echo '</li>';
  } elseif (is_home()) {
    echo '<li class="breadcrumb-item">';
    echo 'Blog';
    echo '</li>';
  } elseif (is_search()) {
    echo '<li class="breadcrumb-item">';
    echo 'Search';
    // echo the_search_query();
    echo '</li>';
  } elseif (is_archive()) {
    echo '<li class="breadcrumb-item">';
    echo 'Archive';
    echo '</li>';
  }
}

// function language_selector_flags(){
//     $languages = icl_get_languages('skip_missing=0&orderby=code');
//       if(!empty($languages)){
//         foreach($languages as $l){
//         if($l['active']) {
//           echo '<a class="active" href="'.$l['url'].'">';
//         }
//         else{
//           echo '<a class="nav-link" href="'.$l['url'].'">';
//         }
//         echo $l['language_code'];
//         echo '</a>';
//     }
//   }
// }

// Post Type Settings
// dashicons https://developer.wordpress.org/resource/dashicons/#menu-alt3
function initPostType()
{
  register_post_type('product', array(
    'label' => 'Product',
    'description' => '',
    'public' => true,
    'show_ui' => true,
    'show_in_menu' => true,
    'menu_icon' => 'dashicons-products',
    'capability_type' => 'post',
    'map_meta_cap' => true,
    'hierarchical' => false,
    'rewrite' => array('slug' => 'product', 'with_front' => true),
    'query_var' => true,
    'supports' => array('title', 'thumbnail', 'post-formats', 'categories'),
    'labels' => array(
      'name' => 'Products',
      'singular_name' => 'Single Product',
      'menu_name' => 'Products',
      'add_new' => 'Add New',
      'add_new_item' => 'Add New',
      'edit' => 'Edit',
      'edit_item' => 'Edit Product',
      'new_item' => 'New Product',
      'view' => 'View Product',
      'view_item' => 'View Product',
      'search_items' => 'Search Products',
      'not_found' => 'No Product Found',
      'not_found_in_trash' => 'No Product Found in Trash',
      'parent' => 'Parent Product',
    ),
    'public' => true,
    'has_archive' => false,
  ));

  $category_labels = array(
    'label' => 'Products Categories',
    'hierarchical' => true,
    'query_var' => true,
    'show_admin_column' => true,
  );

  register_taxonomy('products', 'product', $category_labels);
  // products yg dipakai buat dapetin category
  // ganti 'product' line 373 dan 333 bersamaan
}
add_action('init', 'initPostType');

// buat custom slug /category/ di single product
// tambah /%products% di line 343
function wpa_products_post_link($post_link, $id = 0)
{
  $post = get_post($id);
  if (is_object($post)) {
    $terms = wp_get_object_terms($post->ID, 'products');
    if ($terms) {
      return str_replace('%products%', $terms[0]->slug, $post_link);
    }
  }
  return $post_link;
}
add_filter('post_type_link', 'wpa_products_post_link', 1, 3);

/**
 * Force Taxonomy Subcategories to new template
 *
 * @param String $template - Expected template path
 *
 * @return String $template
 */
function taxonomySubcategoryTemplate($template)
{

  // We're not on a taxonomy page
  if (!(is_tax() && is_tax('products'))) {
    return $template;
  }

  // Grab the queried object, _should_ be a term but make sure.
  $queried_object = get_queried_object();

  // We either don't have the right object OR we're on a top level category becuase $term->parent === 0
  if (isset($queried_object->parent) && empty($queried_object->parent)) {
    return $template;
  }

  // Our template could be located anywhere, we could store it in a subdirectory but 
  // we would need to specify a relative path from the theme root to it.
  // Example: 'templates/brand-subcategories.php'
  if (false !== ($new_template = locate_template('taxonomy-subcategory.php'))) {
    $template = $new_template;
  }

  return $template;
}
add_filter('template_include', 'taxonomySubcategoryTemplate');

// remove width and height in images
add_filter('post_thumbnail_html', 'removeWpsWidthAttribute', 10);
add_filter('image_send_to_editor', 'removeWpsWidthAttribute', 10);

function removeWpsWidthAttribute($html)
{
  $html = preg_replace('/(width|height)=\"\d*\"\s/', "", $html);
  return $html;
}

// Remove <p> and <br/> from Contact Form 7
add_filter('wpcf7_autop_or_not', '__return_false');
