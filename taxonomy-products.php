<?php

/**
 * The category custom post template file
 *
 * If the user has selected a static page for their homepage, this is what will
 * appear.
 * Learn more: https://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Default
 * @since 1.0
 * @version 1.0
 */

get_header(); ?>

<main class="single-category-services-page">
  <section class="section-1">
    <div class="row">
      <div class="col-md-12">
        <nav
          style="
                --bs-breadcrumb-divider: url('data:image/svg+xml,%3Csvg%20width%3D%227%22%20height%3D%228%22%20viewBox%3D%220%200%207%208%22%20fill%3D%22none%22%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%3E%3Cpath%20d%3D%22M0.504%200.48H2.344L6.216%204.144L2.344%207.824H0.504L4.376%204.144L0.504%200.48Z%22%20fill%3D%22%231D3557%22%2F%3E%3C%2Fsvg%3E');
              "
          aria-label="breadcrumb">
          <ol class="breadcrumb">
            <?php get_breadcrumb(); ?>
          </ol>
        </nav>
      </div>
    </div>

    <div class="row top-section">
      <div class="col-md-12">
        <div class="sub-title">
          <h1><?php single_cat_title() ?></h1>
        </div>
      </div>
      <div class="col-md-7">
        <p>
          <?php the_archive_description('', ''); ?>
        </p>
      </div>
    </div>

    <div class="row" data-masonry='{"percentPosition": true }'>
      <?php
      if (have_posts()): while (have_posts()): the_post(); ?>
          <div class="col-6 col-sm-6 col-lg-4 mb-4">
            <a href='<?php the_permalink(); ?>' class="grid-item">
              <?php the_post_thumbnail('full', array('class' => 'img-fluid')); ?>
              <div class="summary">
                <h2><?php the_title(); ?></h2>
                <p>
                  <?php the_field('description_services'); ?>
                </p>
              </div>
            </a>
          </div>
      <?php endwhile;
      endif;
      wp_reset_query(); ?>
    </div>
  </section>
</main>

<?php get_footer();
