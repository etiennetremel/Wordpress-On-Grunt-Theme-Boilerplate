<?php
/**
 * POSTS ARCHIVES
 */
?>

<?php get_header(); ?>

<div id="main" class="site-main row">
    <div id="primary" class="blog-area span8" role="main">
    <?php if ( have_posts() ) : ?>
        <?php if ( is_home() || is_archive() ): ?>
            <h1>Blog</h1>
        <?php endif; ?>

        <?php /* Display navigation to next/previous pages when applicable */ ?>
        <?php blog_content_nav( 'nav-above' ); ?>

        <?php while ( have_posts() ) : the_post(); ?>

            <div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                <div class="content">
                    <?php if ( is_single() ): ?>
                        <h1><a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'blog' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php the_title(); ?></a></h1>
                    <?php else: ?>
                        <h2><a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'blog' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php the_title(); ?></a></h2>
                    <?php endif; ?>

                    <div class="entry-meta">
                        <?php blog_posted_on(); ?>
                    </div>

                    <?php if ( is_search() || is_archive() ) : // Only display excerpts for archives and search. ?>
                        <div class="entry-summary">
                            <?php the_excerpt(); ?>
                        </div>
                    <?php else : ?>
                        <div class="entry-content">
                            <?php if ( has_post_thumbnail() ) : ?>
                            <p><?php the_post_thumbnail('medium', array('class' => "alignright")); ?></p>
                            <?php endif; ?>
                            <?php the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'blog' ) ); ?>
                            <?php wp_link_pages( array( 'before' => '<div class="page-link">' . __( 'Pages:', 'blog' ), 'after' => '</div>' ) ); ?>
                        </div>
                    <?php endif; ?>

                    <div class="entry-utility">
                        <?php if ( count( get_the_category() ) ) : ?>
                            <span class="cat-links">
                                <?php printf( __( '<span class="%1$s">Posted in</span> %2$s', 'blog' ), 'entry-utility-prep entry-utility-prep-cat-links', get_the_category_list( ', ' ) ); ?>
                            </span>
                        <?php endif; ?>

                        <?php $tags_list = get_the_tag_list( '', ', ' ); ?>
                        <?php if ( $tags_list ): ?>
                            <span class="meta-sep">|</span>
                            <span class="tag-links">
                                <?php printf( __( '<span class="%1$s">Tagged</span> %2$s', 'blog' ), 'entry-utility-prep entry-utility-prep-tag-links', $tags_list ); ?>
                            </span>
                        <?php endif; ?>
                        <div class="clear"></div>
                        <span class="comments-link"><?php comments_popup_link( __( 'Leave a comment', 'blog' ), __( '1 Comment', 'blog' ), __( '% Comments', 'blog' ) ); ?></span>
                        <?php edit_post_link( __( 'Edit', 'blog' ), '<span class="meta-sep">|</span> <span class="edit-link">', '</span>' ); ?>
                    </div>
                </div>
            </div><!-- .post -->

            <?php comments_template(); ?>

        <?php endwhile; // End the loop ?>

        <?php /* Display navigation to next/previous pages when applicable */ ?>
        <?php blog_content_nav( 'nav-below' ); ?>
    </div><!-- #primary -->

    <?php endif; ?>

    <?php get_sidebar( 'blog' ); ?>
</div><!-- #main -->

<?php get_footer(); ?>
