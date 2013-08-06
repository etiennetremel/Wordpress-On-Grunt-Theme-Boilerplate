<?php
/**
 * NAVIGATION HELPERS
 * Walkers and navigation helpers should be defined in this file
 */


/**
 * Inline Menu
 * Display menu as inline separaded by $separator (remove list bullet)
 * @param  string  $theme_location Theme location label
 * @param  integer $depth          Menu level to fetch
 * @param  string  $separator      Separator ie: an image tag, or a pipe '|'
 */
if ( ! function_exists( 'wp_nav_menu_inline' ) ):
    function wp_nav_menu_inline( $theme_location, $depth = 1, $separator = '&nbsp;|&nbsp;' ) {
        $args = array (
            'theme_location'    => $theme_location,
            'container'         => false,
            'echo'              => 0,
            'depth'             => $depth
        );
        $menu = wp_nav_menu( $args );

        $pattern = '/<li[^>]*>[^<]*(<a[^>]*>[^<]+<\/a>)[^<]*<\/li>/is';
        preg_match_all( $pattern, $menu, $matches );
        $subnav = implode( $matches[1], $separator );

        echo $subnav;
    }
endif;
?>