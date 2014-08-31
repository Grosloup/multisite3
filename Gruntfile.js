module.exports = function(grunt){
    grunt.initConfig({

        uglify: {
            scripts: {
                files: {
                    'web/js/admin/app.min.js': ['web/js/admin/app.js']
                }
            }
        },
        watch: {
            js: {
                files: ['web/js/admin/app.js'],
                tasks: ['uglify:scripts']
            }
        }
    });
    grunt.registerTask('default', ['watch']);
    grunt.loadNpmTasks('grunt-contrib-uglify');
    grunt.loadNpmTasks('grunt-contrib-watch');
};
