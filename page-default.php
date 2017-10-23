<?php
/**
 * Template Name: Default
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
    <main class="main-wrap"> 
        <div class="container">
            <div class="theme-padding">

                <!-- Heading -->
               <div class="primary-heading">
                    <h2><?php the_title(); ?></h2>
                </div>
                <!-- Heading -->

                <!-- contact holder -->
                <div class="row">

                    <!-- contact form -->
                    <div class="col-md-8">
                        <!-- contact form -->
                        <?php echo apply_filters('the_content',$wp_query->post->post_content);?>
                        <!-- contact form -->
                    </div>

                    <!-- address information -->
                    <div class="col-md-4">
                        <div class="contact-info">
                            <ul>
                                <li><h5><?php the_field('company_name'); ?></h5></li>
                                <li>
                                    <h5>Office Address</h5>
                                    <p><?php the_field('office_address'); ?></p>
                                </li>

                                <li>
                                    <h5>Email Address</h5>
                                    <p><?php the_field('email_address'); ?></p>
                                </li>

                                <li>
                                    <h5>Phone Numbers</h5>
                                    <p><?php the_field('phone_number'); ?></p>
                                </li>

                                <li>
                                    <h5>Whatsapp</h5>
                                    <p><?php the_field('whatsapp'); ?></p>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <!-- address information -->

                </div>
                <!-- contact holder -->

            </div>
        </div>

        <!-- contact map -->
        <div class="map-holder">
            <div id="map"><?php the_field('map'); ?></div>
        </div>
        <!-- contact map -->

    </main>
    <!-- main content -->

<?php get_footer();