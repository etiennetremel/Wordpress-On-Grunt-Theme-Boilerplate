<?php get_header(); ?>

<div id="main" class="site-main row">
    <div id="primary" class="content-area span12" role="main">
       <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
            <div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                <div class="page-header">
                    <h1 class="page-title"><?php the_title() ?></h1>
                </div>
                <div class="page-wrapper">
                    <div class="page-content">
                        <?php the_content('<p>Continue reading…</p>'); ?>
                    </div>
                </div>
            </div>
        <?php endwhile; endif; ?>
    </div><!-- #primary -->
</div><!-- #main -->

<?php get_footer(); ?>