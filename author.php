<?php get_header(); ?>

<div id="main" class="site-main row">
    <div id="primary" class="author-area span12" role="main">
        <?php if ( have_posts() ) : the_post(); ?>
            <div class="page page-author">
                <div class="page-header">
                    <h1 class="page-title"><?php printf( __( 'Author: %s', 'blog' ), '<span class="vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( "ID" ) ) ) . '" title="' . esc_attr( get_the_author() ) . '" rel="me">' . get_the_author() . '</a></span>' ); ?></h1>
                </div>

                <?php
                // Author details
                if ( get_the_author_meta( 'description' ) ) : ?>
                <div id="author-info">
                    <div class="author-avatar">
                        <?php echo get_avatar( get_the_author_meta( 'user_email' ) ); ?>
                    </div>
                    <div class="author-description">
                        <h2><?php printf( __( 'About %s', 'blog' ), get_the_author() ); ?></h2>
                        <p><?php the_author_meta( 'description' ); ?></p>
                    </div>
                </div>
                <?php endif; ?>

                <?php
                // Author posts
                query_posts( array( 'author' => get_the_author_meta( "ID" ) ) );
                ?>
                <?php if ( have_posts() ) : ?>
                    <div class="author-posts">
                        <header>
                            <h2><?php echo the_author(); ?> posts</h2>
                        </header>
                        <?php while ( have_posts() ) : the_post(); ?>
                            <?php get_template_part( 'loop', 'archive' ); ?>
                        <?php endwhile; ?>
                    </div>
                <?php endif; ?>

                <?php wp_reset_query(); ?>
            </div>
        <?php endif; ?>
    </div>
    <?php get_sidebar(); ?>
</div>

<?php get_footer(); ?>
