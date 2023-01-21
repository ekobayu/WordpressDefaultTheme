<?php

/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package WordPress
 * @subpackage Default
 * @since 1.0
 * @version 1.0
 */

?>
<!doctype html>
<html class="no-js" lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta http-equiv="content-type" content="text/html; charset=utf-8" />
  <meta content='IE=edge' http-equiv='X-UA-Compatible'>
  <link rel="icon" href="<?php echo THEME_URI; ?>/assets/img/favicon.png">
  <?php wp_head(); ?>
  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
<![endif]-->
</head>

<body>

  <!-- Wrapper -->
  <div class="wrap push">

    <!-- Header -->
    <div class="header-wrap">

      <!-- Top Bar -->
      <div class="top-bar">
        <div class="container">
          <div class="row">
            <!-- Top Left Nav -->
            <div class="col-sm-6 col-xs-6" style="margin-top: 3px;">
              <ul class="top-left">
                <li><i class="fa fa-phone"></i><?php the_field('top_header_telp', 'options'); ?></li>
                <li><i class="fa fa-envelope-o"></i><?php the_field('top_header_email', 'options'); ?></li>
              </ul>
            </div>
            <!-- Top Left Nav -->

            <!-- Top Right Nav -->
            <div class="col-sm-6 col-xs-6 r-full-width">
              <ul class="top-right text-right">
                <li class="md-trigger" data-modal=""><a href="<?php the_field('top_header_instagram', 'options'); ?>"><i class="fa fa-instagram"></i>
                <li class="md-trigger" data-modal=""><a href="<?php the_field('top_header_facebook', 'options'); ?>"><i class="fa fa-facebook"></i>
                <li class="md-trigger" data-modal=""><a href="<?php the_field('top_header_twitter', 'options'); ?>"><i class="fa fa-twitter"></i>
              </ul>
            </div>
            <!-- Top Right Nav -->
          </div>
        </div>
      </div>
      <!-- Top Bar -->

      <!-- Navigation Holder -->
      <header class="header">
        <div class="container">
          <div class="nav-holder">

            <!-- Logo Holder -->
            <div class="logo-holder">
              <a href="<?php echo get_home_url(); ?>" class="inner-logo"></a>
            </div>
            <!-- Logo Holder -->

            <!-- Navigation -->
            <div class="cr-navigation">

              <!-- Navbar -->
              <nav class="cr-nav">
                <?php wp_nav_menu(array(
                  'theme_location' => 'main_menu',
                  'container' => false,
                )); ?>
              </nav>
              <!-- Navbar -->

              <!-- Secondry Nav -->
              <ul class="cr-add-nav visible-xs">
                <li><a href="#menu" class="menu-link"><i class="fa fa-bars"></i></a></li>
              </ul>
              <!-- Secondry Nav -->

            </div>
            <!-- Navigation -->

          </div>
        </div>
      </header>
      <!-- Navigation Holder -->

    </div>
    <!-- Header -->

    <!-- News Headline Container -->
    <div class="news-bar white-bg">
      <div class="container">
        <div class="row">

          <!-- news -->
          <div class="col-lg-6 col-md-6 col-sm-6 col-xs-9 r-full-width">
            <div class="headline-wrap">

              <span class="badge" style="background-color:#7ABE0F">Promo</span>

              <!-- news ticker -->
              <div id="ticker">
                <div class="clip">
                  <?php if (function_exists('ditty_news_ticker')) {
                    ditty_news_ticker(125);
                  } ?>
                </div>
              </div>
              <!-- news ticker -->

              <!-- ticker spinner -->
              <div class="alert-spinner">
                <div class="double-bounce1" style="background-color:#7ABE0F"></div>
                <div class="double-bounce2" style="background-color:#7ABE0F"></div>
              </div>
              <!-- ticker spinner -->

            </div>
          </div>
          <!-- news -->

          <!-- time clock -->
          <div class="col-lg-2 col-md-2 col-sm-2 col-xs-3 r-full-width">
            <div class="time-clock">
              <div id="clock"></div>
            </div>
          </div>
          <!-- time clock -->

          <!-- Wheather forecast -->
          <div class="col-lg-4 col-md-4 col-sm-4 hidden-xs" style="margin-bottom:-10px;">
            <div class="input-group col-md-12">
              <span class="input-group-btn">
                <button class="btn btn-danger" type="button" style="width:60px; height:48px;">
                  <img src="<?= get_template_directory_uri() ?>/assets/images/search/search.png" style="margin-bottom:5px; ">
                </button>
              </span>
              <form action="/" method="get">
                <input type="text" name="s" id="search" style="color:#fff;" class="search-query form-control" placeholder="Pencarian Artikel" value="<?php the_search_query(); ?>" />
              </form>
            </div>
          </div>
          <!-- Wheather forecast -->

        </div>
      </div>
    </div>
    <!-- News Headline Container -->