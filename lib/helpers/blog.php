<?php
/**
 * BLOG FEATURES
 */


/**
 * Template for comments and pingbacks.
 */
if ( ! function_exists( 'blog_comment' ) ):
    function blog_comment( $comment, $args, $depth ) {
        $GLOBALS['comment'] = $comment;
        switch ( $comment->comment_type ) :
            case 'pingback' :
            case 'trackback' :
        ?>
        <li class="post pingback">
            <p><?php _e( 'Pingback:' ); ?> <?php comment_author_link(); ?><?php edit_comment_link( __( 'Edit' ), '<span class="edit-link">', '</span>' ); ?></p>
        <?php
                break;
            default :
        ?>
        <li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
            <article id="comment-<?php comment_ID(); ?>" class="comment">
                <div class="span2">
                    <?php
                    $avatar_size = 68;
                    if ( '0' != $comment->comment_parent )
                        $avatar_size = 39;

                    echo get_avatar( $comment, $avatar_size );
                    ?>
                </div>
                <div class="span10">
                    <div class="comment-meta">
                        <div class="comment-author vcard">
                            <?php
                                /* translators: 1: comment author, 2: date and time */
                                printf( __( '%1$s on %2$s <span class="says">said:</span>' ),
                                    sprintf( '<span class="fn">%s</span>', get_comment_author_link() ),
                                    sprintf( '<a href="%1$s"><time pubdate datetime="%2$s">%3$s</time></a>',
                                        esc_url( get_comment_link( $comment->comment_ID ) ),
                                        get_comment_time( 'c' ),
                                        /* translators: 1: date, 2: time */
                                        sprintf( __( '%1$s at %2$s' ), get_comment_date(), get_comment_time() )
                                    )
                                );
                            ?>

                            <?php edit_comment_link( __( 'Edit' ), '<span class="edit-link">', '</span>' ); ?>
                        </div><!-- .comment-author .vcard -->

                        <?php if ( $comment->comment_approved == '0' ) : ?>
                            <em class="comment-awaiting-moderation"><?php _e( 'Your comment is awaiting moderation.' ); ?></em>
                            <br />
                        <?php endif; ?>

                    </div>

                    <div class="comment-content"><?php comment_text(); ?></div>

                    <div class="reply">
                        <?php comment_reply_link( array_merge( $args, array( 'reply_text' => __( 'Reply <span>&darr;</span>' ), 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
                    </div><!-- .reply -->
                </div>
            </article><!-- #comment-## -->

        <?php
                break;
        endswitch;
    }
endif; // ends check for blog_comment()


/**
 * Prints HTML with meta information for the current post-date/time and author.
 */
if ( ! function_exists( 'blog_posted_on' ) ):
    function blog_posted_on() {
        $utility_text = '<span class="%1$s">Posted </span> %2$s %3$s';

        $date = sprintf( 'on <a href="%1$s" title="%2$s" rel="bookmark"><time class="entry-date" datetime="%3$s">%4$s</time></a>',
            esc_url( get_permalink() ),
            esc_attr( get_the_time() ),
            esc_attr( get_the_date( 'c' ) ),
            esc_html( get_the_date() )
        );

        $author = sprintf( 'by <span class="author vcard"><a class="url fn n" href="%1$s" title="%2$s" rel="author">%3$s</a></span>',
            esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
            esc_attr( sprintf( 'View all posts by %s', 'blog', get_the_author() ) ),
            get_the_author()
        );

        printf(
            $utility_text,
            'meta-prep',
            $date,
            $author
        );
    }
endif;


/**
 * Prints HTML with meta information for the current post (category, tags and permalink).
 */
if ( ! function_exists( 'blog_posted_in' ) ):
    function blog_posted_in() {
        // Retrieves tag list of current post, separated by commas.
        $tag_list = get_the_tag_list( '', ', ' );
        if ( $tag_list ) {
            $posted_in = __( 'This entry was posted in %1$s and tagged %2$s. Bookmark the <a href="%3$s" title="Permalink to %4$s" rel="bookmark">permalink</a>.', 'blog' );
        } elseif ( is_object_in_taxonomy( get_post_type(), 'category' ) ) {
            $posted_in = __( 'This entry was posted in %1$s. Bookmark the <a href="%3$s" title="Permalink to %4$s" rel="bookmark">permalink</a>.', 'blog' );
        } else {
            $posted_in = __( 'Bookmark the <a href="%3$s" title="Permalink to %4$s" rel="bookmark">permalink</a>.', 'blog' );
        }

        // Prints the string, replacing the placeholders.
        printf(
            $posted_in,
            get_the_category_list( ', ' ),
            $tag_list,
            get_permalink(),
            the_title_attribute( 'echo=0' )
        );
    }
endif;


/**
 * Displays navigation to next/previous pages when applicable.
 */
if ( ! function_exists( 'blog_content_nav' ) ):
    function blog_content_nav( $html_id ) {
        global $wp_query;

        $html_id = esc_attr( $html_id );

        if ( $wp_query->max_num_pages > 1 ) : ?>
            <nav id="<?php echo $html_id; ?>" class="navigation" role="navigation">
                <div class="nav-previous alignleft"><?php next_posts_link( __( '<span class="meta-nav">&larr;</span> Older posts', 'blog' ) ); ?></div>
                <div class="nav-next alignright"><?php previous_posts_link( __( 'Newer posts <span class="meta-nav">&rarr;</span>', 'blog' ) ); ?></div>
            </nav><!-- #<?php echo $html_id; ?> .navigation -->
        <?php endif;
    }
endif;
?>