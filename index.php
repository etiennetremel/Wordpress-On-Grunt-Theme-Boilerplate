<?php get_header(); ?>

<div id="main" class="site-main row">
    <div id="primary" class="page-area col-12" role="main">
        <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
            <div class="page">
                <div class="page-header">
                    <h1 class="page-title"><?php the_title() ?></h1>
                </div>
                <div class="page-wrapper">
                    <div class="page-content">
                        <?php the_content('<p>Continue reading…</p>'); ?>
                    </div>
                </div>
            </div>
        <?php endwhile; else: ?>
            <div class="page page-404">
                <div class="page-header">
                    <h1 class="page-title">Not found</h1>
                </div>
                <div class="page-wrapper">
                    <div class="page-content">
                        <h2>This is somewhat embarrassing, isn&rsquo;t it?</h2>
                        <p>It looks like nothing was found at this location.</p>
                    </div>
                </div>
            </div>
        <?php endif; ?>
    </div><!-- #primary -->

    <?php get_sidebar(); ?>

</div><!-- #main -->

<?php get_footer(); ?>
