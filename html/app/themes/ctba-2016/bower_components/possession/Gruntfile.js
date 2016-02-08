module.exports = function(grunt) {

  // Project configuration.
  grunt.initConfig({
    pkg: grunt.file.readJSON('package.json'),

    less: {
      development: {
        files: {
          'test/global.css': ['global.less']
        }
      }
    }

    ,csslint: {
      options: {
         'adjoining-classes': false
        ,'box-model': false
        ,'box-sizing': false
        ,'regex-selectors': false
        ,'universal-selector': false
      }
      ,files: {
        src: ['test/global.css']
      }
    }

   ,express: {
      server: {
        options: {
          port: 3000
         ,hostname: 'localhost'
         ,bases: 'test'
        }
      }
    }

    ,watch: {
      files: ['./**/*.less']
     ,tasks: ['serve']
     ,options: {
        livereload: true
      }
    }

  });

  grunt.loadNpmTasks('grunt-contrib-watch');
  grunt.loadNpmTasks('grunt-contrib-less');
  grunt.loadNpmTasks('grunt-contrib-csslint');
  grunt.loadNpmTasks('grunt-express');

  grunt.registerTask('default', ['serve', 'express', 'watch']);
  grunt.registerTask('ci-server', ['csslint']);
  grunt.registerTask('serve', ['less']);

};
