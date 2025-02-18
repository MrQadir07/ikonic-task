<?php get_header(); ?>

<div class="projects-archive">
    <?php if (have_posts()) : ?>
        <div class="projects-list">
            <?php while (have_posts()) : the_post(); ?>
                <div class="project-item">
                    <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                    <div class="project-excerpt"><?php the_excerpt(); ?></div>
                </div>
            <?php endwhile; ?>
        </div>

        <div class="pagination">
            <?php
            echo paginate_links([
                'prev_text' => __('« Prev'),
                'next_text' => __('Next »'),
            ]);
            ?>
        </div>
    <?php else : ?>
        <p><?php _e('No projects found.'); ?></p>
    <?php endif; ?>
</div>

<?php get_footer(); ?>
