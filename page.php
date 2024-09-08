<?php

/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Default
 * @since 1.0
 * @version 1.0
 */

get_header(); ?>

<main class="single-detail-portfolio-page">
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
      <?php if (have_posts()): while (have_posts()): the_post(); ?>
          <div class="col-md-12">
            <div class="sub-title">
              <h1><?php the_title() ?></h1>
            </div>
          </div>
          <div class="col-md-12">
            <?php the_content(); ?>
          </div>
      <?php endwhile;
      endif; ?>
    </div>
  </section>

</main>

<?php get_footer();
