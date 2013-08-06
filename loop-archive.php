<?php
/**
 * BLOG ARCHIVE ENTRY
 */
?>
<div class="entry clear">
    <div class="entry-header">
        <h3><a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Read %s', 'blog' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php the_title(); ?></a></h3>
    </div>
    <div class="entry-summary">
        <?php if ( has_post_thumbnail() ) : ?>
        <?php the_post_thumbnail('thumbnail', array('class' => "alignleft")); ?>
        <?php endif; ?>
        <div class="excerpt"><?php the_excerpt(); ?></div>
        <div class="entry-footer">
            <a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Read %s', 'blog' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark">Read More »</a>
        </div>
    </div>
</div>