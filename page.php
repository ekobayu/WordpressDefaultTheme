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

 	<!-- Main Content -->
    <main class="main-wrap" id="post-detail"> 
        <div class="theme-padding">
            <div class="container">
                <div class="row">

                    <div class="col-md-9 col-sm-8">
                        <div class="content">

                            <!-- blog detail -->
                            <div class="post-widget light-shadow white-bg">
								<?php while (have_posts()) : the_post(); ?>

                                <!-- blog artical -->
                                <article class="post">
                                    
                                    <!-- blog pot thumb -->
                                    <div class="post-thumb"> 
                                        <?php the_post_thumbnail(array(923,536)) ?>
                                    </div>
                                    <!-- blog pot thumb -->

                                    <!-- post detail -->
                                    <div class="post-info p-30">

                                        <!-- title -->
                                        <h3><?php the_title() ?></h3>
                                        <!-- title -->

                                        <!-- Post meta -->
                                        <div class="post_meta_holder">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <!-- post meta -->
                                                    <!-- <ul class="post-meta">
                                                        <li><i class="fa fa-user"></i><?php the_author(); ?></li>
                                                        <li><i class="fa fa-clock-o"></i><?php echo get_the_time('j F Y', $id); ?></li>
                                                        <li><i class="fa "></i><?php the_category(', ') ?></li>
                                                    </ul> -->
                                                    <!-- post meta -->
                                                </div>
                                                
                                            </div>
                                        </div>
                                        <!-- Post meta -->
                                        <!-- post description -->
                                        <div class="post-desc">
                                            <?php the_content(); ?>
                                        </div>
                                        <!-- post description -->

                                        <!-- tags and social icons -->
                                        <div class="row mb-20">

                                            <!-- populer tags --> 
                                            <div class="col-md-6">
                                                <div class="blog-tags font-roboto">
                                                   <?php the_tags( '<ul><li>', '</li><li>', '</li></ul>' ); ?>
                                                </div>
                                            </div>
                                            <!-- populer tags --> 

                                            <!-- social icons --> 
                                            <!-- <div class="col-md-6">
                                                <div class="blog-social">
                                                     <span class="share-icon btn-social-icon btn-adn"  data-toggle="tooltip" data-placement="top" title="Sharing is Caring">
                                                            <span class="fa fa-share-alt"></span>
                                                        </span>
                                                    <ul>
                                                        <li>
                                                            <a class="btn-social-icon btn-facebook" href="#"  data-toggle="tooltip" data-placement="top" title="Share of Facebook">
                                                                <span class="fa fa-facebook"></span>
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <a class="btn-social-icon btn-twitter" href="#"  data-toggle="tooltip" data-placement="top" title="Post on Twitter">
                                                                <span class="fa fa-twitter"></span>
                                                            </a>
                                                        </li>
                                                     </ul>                                                   
                                                </div>
                                            </div> -->
                                            <!-- social icons --> 

                                        </div>
                                        <!-- tags and social icons -->

                                    </div>

                                    <!-- post detail -->

                                </article>
                                <!-- blog artical -->
                                <?php endwhile; ?>

                            </div>
                            <!-- blog detail -->


                        </div>
                    </div>

                    <!-- Sidebar -->
                    <div class="col-md-3 col-sm-4">
                        <aside class="side-bar">
							
							<!-- Catogires widget -->
                            <div class="widget">
                                <h3 class="secondry-heading">categories</h3>
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

                            <!-- Sidebar -->
                            <aside class="side-bar grid">
                                <!-- facebook widget -->
                                <div class="grid-item r-full-width">
                                    <div class="widget">
                                        <h3 class="secondry-heading"><a href="https://twitter.com/MicrocleanID">Twitter Feed</a></h3>
                                        <div class="feed">
                                            <?php echo do_shortcode("[custom-twitter-feeds]"); ?>
                                        </div>
                                    </div>
                                </div>
                                <!-- facebook widget -->
                                <!-- twitter widget -->
                                <div class="grid-item r-full-width">
                                    <div class="widget">
                                        <h3 class="secondry-heading"><a href="https://www.facebook.com/MicrocleanID/">Facebook Feed</a></h3>
                                        <div class="feed">
                                            <?php echo do_shortcode("[custom-facebook-feed]"); ?>
                                        </div>
                                    </div>
                                </div>
                                <!-- twitter widget -->
                            </aside>
                            <!-- Sidebar -->


                        </aside>
                    </div>
                    <!-- Sidebar -->

                </div>
            </div>
            <!-- Content -->
        </div>       
    </main>
    <!-- main content -->

<?php get_footer();