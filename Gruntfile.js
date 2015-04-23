'use strict';

module.exports = function (grunt) {

  // Show elapsed time

  var jsFileList = [
    'assets/js/plugins/*.js',
    'assets/js/_*.js'
  ];

  /**
  * Init Config
  */

  grunt.initConfig({

    jshint: {
      options: {
        jshintrc: '.jshintrc'
      },
      all: [
        'Gruntfile.js',
        'assets/js/*.js',
        '!assets/js/scripts.js',
        '!assets/**/*.min.*'
      ]
    },

    concat: {
      options: {
        separator: ';',
      },
      dist: {
        src: [jsFileList],
        dest: 'assets/js/scripts.js',
      },
    },
    uglify: {
      dist: {
        files: {
          'assets/js/scripts.min.js': [jsFileList]
        }
      }
    },
    autoprefixer: {
      options: {
        browsers: ['last 2 versions', 'ie 8', 'ie 9', 'android 2.3', 'android 4', 'opera 12']
      },
      dev: {
        options: {
          map: {
            prev: 'assets/css/'
          }
        },
        src: 'assets/css/main.css'
      },
      build: {
        src: 'assets/css/main.min.css'
      }
    },
    modernizr: {
      build: {
        devFile: 'assets/vendor/modernizr/modernizr.js',
        outputFile: 'assets/js/vendor/modernizr.min.js',
        files: {
          'src': [
            ['assets/js/scripts.min.js'],
            ['assets/css/main.min.css']
          ]
        },
        uglify: true,
        parseFiles: true
      }
    },
    version: {
      default: {
        options: {
          format: true,
          length: 32,
          manifest: 'assets/manifest.json',
          querystring: {
            style: 'roots_css',
            script: 'roots_js'
          }
        },
        files: {
          'lib/scripts.php': 'assets/{css,js}/{main,scripts}.min.{css,js}'
        }
      }
    },


    /**
    * Watch
    */

    watch: {
      options: {
        livereload: true
      },

      // Sass
      sass: {
        files: ['assets/sass/{,**/}*.{scss,sass}'],
        tasks: ['compass'],
        options: {
          livereload: false
        }
      },

      // CSS
      css: {
        files: ['assets/css/{,**/}*.css']
      }

    },


    /**
    * Compass
    */

    compass: {
      dist: {
        options: {
          config: 'config.rb',
          sourcemap: false,
          bundleExec: true,
          force: true
        }
      }
    }

  });


  /**
  * Load Modules
  */

  grunt.loadNpmTasks('grunt-contrib-compass');
  grunt.loadNpmTasks('grunt-contrib-watch');


  /**
  * Define Tasks
  */

  grunt.registerTask('default', ['watch']);

};
