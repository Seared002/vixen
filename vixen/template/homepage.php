<?php
get_header(); ?>

<div class="container">
    <h1><?php esc_html_e( 'Welcome to Vixen Theme', 'vixens' ); ?></h1>
    <p><?php esc_html_e( 'This is your custom homepage.', 'vixens' ); ?></p>
</div>
<?php
    $args = array('post_type' => 'post', 'post_status' => 'publish',  'posts_per_page' => 5, 'orderby'   => 'rand');
    $loop = new WP_Query($args);
    if($loop->have_posts()):
    while ($loop->have_posts()) : $loop->the_post();
?>

<li>
    <a class="img-p" href="<?php the_permalink(); ?>">
        <?php
            if(has_post_thumbnail()) {
            $featured_img_url = get_the_post_thumbnail_url(get_the_ID(),'full');
            $thumbnail_id = get_post_thumbnail_id( $post->ID );
            $alt = get_post_meta($thumbnail_id, '_wp_attachment_image_alt', true);
        ?>
        <img src="<?php echo $featured_img_url; ?>" alt="<?php echo $alt; ?>" width="" height=""/>
        <?php } ?>
    </a>
    <div class="recent-info">
        <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
        <span class="date-info"><?php the_date(); ?></span>
    </div>
</li>
<?php endwhile; endif; wp_reset_query(); ?>
<?php get_footer(); ?>