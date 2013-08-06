<?php
/**
 * BREADCRUMB GENERATOR
 * Usage: <?php if ( function_exists( 'breadcrumbs' ) ) breadcrumbs( '&nbsp; <img src="' . get_bloginfo( 'template_url' ) . '/images/arrow.gif" border="0" class="delimiter" />&nbsp;' ); ?>
 */

if ( ! function_exists( 'breadcrumbs' ) ):
    function breadcrumbs( $delimiter = '' ) {
        global $post;

        if( ! $delimiter )
            $delimiter = ' <span class="delimiter">&raquo;</span> ';

        $microdata_li       = 'itemscope itemtype="http://data-vocabulary.org/Breadcrumb"';
        $microdata_a        = 'itemprop="url"';
        $microdata_span     = 'itemprop="title"';

        echo '<ul><li ' . $microdata_li . '><a href="' . get_option('home') . '" ' . $microdata_a . '><span ' . $microdata_span . '>' . get_bloginfo('name') . '</span></a>' . $delimiter . '</li>';

        if ( is_404() ) {
            echo '<li ' . $microdata_li . ' class="active"><span ' . $microdata_span . '>404, page not found.</span></li>';
        } else {

            $current = $parent = $grandparent_get = $grandparent = '';
            if ( $post ) {
                $current            = $post->ID;
                $parent             = $post->post_parent;
                $grandparent_get    = get_post( $parent );
                $grandparent        = $grandparent_get->post_parent;
            }

            if ( is_front_page() ) {
                echo '<li ' . $microdata_li . ' class="active"><a href="' . get_option('home') . '" ' . $microdata_a . '><span ' . $microdata_span . '>Home</span></a></li>';
            } else if ( is_home() ) {
                echo '<li ' . $microdata_li . ' class="active"><a href="' . get_home_url() . '" ' . $microdata_a . '><span ' . $microdata_span . '>Blog</span></a></li>';
            } else if ( is_404() ) {
                echo '<li class="active"><a href="#"><span>404</span></a></li>';
            } else if ( is_search() ) {
                echo '<li ' . $microdata_li . ' class="active">Search results</li>';
            } else if ( is_page() ) {
                if ( $root_parent = get_the_title( $grandparent ) !== $root_parent = get_the_title( $current ) )
                    echo '<li ' . $microdata_li . '><a href="' . get_permalink( $grandparent_get->post_parent ) . '" ' . $microdata_a . '><span ' . $microdata_span . '>' . get_the_title( $grandparent ) . '</span></a> ' . $delimiter . '</li>';

                echo '<li ' . $microdata_li . ' class="active"><span ' . $microdata_span . '>' . get_the_title() . '</span></li>';
            } else if ( is_category() || is_archive() ) {
                $category = get_the_category_list( ', ' );

                if( $category ) {
                    echo '<li ' . $microdata_li . '><a href="' . get_home_url() . '" ' . $microdata_a . '><span ' . $microdata_span . '>Blog</span></a>' . $delimiter . '</li>';
                    echo '<li ' . $microdata_li . ' class="active-category"><span ' . $microdata_span . '>' . $category . '</span></li>';
                } else if ( is_archive() ) {
                    echo '<li><a>Category</a>' . $delimiter . '</li><li ' . $microdata_li . ' class="active-category"><span ' . $microdata_span . '>' . single_cat_title( '', false ) . '</span></li>';
                } else {
                    echo 'not found';
                }
            } else if ( is_single() ) {
                $categories = get_the_category();
                $output = '';
                if ( $categories ) {
                    foreach( $categories as $category )
                        $output .= '<li ' . $microdata_li . '><a href="' . get_category_link( $category->term_id ) . '" title="' . esc_attr( sprintf( __( "View all posts in %s" ), $category->name ) ) . '">' . $category->cat_name . '</a>' . $delimiter . '</li>';
                    echo trim( $output, $delimiter );
                }

                echo '<li ' . $microdata_li . ' class="active"><span ' . $microdata_span . '>' . get_the_title() . '</span></li>';
            }
        }
       echo '</ul>';
    }
endif;
?>