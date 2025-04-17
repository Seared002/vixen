<?php
get_header(); ?>

<div class="container">
    <h1><?php printf( esc_html__( 'Search Results for: %s', 'vixen' ), get_search_query() ); ?></h1>
    <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
        <article>
            <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
            <p><?php the_excerpt(); ?></p>
        </article>
    <?php endwhile; else: ?>
        <p><?php esc_html_e( 'No results found.', 'vixen' ); ?></p>
    <?php endif; ?>
</div>

<?php get_footer(); ?>