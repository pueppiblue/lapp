var dest = "./web";

module.exports = {
    sass: {
        material: {
            src: ['vendor/bower_components/Materialize/sass/materialize.scss'],
            output: 'material.css'
        },
        bootstrap: {
            src: [
                'vendor/bower_components/bootstrap/dist/css/bootstrap.css'
            ],
            output: 'bootstrap.css'
        },
        custom: {
            src: ['app/Resources/assets/css/**/*.css'],
            output: 'lapp_main.css'
        },
        dest: dest + "/css"
    },
    script: {
        material: {
            src: [
                'vendor/bower_components/Materialize/dist/js/materialize.js'
            ],
            output: 'material.js'
        },
        bootstrap: {
            src: [
                'vendor/bower_components/bootstrap/js/transition.js',
                'vendor/bower_components/bootstrap/js/alert.js',
                'vendor/bower_components/bootstrap/js/button.js',
                'vendor/bower_components/bootstrap/js/carousel.js',
                'vendor/bower_components/bootstrap/js/collapse.js',
                'vendor/bower_components/bootstrap/js/dropdown.js',
                'vendor/bower_components/bootstrap/js/modal.js',
                'vendor/bower_components/bootstrap/js/tooltip.js',
                'vendor/bower_components/bootstrap/js/popover.js',
                'vendor/bower_components/bootstrap/js/scrollspy.js',
                'vendor/bower_components/bootstrap/js/tab.js',
                'vendor/bower_components/bootstrap/js/affix.js'],
            output: 'bootstrap.js'
        },
        jquery: {
            src: ['vendor/bower_components/jquery/dist/jquery.js'],
            output: 'jquery.js'
        },
        custom: {
            src: ['app/Resources/assets/**/*.js'],
            output: 'lapp_main.js'
        },
        dest: dest + "/js"
    }
};
