<?php

/**
 * The sub category custom post template file
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

<main class="sub-category-page">
  <section class="section-1 p-0">
    <div class="row">
      <div class="col-md-12">
        <div style="background: linear-gradient(rgba(145, 137, 137, 0.5), rgba(91, 88, 88, 0.5)), url(
              <?php $tax_id = get_queried_object()->term_id;
              $imageTop = get_field('top_background_image', 'category_' . $tax_id);
              if (!empty($imageTop)): ?>
                  <?php echo $imageTop; ?>
                <?php else: ?>
                  <?= get_template_directory_uri() ?>/assets/img/cover-category.jpg
                <?php endif; ?>
              )no-repeat center top;background-size: cover;min-height: 380px;">
          <div class="caption">
            <h1><?php single_cat_title() ?></h1>
            <p><?php the_archive_description('', ''); ?></p>
          </div>
        </div>
      </div>
  </section>

  <section class="container section-2 p-0 pt-4">
    <div class="row">
      <div class="col-md-12">
        <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='currentColor'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
          <ol class="breadcrumb">
            <?php get_breadcrumb(); ?>
          </ol>
        </nav>
      </div>

      <div class="col-md-12">
        <h3><?php single_cat_title() ?></h3>
      </div>

      <div class="row row-cols-2 row-cols-md-3 row-cols-lg-4 g-4 pb-2">
        <?php
        if (have_posts()): while (have_posts()): the_post(); ?>
            <div class="col">
              <a href='<?php the_permalink(); ?>' class="card h-100">
                <div class="img-gradient">
                  <?php the_post_thumbnail('full', array('class' => 'card-img-top img-fluid')); ?>
                  <h5 class="card-text"><?php
                                        $terms = get_the_terms($post->ID, 'products');
                                        foreach ($terms as $term) {
                                          echo $term->name;
                                        } ?></h5>
                </div>
                <div class="card-body">
                  <h4 class="card-title"><?php the_title(); ?></h4>
                </div>
                <div class="card-footer">
                  <?php if (!empty(get_field('sale_price'))): ?>
                    <small class="price">Start from
                      <span class='wrapPriceReal'>
                        <span class='priceRupiah'> IDR <span class="priceText"><?php the_field('sale_price'); ?></span></span>

                        <div class='wrapPrice'>
                          <span class='priceReal' style='display:none;'><?php the_field('price'); ?></span>
                          <span class='salePrice' style='display:none;'><?php the_field('sale_price'); ?></span>

                          <span class="priceDiscount"></span>
                          <small class="price">IDR <span class="priceText"><?php the_field('price'); ?></span> </small>

                        </div>

                      </span>
                    </small>
                  <?php else: ?>
                    <small class="price">Start from <span>IDR <span class="priceText"><?php the_field('price'); ?></span></span></small>
                  <?php endif; ?>
                  <small class="location"><?php the_field('location'); ?></small>
                </div>
              </a>
            </div>
        <?php endwhile;
        endif;
        wp_reset_query(); ?>
      </div>

      <nav aria-label='page navigation' class='navigation'>
        <?php echo custom_pagination(); ?>
      </nav>

    </div>
  </section>

</main>

<?php get_footer();
