<?php

/**
 * The template for displaying category pages
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Default
 * @since 1.0
 * @version 1.0
 */

get_header(); ?>

<main class="contact-page">
  <section class="section-1">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12 p-0">
          <img class="img-fluid" src="<?php echo THEME_URI; ?>/assets/img/contact-banner.webp" alt="banner default" />
        </div>
      </div>
    </div>
  </section>

  <section class="section-2">
    <div class="container">
      <div class="row">
        <div class="col-sm-12">
          <h1><?php single_cat_title() ?></h1>
          <p><?php the_archive_description('', ''); ?></p>
        </div>
      </div>

      <div class="row">
        <div class="col-sm-12">
          <?php
          if (have_posts()) : while (have_posts()) : the_post(); ?>
              <div class="search-item">
                <div>
                  <?php the_post_thumbnail('full', array('class' => 'd-block img-fluid')); ?>
                </div>
                <div class="description">
                  <h2><?php the_title() ?></h2>
                  <p>
                    <?php echo (get_the_excerpt()); ?>
                  </p>
                  <a class="search-link" href="<?php the_permalink() ?>">Read More</a>
                </div>
              </div>
          <?php endwhile;
          endif;
          wp_reset_query(); ?>

          <nav aria-label="page navigation" class="navigation">
            <?php echo custom_pagination(); ?>
          </nav>
        </div>
      </div>
    </div>
  </section>
</main>

<?php get_footer();
