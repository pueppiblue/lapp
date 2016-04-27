var gulp= require('gulp');
var sass = require('gulp-sass');
var sourcemaps = require('gulp-sourcemaps');
var concat = require('gulp-concat');
var cleanCSS = require('gulp-clean-css');
var config  = require('../config').sass;

gulp.task('styles', function(){
    addStyle(config.material.src, config.material.output);
    addStyle(config.bootstrap.src, config.bootstrap.output);
    addStyle(config.custom.src, config.custom.output);

});

addStyle = function (paths, outputFilename) {
    gulp.src(paths)
        .pipe(sourcemaps.init())
        .pipe(sass())
        .pipe(concat(outputFilename))
        //.pipe(cleanCSS())
        .pipe(sourcemaps.write('.'))
        .pipe(gulp.dest(config.dest));
};


