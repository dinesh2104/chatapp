module.exports = function (grunt) {

    var currentdate = new Date();
    var datetime = "Last Sync: " + currentdate.getDate() + "/" +
        (currentdate.getMonth() + 1) + "/" +
        currentdate.getFullYear() + " @ " +
        currentdate.getHours() + ":" +
        currentdate.getMinutes() + ":" +
        currentdate.getSeconds();

    grunt.initConfig({
        concat: {
            options: {
                separator: '\n',
                sourceMap: true,
                banner: "/*Processed by dinesh on " + datetime + "*/\n "
            },
            css: {
                src: ['../css/**/*.css'],
                dest: 'dist/style.css',
            },
            js: {
                src: [
                    '../js/**/*.js'
                ],
                dest: 'dist/app.js'
            },
            scss:{
                src: [
                    '../scss/**/*.scss'
                ],
                dest: 'dist/app.scss'
            }
        },
        watch: {
            css: {
                files: ['../css/*.css'],
                tasks: ['concat:css', 'cssmin', ],
                options: {
                    spawn: false,
                },
            },
            js: {
                files: ['../js/**/*.js'],
                tasks: ['concat:js', 'uglify', 'obfuscator'],
                options: {
                    spawn: false,
                },
            },
            scss: {
                files: ['../scss/**/*.scss'],
                tasks: ['concat:scss', 'sass'],
                options: {
                    spawn: false,
                },
            },
        },
        cssmin: {
            options: {
                mergeIntoShorthands: false,
                roundingPrecision: -1
            },
            target: {
                files: {
                    '../../htdocs/css/style.min.css': ['dist/style.css']
                }
            }
        },
        sass: { // Task
            dist: { // Target
                options: { // Target options
                    style: 'expanded'
                },
                files: { // Dictionary of files
                    '../../htdocs/css/app.css': 'dist/app.scss'
                }
            }
        },
        uglify: {
            my_target: {
                options: {
                    sourceMap: true
                },
                files: {
                    '../../htdocs/js/app.min.js': ['dist/app.js']
                }
            }
        },
        copy: {
            bower: {
                files: [
                    // includes files within path
                    {
                        expand: true,
                        flatten: true,
                        filter: 'isFile',
                        src: ['bower_components/jquery/dist/*'],
                        dest: '../../htdocs/js/jquery',
                    }
                ],
            },
        },
        obfuscator: {
            options: {
                banner: '// obfuscated with grunt-contrib-obfuscator.\n',
                debugProtection: true,
                debugProtectionInterval: true,
                domainLock: ['www.example.com']
            },
            task1: {
                options: {
                    // options for each sub task
                },
                files: {
                    '../../htdocs/js/app.o.js': [
                        'dist/app.js'
                    ]
                }
            }
        }
    });



    grunt.loadNpmTasks('grunt-contrib-concat');
    grunt.loadNpmTasks('grunt-contrib-watch');
    grunt.loadNpmTasks('grunt-contrib-cssmin');
    grunt.loadNpmTasks('grunt-contrib-uglify');
    grunt.loadNpmTasks('grunt-contrib-copy');
    grunt.loadNpmTasks('grunt-contrib-obfuscator');
    grunt.loadNpmTasks('grunt-contrib-sass');

    grunt.registerTask('css', ['concat:css', 'cssmin']);
    grunt.registerTask('js', ['concat:js', 'uglify', 'obfuscator']);
    grunt.registerTask('default', ['copy', 'obfuscator', 'concat', 'cssmin','sass', 'uglify', 'watch'])

};