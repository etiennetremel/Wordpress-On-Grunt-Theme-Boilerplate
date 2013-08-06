<?php get_header(); ?>

<div id="main" class="site-main row">
    <div id="primary" class="content-area span12" role="main">
       <?php while (have_posts()) : the_post(); ?>
            <div class="page page-front-page" id="post-<?php the_ID(); ?>">
                <div class="page-header">
                    <h1 class="page-title"><?php the_title() ?></h1>
                </div>
                <div class="page-wrapper">
                    <div class="page-content">
                        <?php the_content('<p>Continue reading…</p>'); ?>
                    </div>
                </div>
            </div>
        <?php endwhile; ?>
    </div><!-- #primary -->
</div><!-- #main -->

<?php get_template_part( 'partials/bottom' ); ?>

<?php get_footer(); ?>
