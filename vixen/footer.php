<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

?>
</main>
<footer id="footer">
    <div class="main-footer">
        <div class="container">
            <div class="row">
                <div class="col-md-4 col-sm-12">
                    <a class="logo-wrap" href="<?php echo site_url(); ?>" aria-labelledby="Header Logo">
                        <?php
                        // Get the logo URL from the Customizer
                        $logo_url = get_theme_mod('vyctim_logo');
                        if ($logo_url) {
                            echo '<img src="' . esc_url($logo_url) . '" alt="' . esc_attr(get_bloginfo('name')) . '">';
                        } else {
                            // Fallback logo (you can display the site title if no logo is uploaded)
                            echo '<img src="' . esc_url(get_template_directory_uri() . '/images/default-logo.png') . '" alt="' . esc_attr(get_bloginfo('name')) . '">';
                        }
                        ?>
                    </a>
                </div>
                <div class="col-md-4 col-sm-12">
                    <div class="footer-heading-text"></div>
                    <?php
                    wp_nav_menu(array(
                        'theme_location' => 'menu-2', 
                        'container' => false, 
                        'menu_class' => 'footer-menu-first',
                        'depth' => 2, 
                    ));
                    ?>  
                </div>
                <div class="col-md-4 col-sm-12"></div>
            </div>
        </div>
    </div>
    <div class="container bottom-footer">
        <div class="copyright-text">
            © <?php echo date('Y'); ?> <?php echo get_bloginfo('name'); ?> | All Rights Reserved
        </div>
    </div>
</footer>

<?php wp_footer(); ?>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"
    integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous">
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"
    integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous">
</script>
</body>

</html>