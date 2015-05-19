//Gruntfile
module.exports = function(grunt) {
    //Initializing the configuration object
    grunt.initConfig({
        // Paths variables
        paths: {
            // Development where put LESS files, etc
            assets: {
                css: './public/assets/stylesheets/',
                js: './public/assets/javascript/',
                js_includes: './public/assets/javascript/includes/',
                vendor: './public/assets/vendor/'
            },
            // Production where Grunt output the files
            css: './public/css/',
            js: './public/js/'

        },

        // Task configuration
        concat: {
            options: {
                separator: ';'
            },
            js_frontend: {
                src: [
                    '<%= paths.assets.vendor %>jquery/dist/jquery.js',
                    '<%= paths.assets.vendor %>/jquery-ui/jquery-ui.js',
                    '<%= paths.assets.vendor %>bootstrap/dist/js/bootstrap.js',
                    '<%= paths.assets.js_includes %>frontend.js'
                ],
                dest: '<%= paths.js %>frontend.js'
            },
            js_portal: {
                src: [
                    '<%= paths.assets.vendor %>jquery/dist/jquery.js',
                    '<%= paths.assets.vendor %>/jquery-ui/jquery-ui.js',
                    '<%= paths.assets.vendor %>bootstrap/dist/js/bootstrap.js',
                    '<%= paths.assets.js_includes %>portal.js'
                ],
                dest: '<%= paths.js %>portal.js'
            },
            js_backend: {
                src: [
                    '<%= paths.assets.vendor %>jquery/dist/jquery.js',
                    '<%= paths.assets.vendor %>/jquery-ui/jquery-ui.js',
                    '<%= paths.assets.vendor %>bootstrap/dist/js/bootstrap.js',
                    '<%= paths.assets.js_includes %>backend.js'
                ],
                dest: '<%= paths.js %>backend.js'
            },

        },
        less: {
            development: {
                options: {
                    compress: false,  //NOT minifying the result
                },
                files: {
                    //compiling frontend.less into frontend.css
                    "<%= paths.css %>frontend.css":"<%= paths.assets.css %>frontend.less",
                    //compiling portal.less into portal.css
                    "<%= paths.css %>portal.css":"<%= paths.assets.css %>portal.less",
                    //compiling backend.less into backend.css
                    "<%= paths.css %>backend.css":"<%= paths.assets.css %>backend.less"
                }
            },
            production: {
                options: {
                    compress: true,  //minifying the result
                },
                files: {
                    //compiling frontend.less into frontend.min.css
                    "<%= paths.css %>frontend.min.css":"<%= paths.assets.css %>frontend.less",
                    //compiling portal.less into portal.min.css
                    "<%= paths.css %>portal.min.css":"<%= paths.assets.css %>portal.less",
                    //compiling backend.less into backend.min.css
                    "<%= paths.css %>backend.min.css":"<%= paths.assets.css %>backend.less"
                }
            }
        },
        uglify: {
            options: {
                mangle: false  // Use if you want the names of your functions and variables unchanged
            },
            frontend: {
                files: {
                    '<%= paths.js %>frontend.min.js': '<%= paths.js %>frontend.js'
                }
            },
            portal: {
                files: {
                    '<%= paths.js %>portal.min.js': '<%= paths.js %>portal.js'
                }
            },
            backend: {
                files: {
                    '<%= paths.js %>backend.min.js': '<%= paths.js %>backend.js'
                }
            }

        },
        concatinclude: {
            options: {
                separator: ';'
            },
            js_frontend: {
                files: {
                    '<%= paths.assets.js_includes %>frontend.js': ['<%= paths.assets.js %>frontend.inc']
                }
            },
            js_portal: {
                files: {
                    '<%= paths.assets.js_includes %>portal.js': ['<%= paths.assets.js %>portal.inc']
                }
            },
            js_backend: {
                files: {
                    '<%= paths.assets.js_includes %>backend.js': ['<%= paths.assets.js %>backend.inc']
                }
            }
        },
        watch: {
            js_frontend: {
                files: [
                    //watched files
                    '<%= paths.assets.vendor %>jquery/jquery.js',
                    '<%= paths.assets.vendor %>bootstrap/dist/js/bootstrap.js',
                    '<%= paths.assets.js %>frontend.js',
                    '<%= paths.assets.js %>frontend.inc'
                ],
                tasks: ['concatinclude:js_frontend', 'concat:js_frontend','uglify:frontend'],     //tasks to run
                options: {
                    livereload: true                        //reloads the browser
                }
            },
            js_portal: {
                files: [
                    //watched files
                    '<%= paths.assets.vendor %>jquery/jquery.js',
                    '<%= paths.assets.vendor %>bootstrap/dist/js/bootstrap.js',
                    '<%= paths.assets.js %>portal.js',
                    '<%= paths.assets.js %>portal.inc'
                ],
                tasks: ['concatinclude:js_portal', 'concat:js_portal','uglify:portal'],     //tasks to run
                options: {
                    livereload: true                        //reloads the browser
                }
            },
            js_backend: {
                files: [
                    //watched files
                    '<%= paths.assets.vendor %>jquery/jquery.js',
                    '<%= paths.assets.vendor %>bootstrap/dist/js/bootstrap.js',
                    '<%= paths.assets.js %>backend.js',
                    '<%= paths.assets.js %>backend.inc'
                ],
                tasks: ['concatinclude:js_backend', 'concat:js_backend','uglify:backend'],     //tasks to run
                options: {
                    livereload: true                        //reloads the browser
                }
            },
            less: {
                files: ['<%= paths.assets.css %>*.less'],  //watched files
                tasks: ['less'],                          //tasks to run
                options: {
                    livereload: true                        //reloads the browser
                }
            }
        }
    });
    // Plugin loading
    grunt.loadNpmTasks('grunt-contrib-concat');
    grunt.loadNpmTasks('grunt-concat-include');
    grunt.loadNpmTasks('grunt-contrib-watch');
    grunt.loadNpmTasks('grunt-contrib-less');
    grunt.loadNpmTasks('grunt-contrib-uglify');
    grunt.loadNpmTasks('grunt-phpunit');

    // Task definition
    grunt.registerTask('default', ['watch']);
};