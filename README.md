#Wordpress On Grunt Theme Boilerplate

## Summary

Speeds up your WordPress theme creation with Grunt.
For now, this is just a demonstration about how to use Grunt with WordPress compiling/minimizing less & javascript files.
For a better experience, you may install the free LiveReload plugin. It auto-refresh the page when a file is changed.

## Usage

1. Copy files into your wordpress themes directory (ie: "/wp-content/themes/my-custom-theme/")

2. Edit /stylesheets/main.less

3. In command line, do: `npm install && grunt` (Information about how to install grunt can be found here: [Grunt JS Website](http://gruntjs.com)

4. Make sure you have LiveReload install with your browser [Getting started with LiveReload](http://livereload.com/#getting-started)

5. That's it! Now, enjoy editing files.

## Directory Hierarchy

```
|-- assets
|   |-- fonts           // Place your font files here, *.otf, *ttf, etc.
|   |-- images          // Images should be added in this folder
|   |-- javascripts     // JS Files
|   |   |-- source
|   |   |-- vendor
|   |-- styles          // CSS & Less files
|   |   |-- source
|   |   |-- vendor
|-- lib                 // Heavy Custom WordPress features plugins files loaded via an autoload
|   |-- helpers         // Helpers such as Menu Walkers, Blog functions and Breadcrumb
|   |-- lib             // Library used with your plugins
|   |-- plugins         // Plugins
|-- partials            // Partials such as the Bottom section which can be added on different pages
```

## Usefull tools

* Icons Font: [Fontello](http://fontello.com)
* [Normalize (CSS)](https://github.com/necolas/normalize.css)
* [Twitter Bootstrap framework](http://twitter.github.io/bootstrap) is used

## Customize your theme using the "auto-loader" system

The directory `lib/plugins/` contain customized features used by your theme. By default, there is 2 plugins:
* **Image Widget**: Add image in your sidebar, can be linked to an internal or external location
* **Theme Setting**: Custom fields used for the theme, ie: social links, website thumbnail, Google Analytics, etc.

You can add your own plugin by creating a new folder and a new file with exactly the same name:
```
|-- lib
|   |-- plugins
|   |   |-- testimonials
|   |   |   |-- testimonials.php
```

Only use lowercase and dash separated words.
Then find below an example of the structure for `testimonials.php`:
```
<?php
// Class name should be Proper_Case
if ( ! class_exists( 'Testimonials' ) ) {
    class Testimonials {
        // Init
        public function __construct() {
            // Register a new custom post type for testimonials
            add_action( 'init', array( $this, 'register' ) );

            // Change default title label
            add_filter( 'enter_title_here', array( $this, 'change_title' ) );
        }

        // Register new post type
        public function register() {
            $labels = array(
                'name'                  => __( 'Testimonials' ),
                'singular_name'         => __( 'Testimonial' ),
                'add_new_item'          => __( 'Add New Testimonial' ),
                'edit_item'             => __( 'Edit Testimonial' ),
                'new_item'              => __( 'New Testimonial' ),
                'view_item'             => __( 'View Testimonial'),
                'search_items'          => __( 'Search Testimonials' ),
                'not_found'             => __( 'No Testimonials found' ),
                'not_found_in_trash'    => __( 'No Testimonials found in trash' ),
                'menu_name'             => __( 'Testimonials' )
            );

            $args = array(
                'label'                 => __( 'Testimonials' ),
                'labels'                => $labels,
                'public'                => false,
                'publicly_queryable'    => false,
                'show_ui'               => true,
                'capability_type'       => 'post',
                'hierarchical'          => false,
                'exclude_from_search'   => true,
                'supports'              => array( 'title', 'editor' )
            );

            register_post_type( 'testimonial', $args );
        }

        // Change label used for the title while editing
        public function change_title( $title ) {
            $screen = get_current_screen();
            if ( 'testimonial' == $screen->post_type )
                $title = 'Enter person/company name here';

            return $title;
        }

        /**
         * Shortcode
         * Like: [testimonial shuffle="true" number="5"]
         */
        public function shortcode( $atts ) {
            global $post;

            // Extract parameters
            extract( shortcode_atts( array(
                'shuffle'    => false,
                'number'     => -1
            ), $atts ) );

            $posts = get_posts( array(
                'posts_per_page'    => $number,
                'post_type'         => 'testimonial'
            ) );

            if ( $shuffle )
                shuffle( $posts );

            if ( $posts ): ?>
            <div class="testimonials">
                <div class="testimonial">
                <?php foreach ( $posts as $post ) : setup_postdata( $post ); ?>
                    <div class="title"><?php the_title(); ?></div>
                    <div class="content"><?php the_content(); ?></div>
                <?php endforeach; wp_reset_postdata(); ?>
                </div>
            </div>
            <?php endif; ?>
        }
    }
}
?>
```