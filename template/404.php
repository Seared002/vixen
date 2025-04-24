<?php
get_header(); ?>

<div class="container">
    <h1><?php esc_html_e( 'Page Not Found', 'vixen' ); ?></h1>
    <p><?php esc_html_e( 'Sorry, the page you are looking for does not exist.', 'vixen' ); ?></p>
    <a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php esc_html_e( 'Return to Home', 'vixen' ); ?></a>
</div>

<?php get_footer(); ?>