<?php
/**
 * Include heavy features
 */
include_once( get_template_directory() . '/lib/autoload.php' );


/**
 * Theme init
 */
function theme_setup_init() {
    // Register theme features
    add_theme_support( 'menus' );
    add_theme_support( 'post-thumbnails' );

    // Register Menu Location
    register_nav_menu( 'primary', __( 'Primary Menu' ) );
    register_nav_menu( 'footer', __( 'Footer Menu' ) );
}
add_action( 'after_setup_theme', 'theme_setup_init' );


/**
 * Register sidebars
 */
function register_theme_sidebars() {
    // Blog Sidebar
    register_sidebar(array(
        'name' => 'Sidebar',
        'before_widget' => '<div id="%1$s" class="wrapper %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h2>',
        'after_title' => '</h2>',
    ));

    // Bottom Sidebar
    register_sidebar(array(
        'name' => 'Bottom',
        'before_widget' => '<div id="%1$s" class="wrapper %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h2>',
        'after_title' => '</h2>',
    ));
}
add_action( 'widgets_init', 'register_theme_sidebars' );


/**
 * Load Front-end script
 */
function load_theme_script() {
    // Enqueue default CSS
    wp_register_style( 'default_style', get_stylesheet_directory_uri().'/style.css', null, '1.0', 'all' );
    wp_enqueue_style( 'default_style' );

    // Enqueue Vendor
    wp_enqueue_script(
        'theme-vendor-script',
        get_template_directory_uri() . '/assets/javascripts/vendor.min.js',
        array('jquery')
    );

    // Enqueue Script
    wp_enqueue_script(
        'theme-script',
        get_template_directory_uri() . '/assets/javascripts/script.min.js',
        array('jquery', 'theme-vendor-script')
    );

    // Add URL + Nonce for Ajax requests
    wp_localize_script( 'theme-script', 'ajax_var', array(
        'url'   => admin_url( 'admin-ajax.php' ),
        'nonce' => wp_create_nonce( 'ajax-nonce' )
    ));
}
add_action('wp_enqueue_scripts', 'load_theme_script');


/**
 * Remove admin tabs we don't want to appear
 */
/*add_action( 'admin_menu', 'remove_admin_menus' );
function remove_admin_menus() {
    if ( ! function_exists('remove_menu_page') )
        return;

    //Post Menu
    remove_menu_page('edit.php');
    //Comments Menu
    remove_menu_page('edit-comments.php');
}*/


/**
 * Remove default image with and height attributes
 */
function remove_image_dimension_attribute( $html ) {
    return preg_replace( '/(height|width)="\d*"\s/', '', $html );
}
add_filter( 'get_image_tag', 'remove_image_dimension_attribute', 10 );
add_filter( 'image_send_to_editor', 'remove_image_dimension_attribute', 10 );
add_filter( 'post_thumbnail_html', 'remove_image_dimension_attribute', 10 );


/**
 * Remove Wordpress login form logo
 */
function remove_wordpress_login_logo() {
    echo '<style type="text/css">h1 a { background-image: none !important; }</style>';
}
add_action( 'login_head', 'remove_wordpress_login_logo' );


/**
 * Disable admin top bar for non administrators
 */
if ( ! current_user_can( 'manage_options' ) )
    remove_action( 'init', '_wp_admin_bar_init' );


/**
 * Remove the WordPress Logo from the WordPress Admin Bar
 */
function admin_bar_remove_wp_logo() {
    global $wp_admin_bar;
    $wp_admin_bar->remove_menu( 'wp-logo' );
}
add_action( 'wp_before_admin_bar_render', 'admin_bar_remove_wp_logo' );


/**
 * Cleanup header meta tags
 */
remove_action( 'wp_head', 'feed_links_extra', 3 );
remove_action( 'wp_head', 'feed_links', 2  );
remove_action( 'wp_head', 'rsd_link' );
remove_action( 'wp_head', 'wlwmanifest_link' );
remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head' );
remove_action( 'wp_head', 'wp_shortlink_wp_head' );


/**
 * Remove version number from header and RSS feed
 */
remove_action( 'wp_head', 'wp_generator' ); // Remove WordPress version number
foreach ( array( 'rss2_head', 'commentsrss2_head', 'rss_head', 'rdf_header', 'atom_head', 'comments_atom_head', 'opml_head', 'app_head' ) as $action ) {
    remove_action( $action, 'the_generator' );
}


/**
 * Remove script versioning from static resources
 */
function remove_wp_version_from_files( $src ) {
    $parts = explode('?', $src);
    return $parts[0];
}
add_filter( 'script_loader_src', 'remove_wp_version_from_files', 15, 1 );
add_filter( 'style_loader_src', 'remove_wp_version_from_files', 15, 1 );


/**
 * Stop file editing
 */
define ( 'DISALLOW_FILE_EDIT', true );


/**
 * Deactivate theme updates
 */
function deactivate_theme_update( $r, $url ) {
    if ( 0 !== strpos( $url, 'http://api.wordpress.org/themes/update-check' ) )
        return $r;
    $themes = unserialize( $r['body']['themes'] );
    unset( $themes[ get_option( 'template' ) ] );
    unset( $themes[ get_option( 'stylesheet' ) ] );
    $r['body']['themes'] = serialize( $themes );
    return $r;
}
add_filter( 'http_request_args', 'deactivate_theme_update', 5, 2 );


/**
 * Remove unwanted dashboard widgets
 */
function clean_dashboard_widgets() {
    global $wp_meta_boxes;
    unset( $wp_meta_boxes['dashboard']['normal']['core']['dashboard_incoming_links'] );
    unset( $wp_meta_boxes['dashboard']['normal']['core']['dashboard_plugins'] );
    unset( $wp_meta_boxes['dashboard']['side']['core']['dashboard_primary'] );
    unset( $wp_meta_boxes['dashboard']['side']['core']['dashboard_secondary'] );
}
add_action( 'wp_dashboard_setup', 'clean_dashboard_widgets' );


/**
 * Remove default link for images
 */
function remove_default_image_link() {
    $image_set = get_option( 'image_default_link_type' );
    if ($image_set !== 'none')
        update_option( 'image_default_link_type', 'none' );
}
add_action( 'admin_init', 'remove_default_image_link', 10 );


/**
 * Remove default & useless contact methods
 */
function remove_default_contact_method( $type ) {
    unset( $type['aim'] );
    unset( $type['yim'] );
    unset( $type['jabber'] );
    return $type;
}
add_filter( 'user_contactmethods', 'remove_default_contact_method', 10, 1 );
?>