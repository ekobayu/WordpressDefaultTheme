<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
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
								<?php while (have_posts()) : the_post(); wpb_set_post_views(get_the_ID()); ?>
                                
                                <!-- blog artical -->
                                <article class="post">
                                    
                                    <!-- blog pot thumb -->
                                    <div class="post-thumb"> 
                                        <?php the_post_thumbnail(array(923,536)) ?>
                                        <span class="post-badge"><?php foreach((get_the_category()) as $category) { echo $category->cat_name . ' '; } ?></span>
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
                                                    <ul class="post-meta">
                                                        <li><i class="fa fa-clock-o"></i><?php echo get_the_time('j F Y', $id); ?></li>
                                                        <li><i class="fa "></i><?php the_category(', ') ?></li>
                                                    </ul>
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

                            <!-- Slider Widget -->
                            <div class="post-widget">

                                <!-- Heading -->
                                <div class="primary-heading">
                                    <h2>Related Posts</h2>
                                </div>
                                <!-- Heading -->

                                <!-- post slider -->
                                <div class="light-shadow gray-bg p-30"> 
                                    <div id="post-slider-2">
										
									    <?php 
									    global $post;
									    $postid = $post->ID;
									    $categories = get_the_category($post->ID);
				
								        $category_ids = array();
								          foreach($categories as $individual_category) $category_ids[] = $individual_category->term_id;
								          $args=array(
								          'category__in' => $category_ids,
								          'post__not_in' => array($post->ID),
								          'posts_per_page'=> 6,
								          'caller_get_posts'=>1
								          );

								        $my_query = new wp_query( $args );
									    while ( $my_query->have_posts() ) : the_post(); $my_query->the_post(); ?>
                                        <!-- post -->
                                        <div class="post style-1">

                                            <!-- thumbnail -->
                                            <div class="post-thumb"> 
                                                <?php the_post_thumbnail(array(268,185)) ?>
                                                <span class="post-badge"><?php foreach((get_the_category()) as $category) { echo $category->cat_name . ' '; } ?></span>

                                                <!-- post thumb hover -->
                                                <div class="thumb-hover">
                                                    <div class="position-center-center">
                                                        <a href="<?php the_permalink() ?>" class="fa fa-link"></a>
                                                    </div>
                                                </div>
                                                <!-- post thumb hover -->
                                            </div>
                                            <!-- thumbnail -->
                                            <div class="post-content">
                                                <ul class="post-meta">
                                                    <li><i class="fa fa-user"></i><?php the_author(); ?></li>
                                                    <li><i class="fa fa-clock-o"></i><?php echo get_the_time('j F Y', $id); ?></li>
                                                </ul>
                                                <h5 class="m-0"><a href="<?php the_permalink() ?>"><?php the_title() ?></a></h5>
                                            </div>
                                        </div>
                                        <!-- post -->
										<?php endwhile; wp_reset_query();?>

                                    </div>
                                </div>
                                <!-- post slider -->

                            </div>
                            <!-- Slider Widget -->

                            <!-- comments area -->
                            <div class="comments-area mb-30">
                               
                                <!-- Heading -->
                                <div class="primary-heading">
                                    <h2><?php echo $count = count( get_comments( array( 'post_id' => $postid ) ) ); ?> comments</h2>
                                </div>
                                <!-- Heading -->

                                <div class="comment-holder p-30 light-shadow white-bg">
                                    <!-- comment list -->
                                    <ul class="comment-list font-roboto">
										
										<?php 
										    $args = array(
										        'number'=>20,
										        'offset'=>0,
										        'status'=>'all',
										        'post_id' => $postid,
										    );
										    foreach (get_comments($args) as $comment) {
										?>

                                        <!-- .comment -->
                                        <li class="comment-wrap">
                                            <!-- .comment thumb -->
                                            <div class="comment-thumb">
                                                <?php echo get_avatar( $comment, 96 ); ?>
                                            </div>
                                            <!-- .comment thumb -->

                                            <div class="comment-body">
                                                <!-- .comment-auther -->
                                                <a class="comment-author" rel="external nofollow" href="<?php the_permalink() ?>"><?php echo $comment->comment_author; ?></a>
                                                <!-- .comment-auther -->

                                                <div class="comment-content">
                                                    <p><?php echo $comment->comment_content; ?></p>
                                                </div>
                                                 <!-- .comment-meta -->
                                                <header class="comment-meta">
                                                    <ul class="post-meta">
                                                        <li><i class="fa fa-clock-o"></i><?php comment_date('F j Y'); ?></li>
                                                    </ul>   
                                                </header> 
                                                 <!-- .comment-meta -->  
                                            </div>

                                        </li>
                                        <!-- .comment -->
										
										<?php } ?>


                                    </ul>
                                    <!-- comment list -->
                                </div>
                            </div>
                            <!-- comments area -->

                            <!-- comment form -->
                            <div class="comment-form">
                                <div class="primary-heading">
                                    <h2>leave your comments</h2>
                                </div>
                                 <div class="row">
                                 	<?php $comment_args = array( 'title_reply'=>'Got Something To Say:',

									'fields' => apply_filters( 'comment_form_default_fields', array(

									'author' => '<div class="col-md-12"><div class="form-group">' . '<label for="author">' . __( 'Your Good Name<span>*</span>' ) . '</label> ' . ( $req ? '<span>*</span>' : '' ) .

									     '<input id="author" name="author" type="text" class="form-control" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30"' . $aria_req . ' /></div></div>',   

									'email'  => '<div class="col-md-12"><div class="form-group">' .

									            '<label for="email">' . __( 'Your Email Please<span>*</span>' ) . '</label> ' .

									                ( $req ? '<span>*</span>' : '' ) .

									                '<input id="email" name="email" type="email" class="form-control" value="' . esc_attr(  $commenter['comment_author_email'] ) . '" size="30"' . $aria_req . ' />'.'</div></div>',

									'url'    => '' ) ),

									'comment_field' => '<div class="col-md-12"><div class="form-group">' .

									                '<label for="comment">' . __( 'Let us know what you have to say:' ) . '</label>' .

									                '<textarea id="comment" name="comment" cols="45" rows="8" aria-required="true" class="form-control" ></textarea>' .

									                '</div></div>',

									'comment_notes_after' => '',

									'label_submit' => __( 'Leave Comment' ),

									'submit_button' => '<div class="col-md-12">
							            <input name="%1$s" type="submit" id="%2$s" class="btn red full-width" value="%4$s" />
							        </div>'

									);

									comment_form($comment_args); ?>

                                </div>
                            </div>
                            <!-- comment form -->
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