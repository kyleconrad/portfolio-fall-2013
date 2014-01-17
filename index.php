<?php get_header(); ?>

<section id="front-page" class="padded ajax front-page">

    <?php if (have_posts()) : ?>
    <?php while (have_posts()) : the_post(); ?>

    <article id="<?php echo $post->post_name;?>" class="post-listing" data-post-color="<?php echo get_post_meta($post->ID, 'color', true); ?>">
        <span class="front-year"><?php the_time('Y') ?></span>

        <a href="<?php the_permalink(); ?>" class="needsclick"><h2><?php the_title(); ?></h2></a>

        <span class="front-category">
            <?php
            // Get a list of terms for this post's custom taxonomy.
            $project_cats = get_the_category();
            // Renumber array.
            $project_cats = array_values($project_cats);
            for($cat_count=0; $cat_count<count($project_cats); $cat_count++) {
                // Each array item is an object. Display its 'name' value.
                echo $project_cats[$cat_count]->name;
                // If there is more than one term, comma separate them.
                if ($cat_count<count($project_cats)-1){
                    echo ', ';
                }
            }
            ?>
        </span>

        <a href="<?php the_permalink(); ?>" class="front-post-link needsclick" style="background-image: url('<?php $image_id = get_post_thumbnail_id(); $image_url = wp_get_attachment_image_src($image_id,'front-banner', true); echo $image_url[0];  ?>');"></a>
    </article>

    <?php endwhile; ?>
    <?php else: ?>
    <?php endif; ?>

</section>

<?php get_footer(); ?>