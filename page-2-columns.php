<?php
/*
    Template Name: 2 Columns
 */
?>
<?php get_header(); ?>

<div id="main" class="site-main row">
    <div id="primary" class="content-area col-12" role="main">
        <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
            <div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                <div class="page-header">
                    <h1 class="page-title"><?php the_title() ?></h1>
                </div>
                <div class="page-wrapper">
                    <div class="page-content">
                        <div class="row-fluid">
                            <div class="col-6 column-1">
                                <?php the_content('<p>Continue reading…</p>'); ?>
                            </div>
                            <div class="col-6 column-2">
                                Second column, add content using a plugin, for exemple: Advanced Custom Fields (<a href="http://www.advancedcustomfields.com" target="_blank">advancedcustomfields.com</a>)
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php endwhile; endif; ?>
    </div><!-- #primary -->
</div><!-- #main -->

<?php get_footer(); ?>