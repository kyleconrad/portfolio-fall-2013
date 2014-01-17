<?php get_header(); ?>

<?php if (have_posts()) : ?>
<?php while (have_posts()) : the_post(); ?>

<article id="about" class="padded single-page ajax" data-post-title="<?php the_title(); ?>" data-post-color="<?php echo get_post_meta($post->ID, 'color', true); ?>">
    <div class="info-box">

        <h2><?php the_title(); ?></h2>

        <hr>

        <?php the_content(); ?>
    </div>
</article>

<?php endwhile; ?>
<?php else: ?>

<article id="taken" class="padded single-page ajax" data-post-color="#1c6684">
    <div class="info-box">

        <h2>This page has been taken.</h2>

        <hr>

        <p>I don't know who you are. I don't know what you want. If you are looking for ransom, I can tell you I don't have money. But what I do have are a very particular set of skills; skills I have acquired over a very long career. Skills that make me the perfect designer for a person like you. Maybe you should head on back <a href="<?php bloginfo('url');?>">home</a> to see why?</p>
    </div>
</article>

<?php endif; ?>

<?php get_footer(); ?>