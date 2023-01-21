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
  wp_enqueue_style('default-screen', 'https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600&display=swap', array());
  wp_enqueue_style('default-screen1', 'https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.1.3/css/bootstrap.min.css', array());
  wp_enqueue_style('default-screen2', 'https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.css', array());
  wp_enqueue_style('default-screen3', 'https://cdnjs.cloudflare.com/ajax/libs/normalize/8.0.1/normalize.min.css', array());
  wp_enqueue_style('default-screen4', THEME_URI . '/assets/css/style.css', array(), rand(111, 9999), 'all');
  wp_enqueue_style('default-screen5', THEME_URI . '/style.css', array());

  wp_enqueue_script('default-script', 'https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js', array('jquery'), false, true);
  wp_enqueue_script('default-script1', 'https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.11.5/umd/popper.min.js', array('jquery'), false, true);
  wp_enqueue_script('default-script2', 'https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.1.3/js/bootstrap.min.js', array('jquery'), false, true);
  wp_enqueue_script('default-script3', 'https://cdnjs.cloudflare.com/ajax/libs/jquery.cycle2/2.1.6/jquery.cycle2.min.js', array('jquery'), false, true);
  wp_enqueue_script('default-script4', 'https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js', array('jquery'), false, true);
  wp_enqueue_script('default-script5', 'https://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.3/modernizr.min.js', array('jquery'), false, true);
  wp_enqueue_script('default-script6', THEME_URI . '/assets/js/custom.js', array('jquery'), false, true);
}

add_action('wp_enqueue_scripts', 'defaultScripts');
// Enqueue scripts and styles

// Pagination Setup
function custom_pagination()
{
  global $wp_query;
  $big = 999999999;
  $pages = paginate_links(array(
    'base' => str_replace($big, '%#%', esc_url(get_pagenum_link($big))),
    'format' => '?paged=%#%',
    'current' => max(1, get_query_var('paged')),
    'total' => $wp_query->max_num_pages,
    'prev_next' => false,
    'type'  => 'array',
    'prev_next'   => TRUE,
    'prev_text'    => __('<span aria-hidden="true"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chevron-left" viewBox="0 0 16 16">
            <path fill-rule="evenodd" d="M11.354 1.646a.5.5 0 0 1 0 .708L5.707 8l5.647 5.646a.5.5 0 0 1-.708.708l-6-6a.5.5 0 0 1 0-.708l6-6a.5.5 0 0 1 .708 0z"/>
          </svg></span>'),
    'next_text'    => __('<span aria-hidden="true"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chevron-right" viewBox="0 0 16 16">
            <path fill-rule="evenodd" d="M4.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L10.293 8 4.646 2.354a.5.5 0 0 1 0-.708z"/>
          </svg></span>'),
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
    $dom = new \DOMDocument();
    $dom->loadHTML(mb_convert_encoding($output, 'HTML-ENTITIES', 'UTF-8'));
    // Create an instance of DOMXpath and all elements with the class 'page-numbers' 
    $xpath = new \DOMXpath($dom);
    $page_numbers = $xpath->query("//*[contains(concat(' ', normalize-space(@class), ' '), ' page-numbers ')]");

    foreach ($page_numbers as $page_numbers_item) {

      // Replace the class 'current' with 'active'
      $page_numbers_item->attributes->item(0)->value = str_replace(
        'current',
        'active',
        $page_numbers_item->attributes->item(0)->value
      );

      // Replace the class 'page-numbers' with 'page-link'
      $page_numbers_item->attributes->item(0)->value = str_replace(
        'page-numbers',
        'page-link',
        $page_numbers_item->attributes->item(0)->value
      );
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
//   $menu = preg_replace('/ class="sub-menu"/','/ class="dropdown-menu p-0" /',$menu);        
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
  } else if (in_array('current-page-ancestor', $classes)) {
    $classes[] = 'active ';
  } else if (is_single() && $item->title == 'News') {
    $classes[] = 'current-menu-item active';
  } else if (is_single() && $item->title == 'Berita') {
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
  if ($template_file == 'page-contact.php') {
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
  echo '<li class="breadcrumb-item"><a href="' . home_url() . '" rel="nofollow">Home</a></li>';
  if (is_category() || is_single()) {
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
}
add_action('init', 'initPostType');

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
