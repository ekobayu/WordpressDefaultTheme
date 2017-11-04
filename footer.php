<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package WordPress
 * @subpackage Default
 * @since 1.0
 * @version 1.0
 */

?>
		<!-- Footer Starts -->
        <footer class="footer">

            <!-- Copyright Bar -->
            <div class="sub-footer">
                <div class="container" style="width:100%;">
                    <div class="row position-r theme-padding">
                        <!-- back To Button -->
                        <span id="scrollup" class="scrollup"><i class="fa fa-angle-up"></i></span>
                        <!-- back To Button -->
                    </div>
                    <div class="copyright-bar">
                        <p><i class="fa fa-copyright"></i><script>document.write((new Date()).getFullYear());</script> </p><a href="<?php echo get_home_url(); ?>" style="color:#7ABE0F;"> Microfiber.id</a>

                        <?php wp_nav_menu(array(
		                    'theme_location' => 'footer_menu',
		                    'container' => false,
		                )); ?>
                    </div>
                </div>
            </div>
            <!-- Copyright Bar -->

        </footer>
        <!-- Footer Starts -->

    </div>
    <!-- Wrapper -->

	<!-- Slide Menu -->
	<div id="menu" class="res-menu" role="navigation">
	    <div class="res-menu-holder">
	        <!-- logo -->
	        <div class="logo-holder">
	            <a href="<?php echo get_home_url(); ?>" class="inner-logo"></a>
	        </div>
	        <!-- logo -->
	    
	        <!-- menu -->
	        <ul class="res-nav">
	            <?php wp_nav_menu(array(
                    'theme_location' => 'mobile_menu',
                    'container' => false,
                )); ?>
	        </ul>
	        <!-- menu -->

	    </div>
	</div>
	<!-- Slide Menu -->

	<?php wp_footer()?>
</body>

</html>