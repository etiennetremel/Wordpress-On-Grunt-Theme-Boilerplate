module.exports = function(grunt) {

  // Project configuration
  grunt.initConfig({
    pkg: grunt.file.readJSON('package.json'),
    assets_folder: 'assets',

    // JSHint configuration
    jshint: {
      options: {
        "bitwise":  true,
        "browser":  true,
        "curly":    true,
        "eqeqeq":   true,
        "eqnull":   true,
        "es5":      true,
        "esnext":   true,
        "immed":    true,
        "jquery":   true,
        "latedef":  true,
        "newcap":   true,
        "noarg":    true,
        "node":     true,
        "strict":   false,
        "trailing": true,
        "undef":    true,
        "indent":   2,
        "globals": {
          "jQuery": true,
          "alert":  true
        }
      },
      all: [
        'Gruntfile.js',
        '<%= assets_folder %>/javascripts/source/*.js'
      ]
    },

    // Minimize JS into 2 files into /assets/javascripts/main.min.js
    uglify: {
      options: {
        // Add header informations
        banner: '/*! <%= grunt.template.today("yyyy-mm-dd HH:MM:ss") %> */'
      },
      dist: {
        files: {
          '<%= assets_folder %>/javascripts/vendor.min.js': [
            // Define Plugins you want to use here
            //'<%= assets_folder %>/javascripts/vendor/retina.js',
            '<%= assets_folder %>/javascripts/vendor/bootstrap/affix.js',
            '<%= assets_folder %>/javascripts/vendor/bootstrap/alert.js',
            '<%= assets_folder %>/javascripts/vendor/bootstrap/button.js',
            '<%= assets_folder %>/javascripts/vendor/bootstrap/carousel.js',
            '<%= assets_folder %>/javascripts/vendor/bootstrap/collapse.js',
            '<%= assets_folder %>/javascripts/vendor/bootstrap/dropdown.js',
            '<%= assets_folder %>/javascripts/vendor/bootstrap/modal.js',
            '<%= assets_folder %>/javascripts/vendor/bootstrap/popover.js',
            '<%= assets_folder %>/javascripts/vendor/bootstrap/scrollspy.js',
            '<%= assets_folder %>/javascripts/vendor/bootstrap/tab.js',
            '<%= assets_folder %>/javascripts/vendor/bootstrap/tooltip.js',
            '<%= assets_folder %>/javascripts/vendor/bootstrap/transition.js'
          ],
          '<%= assets_folder %>/javascripts/script.min.js': [
            // Define source files you want to use here
            '<%= assets_folder %>/javascripts/source/script.js'
          ]
        }
      }
    },

    // Compile and minimize LESS files into main.css
    less: {
      options: {
        paths: '<%= assets_folder %>/stylesheets',
        compress: true,
        yuicompress: true,
        dumpLineNumbers: 'comments'
      },
      dist: {
        src: '<%= assets_folder %>/stylesheets/main.less',
        dest: 'style.css'
      }
    },

    // Image optimization
    imagemin: {
      dist: {
        options: {
          optimizationLevel: 7,
          progressive: true
        },
        files: [{
          expand: true,
          cwd: '<%= assets_folder %>/images/',
          src: '**/*',
          dest: '<%= .assets_folder %>/images/'
        }]
      }
    },

    // Add template information to style.css
    banner: {
      options: {
        dest: ['style.css'],
        fetchfrom: '<%= less.dist.src %>'
      }
    },

    // Watch for changes
    watch: {
      options: {
        livereload: true,
      },
      js: {
        files: [
          '<%= jshint.all %>'
        ],
        tasks: ['jshint', 'uglify']
      },
      less: {
        files: [
          '<%= assets_folder %>/stylesheets/main.less',
          '<%= assets_folder %>/stylesheets/**/*.less'
        ],
        tasks: ['less', 'banner']
      },
      livereload: {
        files: ['*.html', '*.php', '<%= assets_folder %>/images/**/*.{png,jpg,jpeg,gif,webp,svg}']
      }
    }
  });

  // Load Tasks.
  grunt.loadNpmTasks('grunt-contrib-jshint');
  grunt.loadNpmTasks('grunt-contrib-uglify');
  grunt.loadNpmTasks('assemble-less');
  grunt.loadNpmTasks('grunt-contrib-watch');

  // Get multiline comments from file and prepend them into each paths
  grunt.registerTask('banner', 'Add banner to file.', function() {
    var options = this.options();
    if (options.fetchfrom) {
      if (!grunt.file.exists(options.dest)) {
        grunt.log.warn('Source file "' + options.dest + '" not found.');
        return false;
      } else {
        var file = grunt.file.read(options.dest);
        if (file.length < 1 ) {
          grunt.log.warn('File was empty?');
        }

        var bannerFile = grunt.file.read(options.fetchfrom),
            banner = /\/\*[\s\S]*?\*\//.exec(bannerFile);

        grunt.file.write(options.dest, banner + file);
        grunt.log.writeln('File ' + options.dest + ' updated.');
      }
    }
  });

  // Register Task
  grunt.registerTask('default', ['jshint', 'uglify', 'less', 'banner', 'watch']);
};