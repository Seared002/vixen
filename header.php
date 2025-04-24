<?php
/**
 * @package Vixen
 */
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="<?php echo esc_attr( $viewport_content ); ?>">
    <link rel="profile" href="https://gmpg.org/xfn/11">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>

<?php wp_body_open(); ?>

<header id="header">
    <div class="container">
        <div class="maxwidth row">
            <div class="col-md-4 col-sm-12">
                <!-- Display the logo -->
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
            <div class="col-md-8 col-sm-12">
                <div class="row">
                    <div class="col-md-4 col-sm-12">
                        <?php get_search_form(); ?>
                    </div>
                    <div class="col-md-8 col-sm-12">
                        <?php
                        wp_nav_menu(array(
                            'theme_location' => 'menu-1', // The menu location registered in functions.php
                            'container' => false, // Don't wrap the menu in a container div
                            'menu_class' => 'header-navigation-menu', // Custom class for the menu
                            'depth' => 2, // Allow submenu items (adjust as needed)
                        ));
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>

<main>