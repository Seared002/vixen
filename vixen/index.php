<?php
get_header();

$template_part = '';

if ( is_front_page() ) {
    $template_part = 'homepage';
} elseif ( is_singular() ) {
    $template_part = 'single';
} elseif ( is_archive() || is_home() ) {
    $template_part = 'archive';
} elseif ( is_search() ) {
    $template_part = 'search';
} else {
    $template_part = '404';
}

get_template_part( 'template/' . $template_part );

get_footer();
