<?php

/**
 * The front page template file
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

<!-- Main Content -->
<main class="wrapper">
  <div class="theme-padding" style="padding:30px;">
    <div class="container">

      <!-- Slider Widget -->
      <div class="row">
        <!-- Gallery Widget -->
        <div class="post-widget col-lg-7 col-md-7 col-sm-12 col-xs-12">
          <div class="gallery-widget">
            <?php echo do_shortcode("[metaslider id=121]"); ?>
          </div>
        </div>
        <!-- Gallery Widget -->

        <!-- News Widget -->
        <div class="grid-item col-lg-3 col-md-5 col-sm-12 col-xs-12 r-full-width">
          <!-- Post Widget -->
          <div class="widget">
            <div class="horizontal-tabs-widget post-tabs">

              <!-- tabs navs -->
              <ul class="theme-tab-navs">
                <li class="active">
                  <a href="#featured" data-toggle="tab">Featured Posts</a>
                </li>

                <li>
                  <a href="#popular" data-toggle="tab">Popular Posts</a>
                </li>
              </ul>
              <!-- tabs navs -->

              <!-- Tab panes -->
              <div class="horizontal-tab-content tab-content">
                <div class="tab-pane fade active in" id="featured">
                  <ul>
                    <?php
                    $custom_posts = new WP_Query(array(
                      'posts_per_page' => 6,
                      'meta_key'   => 'featured_post',
                      'meta_value' => 1,
                    ));

                    if ($custom_posts->have_posts()) :
                      while ($custom_posts->have_posts()) : $custom_posts->the_post();
                    ?>
                        <li>
                          <!-- blog post -->
                          <div class="post-wrap small-post">

                            <!-- post img -->
                            <div class="post-thumb">
                              <?php the_post_thumbnail(array(80, 60)) ?>
                            </div>
                            <!-- post img -->

                            <!-- post detail -->
                            <div class="post-content">
                              <h5><a href="<?php the_permalink() ?>"><?php the_title() ?></a></h5>

                              <!-- post meta -->
                              <ul class="post-meta">
                                <li><i class="fa fa-clock-o"></i><?php echo get_the_time('j F Y', $id); ?></li>
                                <!-- <li><i class="fa fa-comments-o"></i>20</li> -->
                              </ul>
                              <!-- post meta -->

                            </div>
                            <!-- post detail -->

                          </div>

                          <!-- blog post -->

                        </li>
                    <?php endwhile;
                    endif;
                    wp_reset_postdata(); ?>

                  </ul>
                </div>

                <div class="tab-pane fade" id="popular">
                  <ul>
                    <?php
                    $custom_posts = new WP_Query(array(
                      'posts_per_page' => 5,
                      'meta_key' => 'wpb_post_views_count',
                      'orderby' => 'meta_value_num',
                      'order' => 'DESC',
                    ));

                    if ($custom_posts->have_posts()) :
                      while ($custom_posts->have_posts()) : $custom_posts->the_post();
                    ?>
                        <li>
                          <!-- blog post -->
                          <div class="post-wrap small-post">

                            <!-- post img -->
                            <div class="post-thumb">
                              <?php the_post_thumbnail(array(80, 60)) ?>
                            </div>
                            <!-- post img -->

                            <!-- post detail -->
                            <div class="post-content">
                              <h5><a href="<?php the_permalink() ?>"><?php the_title() ?></a></h5>

                              <!-- post meta -->
                              <ul class="post-meta">
                                <li><i class="fa fa-clock-o"></i><?php echo get_the_time('j F Y', $id); ?></li>
                                <!-- <li><i class="fa fa-comments-o"></i>20</li> -->
                              </ul>
                              <!-- post meta -->

                            </div>
                            <!-- post detail -->

                          </div>

                          <!-- blog post -->

                        </li>
                    <?php endwhile;
                    endif;
                    wp_reset_postdata(); ?>
                </div>
              </div>
              <!-- Tab panes -->
            </div>
          </div>
          <!-- Post Widget -->
        </div>
        <!-- News Widget -->

      </div>

      <!-- Main Content Row -->
      <div class="row">

        <!-- Content -->
        <div class="col-lg-7 col-md-7 col-sm-12 col-xs-12 r-full-width">

          <!-- Detail Post Widget -->
          <div class="post-widget">
            <div class="row">
              <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">

                <!-- Secondary Heading -->
                <div class="primary-heading1">
                  <a href="<?php echo esc_url(get_category_link(2)); ?>">
                    <h2>Business Solution</h2>
                  </a>
                </div>
                <!-- Secondary Heading -->

                <!-- Post -->
                <div class="post style-2 white-bg light-shadow badge1">
                  <?php
                  $custom_posts = new WP_Query(array(
                    'cat' => 2,
                    'posts_per_page' => 3,
                  ));

                  if ($custom_posts->have_posts()) :
                    while ($custom_posts->have_posts()) : $custom_posts->the_post();
                  ?>
                      <?php if (is_latest_post()) : { ?>
                          <!-- Post Img -->
                          <div class="post-thumb">
                            <?php the_post_thumbnail(array(415, 289)) ?>
                            <a href="<?php echo esc_url(get_category_link(2)); ?>"><span class="post-badge">Business Solution</span></a>
                            <div class="thumb-hover">
                              <div class="position-center-center">
                                <a href="<?php the_permalink() ?>" class="fa fa-link"></a>
                              </div>
                            </div>
                          </div>
                          <!-- Post Img -->

                          <!-- Post Detil -->
                          <div class="post-content cat-listing">
                            <h4><a href="<?php the_permalink() ?>"><?php the_title() ?></a></h4>
                            <p><?php the_excerpt() ?></p>
                          </div>
                        <?php }
                      else : ?>
                        <div class="post-content cat-listing">
                          <ul class="post-wrap-list">

                            <!-- thumb small post -->
                            <li class="post-wrap big-post">
                              <div class="post-thumb">
                                <?php the_post_thumbnail(array(90, 70)) ?>
                              </div>
                              <div class="post-content">
                                <h4><a href="<?php the_permalink() ?>"><?php the_title() ?></a></h4>
                                <ul class="post-meta">
                                  <li><i class="fa fa-clock-o"></i><?php echo get_the_time('j F Y', $id); ?></li>
                                  <!-- <li><i class="fa fa-comments-o"></i>20</li> -->
                                </ul>
                              </div>
                            </li>
                            <!-- thumb small post -->

                          </ul>
                        </div>
                      <?php endif; ?>
                      <!-- Post Detail -->
                  <?php endwhile;
                  endif;
                  wp_reset_postdata(); ?>
                </div>
                <!-- Post -->

              </div>
              <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">

                <!-- Secondary Heading -->
                <div class="primary-heading2">
                  <a href="<?php echo esc_url(get_category_link(3)); ?>">
                    <h2>Auto Cleaning</h2>
                  </a>
                </div>
                <!-- Secondary Heading -->

                <!-- Post -->
                <div class="post style-2 white-bg light-shadow badge2">
                  <?php
                  $custom_posts = new WP_Query(array(
                    'cat' => 3,
                    'posts_per_page' => 3,
                  ));

                  if ($custom_posts->have_posts()) :
                    while ($custom_posts->have_posts()) : $custom_posts->the_post();
                  ?>
                      <?php if (is_latest_post()) : { ?>
                          <!-- Post Img -->
                          <div class="post-thumb">
                            <?php the_post_thumbnail(array(415, 289)) ?>
                            <a href="<?php echo esc_url(get_category_link(3)); ?>"><span class="post-badge">Auto Cleaning</span></a>
                            <div class="thumb-hover">
                              <div class="position-center-center">
                                <a href="<?php the_permalink() ?>" class="fa fa-link"></a>
                              </div>
                            </div>
                          </div>
                          <!-- Post Img -->

                          <!-- Post Detil -->
                          <div class="post-content cat-listing">
                            <h4><a href="<?php the_permalink() ?>"><?php the_title() ?></a></h4>
                            <p><?php the_excerpt() ?></p>
                          </div>
                        <?php }
                      else : ?>
                        <div class="post-content cat-listing">
                          <ul class="post-wrap-list">

                            <!-- thumb small post -->
                            <li class="post-wrap big-post">
                              <div class="post-thumb">
                                <?php the_post_thumbnail(array(90, 70)) ?>
                              </div>
                              <div class="post-content">
                                <h4><a href="<?php the_permalink() ?>"><?php the_title() ?></a></h4>
                                <ul class="post-meta">
                                  <li><i class="fa fa-clock-o"></i><?php echo get_the_time('j F Y', $id); ?></li>
                                  <!-- <li><i class="fa fa-comments-o"></i>20</li> -->
                                </ul>
                              </div>
                            </li>
                            <!-- thumb small post -->

                          </ul>
                        </div>
                      <?php endif; ?>
                      <!-- Post Detail -->
                  <?php endwhile;
                  endif;
                  wp_reset_postdata(); ?>
                </div>
                <!-- Post -->

              </div>
            </div>
          </div>
          <!-- Detail Post Widget -->


          <!-- Detail Post Widget -->
          <div class="post-widget">
            <div class="row">
              <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">

                <!-- Secondary Heading -->
                <div class="primary-heading3">
                  <a href="<?php echo esc_url(get_category_link(4)); ?>">
                    <h2>Home Cleaning</h2>
                  </a>
                </div>
                <!-- Secondary Heading -->

                <!-- Post -->
                <div class="post style-2 white-bg light-shadow badge3">
                  <?php
                  $custom_posts = new WP_Query(array(
                    'cat' => 4,
                    'posts_per_page' => 3,
                  ));

                  if ($custom_posts->have_posts()) :
                    while ($custom_posts->have_posts()) : $custom_posts->the_post();
                  ?>
                      <?php if (is_latest_post()) : { ?>
                          <!-- Post Img -->
                          <div class="post-thumb">
                            <?php the_post_thumbnail(array(415, 289)) ?>
                            <a href="<?php echo esc_url(get_category_link(4)); ?>"><span class="post-badge">Home Cleaning</span></a>
                            <div class="thumb-hover">
                              <div class="position-center-center">
                                <a href="<?php the_permalink() ?>" class="fa fa-link"></a>
                              </div>
                            </div>
                          </div>
                          <!-- Post Img -->

                          <!-- Post Detil -->
                          <div class="post-content cat-listing">
                            <h4><a href="<?php the_permalink() ?>"><?php the_title() ?></a></h4>
                            <p><?php the_excerpt() ?></p>
                          </div>
                        <?php }
                      else : ?>
                        <div class="post-content cat-listing">
                          <ul class="post-wrap-list">

                            <!-- thumb small post -->
                            <li class="post-wrap big-post">
                              <div class="post-thumb">
                                <?php the_post_thumbnail(array(90, 70)) ?>
                              </div>
                              <div class="post-content">
                                <h4><a href="<?php the_permalink() ?>"><?php the_title() ?></a></h4>
                                <ul class="post-meta">
                                  <li><i class="fa fa-clock-o"></i><?php echo get_the_time('j F Y', $id); ?></li>
                                  <!-- <li><i class="fa fa-comments-o"></i>20</li> -->
                                </ul>
                              </div>
                            </li>
                            <!-- thumb small post -->

                          </ul>
                        </div>
                      <?php endif; ?>
                      <!-- Post Detail -->
                  <?php endwhile;
                  endif;
                  wp_reset_postdata(); ?>
                </div>
                <!-- Post -->

              </div>
              <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">

                <!-- Secondary Heading -->
                <div class="primary-heading4">
                  <a href="<?php echo esc_url(get_category_link(5)); ?>">
                    <h2>Personal Cleaning</h2>
                  </a>
                </div>
                <!-- Secondary Heading -->

                <!-- Post -->
                <div class="post style-2 white-bg light-shadow badge4">
                  <?php
                  $custom_posts = new WP_Query(array(
                    'cat' => 5,
                    'posts_per_page' => 3,
                  ));

                  if ($custom_posts->have_posts()) :
                    while ($custom_posts->have_posts()) : $custom_posts->the_post();
                  ?>
                      <?php if (is_latest_post()) : { ?>
                          <!-- Post Img -->
                          <div class="post-thumb">
                            <?php the_post_thumbnail(array(415, 289)) ?>
                            <a href="<?php echo esc_url(get_category_link(5)); ?>"><span class="post-badge">Personal Cleaning</span></a>
                            <div class="thumb-hover">
                              <div class="position-center-center">
                                <a href="<?php the_permalink() ?>" class="fa fa-link"></a>
                              </div>
                            </div>
                          </div>
                          <!-- Post Img -->

                          <!-- Post Detil -->
                          <div class="post-content cat-listing">
                            <h4><a href="<?php the_permalink() ?>"><?php the_title() ?></a></h4>
                            <p><?php the_excerpt() ?></p>
                          </div>
                        <?php }
                      else : ?>
                        <div class="post-content cat-listing">
                          <ul class="post-wrap-list">

                            <!-- thumb small post -->
                            <li class="post-wrap big-post">
                              <div class="post-thumb">
                                <?php the_post_thumbnail(array(90, 70)) ?>
                              </div>
                              <div class="post-content">
                                <h4><a href="<?php the_permalink() ?>"><?php the_title() ?></a></h4>
                                <ul class="post-meta">
                                  <li><i class="fa fa-clock-o"></i><?php echo get_the_time('j F Y'); ?></li>
                                  <!-- <li><i class="fa fa-comments-o"></i>20</li> -->
                                </ul>
                              </div>
                            </li>
                            <!-- thumb small post -->

                          </ul>
                        </div>
                      <?php endif; ?>
                      <!-- Post Detail -->
                  <?php endwhile;
                  endif;
                  wp_reset_postdata(); ?>
                </div>
                <!-- Post -->

              </div>
            </div>
          </div>
          <!-- Detail Post Widget -->


          <!-- list posts -->
          <div class="post-widget">


            <!-- List Post -->
            <div class="p-30 light-shadow white-bg">
              <ul class="list-posts">
                <?php
                $custom_posts = new WP_Query(array(
                  'cat' => 13,
                  'posts_per_page' => 3,
                ));
                if ($custom_posts->have_posts()) :
                  while ($custom_posts->have_posts()) : $custom_posts->the_post();
                    $category = get_the_category(); ?>
                    <li class="row no-gutters">

                      <!-- thumbnail -->
                      <div class="col-sm-4 col-xs-12">
                        <div class="post-thumb">
                          <?php the_post_thumbnail(array(236, 165)) ?>
                          <a href="<?php echo esc_url(get_category_link(13)); ?>"><span class="post-badge"><?php echo get_cat_name($category[0]->cat_ID); ?></span></a>
                          <div class="thumb-hover">
                            <div class="position-center-center">
                              <a href="<?php the_permalink() ?>" class="fa fa-link"></a>
                            </div>
                          </div>
                        </div>
                      </div>
                      <!-- thumbnail -->

                      <!-- post detail -->
                      <div class="col-sm-8 col-xs-12">
                        <div class="post-content">
                          <h4><a href="<?php the_permalink() ?>"><?php the_title() ?></a></h4>
                          <ul class="post-meta">
                            <li><i class="fa fa-user"></i><?php the_author(); ?></li>
                            <li><i class="fa fa-clock-o"></i><?php echo get_the_time('j F Y', $id); ?></li>
                          </ul>
                          <p><?php the_excerpt() ?><a href="<?php the_permalink() ?>" class="read-more">read more...</a></p>
                        </div>
                      </div>
                      <!-- post detail -->

                    </li>
                <?php endwhile;
                endif;
                wp_reset_postdata(); ?>

              </ul>
            </div>
            <!-- List Post -->

          </div>
          <!--  list posts -->

        </div>
        <!-- Content -->

        <!-- Sidebar -->
        <div class="col-lg-3 col-md-5 col-xs-12 custom-re">
          <div class="row">
            <aside class="side-bar grid">
              <!-- facebook widget -->
              <div class="grid-item col-lg-12 col-md-12 col-sm-6 col-xs-6 r-full-width">
                <div class="widget">
                  <h3 class="secondry-heading"><a href="https://twitter.com/MicrocleanID">Twitter Feed</a></h3>
                  <div class="feed">
                    <?php echo do_shortcode("[custom-twitter-feeds]"); ?>
                  </div>
                </div>
              </div>
              <!-- facebook widget -->
              <!-- twitter widget -->
              <div class="grid-item col-lg-12 col-md-12 col-sm-6 col-xs-6 r-full-width">
                <div class="widget">
                  <h3 class="secondry-heading"><a href="https://www.facebook.com/MicrocleanID/">Facebook Feed</a></h3>
                  <div class="feed">
                    <?php echo do_shortcode("[custom-facebook-feed]"); ?>
                  </div>
                </div>
              </div>
              <!-- twitter widget -->
            </aside>
          </div>
        </div>
        <!-- Sidebar -->

      </div>


      <div class="col-lg-7 col-md-7 r-full-width">
        <!-- add Banner -->
        <div class="add-banner text-center post-widget p-0">
          <img src="<?php the_field('promo_image'); ?>" alt="promo">
        </div>
        <!-- add Banner -->
      </div>
      <div class="col-lg-3 col-md-5 custom-re">
        <!-- facebook widget -->
        <div class="grid-item">
          <div class="widget" style="background-color:#2C2D31">
            <h3 class="secondry-heading">Subscribe</h3>
            <div class="newsletter-form" style="padding:20px">
              <p>Your Email</p>
              <form>
                <div class="input-group m-0">
                  <span class="input-group-addon"><i class="fa fa-envelope-o"></i></span>
                  <input type="text" class="form-control" placeholder="Your Email">
                  <span class="input-group-btn">
                    <button type="submit" class="btn btn-icon">
                      <i class="fa fa-paper-plane"></i></button>
                  </span>
                </div>
              </form>
            </div>
          </div>
        </div>
        <!-- facebook widget -->
      </div>

    </div>
    <!-- Main Content Row -->
  </div>
</main>
<!-- main content -->

<?php get_footer();
