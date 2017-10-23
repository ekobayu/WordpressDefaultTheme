<?php
/**
 * The template for displaying search results pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package WordPress
 * @subpackage Default
 * @since 1.0
 * @version 1.0
 */

get_header(); ?>

	<!-- Inner Bnner -->
    <section class="banner-parallax overlay-dark" data-parallax="scroll"> 
        <div class="inner-banner">
        	<?php if ( have_posts() ) : ?>
            <h3><?php printf( __( 'Search Results for: %s', 'microfiber' ), '<span>' . get_search_query() . '</span>' ); ?></h3>
			<?php else : ?>
            <h3><?php _e( 'Nothing Found', 'microfiber' ); ?></h3>
            <?php endif; ?>
        </div>
    </section>
    <!-- Inner Bnner -->
	
	<!-- Main Content -->
	<main class="wrapper"> 
        <div class="theme-padding">
            <div class="container">

                <!-- Main Content Row -->
                <div class="row">

                    <div class="col-md-9 col-sm-8">

                        <!-- latest list posts -->
                        <div class="post-widget m-0">
                            <!-- Post List -->
                             <div class="p-30 light-shadow white-bg">
                                <ul class="list-posts" id="catPage_listing">

                                	<?php while ( have_posts() ) : the_post(); ?>  

                                    <li>
										<div class="row">
                                        <!-- thumbnail -->
                                        <div class="col-sm-4 col-xs-5">
                                            <div class="post-thumb"> 
                                                <?php the_post_thumbnail(array(282,197)) ?>
                                                 <div class="thumb-hover">
                                                    <div class="position-center-center">
                                                        <a href="<?php the_permalink() ?>" class="fa fa-link"></a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- thumbnail -->

                                        <!-- post detail -->
                                        <div class="col-sm-8 col-xs-7">

                                            <div class="post-content">
                                                <h4><a href="<?php the_permalink() ?>"><?php the_title() ?></a></h4>
                                                <ul class="post-meta">
                                                    <li><i class="fa fa-user"></i><?php the_author(); ?></li>
                                                    <li><i class="fa fa-clock-o"></i><?php echo get_the_time('j F Y'); ?></li>
                                                </ul>
                                                <p><?php the_excerpt() ?>
												<a href="<?php the_permalink() ?>" class="read-more">read more...</a></p>
                                            </div>

                                        </div>
                                        <!-- post detail -->
										</div>
									</li>
									
									<?php endwhile; ?>
                 
                                </ul>
                            </div>
                             <!-- Post List -->

							<?php echo custom_pagination(); ?>

                        </div>
                        <!-- latest list posts -->

                    </div>

                    <!-- Sidebar -->
                    <div class="col-md-3 col-sm-4">
                        <aside class="side-bar">

    						<!-- Catogires widget -->
    						<div class="widget">
    							<h3 class="secondry-heading">Categories</h3>
    							<ul class="categories-widget">
                                    <?php
                                    $categories = get_categories( array(
                                        'orderby' => 'name',
                                        'order'   => 'ASC',
                                        'exclude'    => array( 1 ),
                                    ) );
                                     
                                    foreach( $categories as $category ) {
                                        $category_link = sprintf( 
                                            '<a href="%1$s" alt="%2$s"><em>%3$s</em>',
                                            esc_url( get_category_link( $category->term_id ) ),
                                            esc_attr( sprintf( __( '%s', 'microfiber' ), $category->name ) ),
                                            esc_html( $category->name )
                                        );
                                        $category_number = sprintf( 
                                            esc_attr( sprintf( __( '%s', 'microfiber' ), $category->category_count ) ),
                                            esc_html( $category->category_count )
                                        );
                                         
                                        echo '<li>' . sprintf( esc_html__( '%s', 'microfiber' ), $category_link ) . '';
                                        echo '<span class="bg-green">' . sprintf( esc_html__( '%s', 'microfiber' ), $category_number ) . '</span></a></li>';
                                    } ?> 
								</ul>
    						</div>
    						<!-- Catogires widget -->

    						<!-- Tags -->
    						<div class="widget">
                                <h3 class="secondry-heading">populer tags</h3>
                                <div class="populer-tags">
                                	<?php wp_tag_cloud('format=list'); ?>  
                                </div>
                            </div>
    						<!-- Tags -->
                        </aside>
                    </div>
                    <!-- Sidebar -->

                </div>   
                <!-- Main Content Row -->

            </div>
        </div>  
    </main>
    <!-- main content -->

<?php get_footer();
