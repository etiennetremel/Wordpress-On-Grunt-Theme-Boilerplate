<?php
/**
 * INSERT SOCIAL SETTINGS FROM THEME SETTING PAGE IN ADMIN
 */
?>
<?php if ( function_exists( 'the_theme_setting' ) ): ?>
<?php
/**
 * FACEBOOK
 */
?>
<?php if ( get_theme_setting( 'website_thumbnail' ) ): ?>
<!-- Facebook Website Preview -->
<link rel="image_src" href="<?php the_theme_setting( 'website_thumbnail' ); ?>" />
<?php endif; ?>
<?php if ( has_post_thumbnail()) : ?>
<!-- Facebook Post Preview -->
<?php $post_thumbnail = wp_get_attachment_image_src( get_post_thumbnail_id(), 'medium' ); ?>
<meta property="og:image" content="<?php echo $post_thumbnail[0] ?>" />
<?php endif; ?>

<?php
/**
 * WINDOWS APP
 */
?>
<?php if ( get_theme_setting( 'win8_bg_color' ) ): ?>
<!-- Win8/IE10 -->
<meta name="msapplication-TileColor" content="<?php the_theme_setting( 'win8_bg_color' ); ?>" />
<?php endif; ?>
<?php if ( get_theme_setting( 'win8_icon' ) ): ?>
<meta name="msapplication-TileImage" content="<?php the_theme_setting( 'win8_icon' ); ?>" />
<?php endif; ?>
<?php
/**
 * GEO LOCALISATION
 */
?>
<meta name="DC.title" content="<?php bloginfo('name'); ?>" />
<?php if ( get_theme_setting( 'geo_region' ) ): ?>
<!-- Geo Tags -->
<meta name="geo.region" content="<?php the_theme_setting( 'geo_region' ); ?>" />
<?php endif; ?>
<?php if ( get_theme_setting( 'geo_region' ) ): ?>
<meta name="geo.placename" content="<?php the_theme_setting( 'geo_placename' ); ?>" />
<?php endif; ?>
<?php if ( get_theme_setting( 'geo_region' ) ): ?>
<meta name="geo.position" content="<?php the_theme_setting( 'geo_latitude' ); ?>;<?php the_theme_setting( 'geo_longitude' ); ?>" />
<?php endif; ?>
<?php if ( get_theme_setting( 'geo_region' ) ): ?>
<meta name="ICBM" content="<?php the_theme_setting( 'geo_latitude' ); ?>,<?php the_theme_setting( 'geo_longitude' ); ?>" />
<?php endif; ?>
<?php
/**
 * TWITTER
 */
?>
<?php if ( get_theme_setting( 'twitter_site_username' ) || get_theme_setting( 'twitter_creator_username' ) || get_theme_setting( 'website_thumbnail' ) || get_theme_setting( 'twitter_description' ) ): ?>
<meta name="twitter:card" content="summary" />
<?php endif; ?>
<?php if ( get_theme_setting( 'twitter_site_username' ) ): ?>
<meta name="twitter:site" content="<?php the_theme_setting( 'twitter_site_username' ); ?>" />
<?php endif; ?>
<?php if ( get_theme_setting( 'twitter_creator_username' ) ): ?>
<meta name="twitter:creator" content="<?php the_theme_setting( 'twitter_creator_username' ); ?>" />
<?php endif; ?>
<?php if ( get_theme_setting( 'website_thumbnail' ) ): ?>
<meta name="twitter:image" content="<?php the_theme_setting( 'website_thumbnail' ); ?>" />
<?php endif; ?>
<?php if ( get_theme_setting( 'twitter_description' ) ): ?>
<meta name="twitter:description" content="<?php the_theme_setting( 'twitter_description' ); ?>">
<?php endif; ?>
<?php if ( get_theme_setting( 'googleplus_author' ) ): ?>
<link rel="author" href="<?php the_theme_setting( 'googleplus_author' ); ?>" />
<?php endif; ?>
<?php endif; ?>