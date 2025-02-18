<?php
/**
 * Template Name: Test Projects Page
 * Description: A custom page template for testing projects.
 */

get_header(); ?>

<div id="primary" class="content-area">
    <main id="main" class="site-main">
        <h1>Test Page</h1>
        
        <h2>Direct Link to a Cup of Coffee</h2>
        <p><?php echo hs_give_me_coffee(); ?></p>
        
        <h2>Kanye Quotes</h2>
        <?php echo do_shortcode('[kanye_quotes]'); ?>

        <h2>Fetch Architecture Projects</h2>
        <button id="fetch-projects">Fetch Projects</button>
        <div id="projects-result"></div>
    </main><!-- .site-main -->
</div><!-- .content-area -->

<?php get_footer(); ?>
