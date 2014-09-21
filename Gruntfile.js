module.exports = function(grunt){
    grunt.initConfig({

        uglify: {
            scripts: {
                files: {
                    'web/js/admin/app.min.js': ['web/js/admin/app.js'],
                    'web/js/admin/animationDayForm.min.js': ['web/js/admin/animationDayForm.js'],
                    'web/js/admin/newPost.min.js': ['web/js/admin/newPost.js'],
                    'web/js/admin/newResto.min.js': ['web/js/admin/newResto.js'],
                    'web/js/admin/newPressRelease.min.js': ['web/js/admin/newPressRelease.js'],
                    'web/js/app.min.js' : ['web/js/app.js']
                }
            }
        },
        watch: {
            js: {
                files: ['web/js/admin/app.js','web/js/admin/animationDayForm.js','web/js/admin/newPost.js','web/js/admin/newResto.js','web/js/admin/newPressRelease.js','web/js/app.js'],
                tasks: ['uglify:scripts']
            }
        }
    });
    grunt.registerTask('default', ['watch']);
    grunt.loadNpmTasks('grunt-contrib-uglify');
    grunt.loadNpmTasks('grunt-contrib-watch');
};
