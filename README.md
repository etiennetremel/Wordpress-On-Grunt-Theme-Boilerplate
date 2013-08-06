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