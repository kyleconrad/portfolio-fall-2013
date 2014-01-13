<?php get_header(); ?>

<?php if (have_posts()) : ?>
<?php while (have_posts()) : the_post(); ?>

<article id="<?php echo $post->post_name;?>" class="padded single-post ajax" data-post-title="<?php the_title(); ?>" data-post-color="<?php echo get_post_meta($post->ID, 'color', true); ?>">
    <div class="image-box" style="background-image: url('<?php $image_id = get_post_thumbnail_id(); $image_url = wp_get_attachment_image_src($image_id,'banner-image', true); echo $image_url[0];  ?>');">
        <div class="info-box">

            <h2><?php the_title(); ?></h2>

            <hr>

            <?php the_content(''); ?>

            <?php echo get_post_meta($post->ID, 'post_link', true); ?>

            <span class="post-credit">
                <strong>
                    <?php
                    $cats = get_the_category();
                    foreach($cats as $cat) {
                        if($cat->cat_ID != 1){
                        $catsArray[] = $cat->cat_name;
                        }
                    }
                    echo implode(',&nbsp;', $catsArray);
                    ?>
                </strong>
            </span>
            <span class="post-credit">
                <?php echo get_post_meta($post->ID, 'post_credits', true); ?>
            </span>
            <span class="post-year">
                <?php the_time('Y') ?>
            </span>

        </div>
    </div>

    <div class="gallery-box clearfix">
        <?php echo get_post_meta($post->ID, 'post_images', true); ?>
    </div>

    <section class="post-navigation">
        <ul>
            <li>Related Work:</li>

            <?php
            $original_post = $post;
            $tags = wp_get_post_tags($post->ID);
            if($tags)
            {
                $sendTags = array();
                foreach($tags as $tag)
                    $sendTags[] = $tag->term_id;

                $args = array(
                    'tag__in' => $sendTags,
                    'post__not_in' => array($post->ID),
                    'showposts' => 3,
                    'caller_get_posts' => 1,
                );

                $queryDb = new WP_Query($args);
                if($queryDb->have_posts())
                {
                    while ($queryDb->have_posts()) {
                        $queryDb->the_post();
                        ?>

                        <li><a href="<?php the_permalink() ?>" data-post-color="<?php echo get_post_meta($post->ID, 'color', true); ?>"><?php the_title(); ?></a></li>

                        <?php
                    }
                }
            }
            $post = $original_post;
            wp_reset_query();
            ?>
        </ul>
    </section>
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