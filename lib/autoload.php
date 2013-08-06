<?php
    /**
     * DEFINE GLOBALS
     */
    if ( ! defined( "TP_DIRECTORY" ) )
        define( 'TP_DIRECTORY', dirname(__FILE__) );

    if ( ! defined( "TP_BASE" ) )
        define( 'TP_BASE', get_template_directory_uri() . '/' . basename( dirname( __FILE__) ) );

    if ( ! defined( "TP_PLUGIN_DIRECTORY_WWW" ) )
        define( 'TP_PLUGIN_DIRECTORY_WWW', TP_BASE . '/plugins' );

    if ( ! defined( "TP_LIB_DIRECTORY_WWW" ) )
        define( 'TP_LIB_DIRECTORY_WWW', TP_BASE . '/lib' );


    /**
     * AUTOLOAD CLASSES FROM /lib
     */
    function autoload_lib( $class ) {
        $class = str_replace( '_', '-', strtolower( $class ) );
        $class_file = TP_DIRECTORY . '/lib/class-' . $class . '.php';

        if ( file_exists( $class_file ) )
            require_once $class_file;
    }
    spl_autoload_register( 'autoload_lib' );


    /**
     * AUTOLOAD PLUGINS from /plugins
     */
    $plugin_path = TP_DIRECTORY . DIRECTORY_SEPARATOR . 'plugins';
    if ( $handle = opendir( $plugin_path ) ) {
        while ( false !== ( $name = readdir( $handle ) ) ) {
            if ( is_dir( $plugin_path . DIRECTORY_SEPARATOR . $name ) ) {
                $plugin_file = $plugin_path . DIRECTORY_SEPARATOR . $name . DIRECTORY_SEPARATOR . $name . '.php';
                if ( file_exists( $plugin_file ) ) {
                    $plugin_name = str_replace( ' ', '_', ucwords( str_replace( '-', ' ', $name ) ) );
                    include_once $plugin_file;
                    new $plugin_name();
                }
            }
        }
        closedir( $handle );
    }

    /**
     * AUTOLOAD HELPERS
     */
    $helper_path = TP_DIRECTORY . DIRECTORY_SEPARATOR . 'helpers';
    if ( $handle = opendir( $helper_path ) ) {
        while ( false !== ( $name = readdir( $handle ) ) ) {
            if ( preg_match('/.+\.php/', $name ) )
                require_once $helper_path . DIRECTORY_SEPARATOR . $name;
        }
        closedir( $handle );
    }
?>