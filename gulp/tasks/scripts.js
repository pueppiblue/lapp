var gulp= require('gulp');
var sass = require('gulp-sass');
var sourcemaps = require('gulp-sourcemaps');
var concat = require('gulp-concat');
var config  = require('../config').script;

gulp.task('scripts', function () {
    addScript(config.material.src, config.material.output);
    addScript(config.bootstrap.src, config.bootstrap.output);
    addScript(config.jquery.src, config.jquery.output);
    addScript(config.custom.src, config.custom.output);
});

addScript = function (paths, outputFilename) {
    gulp.src(paths)
        .pipe(sourcemaps.init())
        .pipe(concat(outputFilename))
        .pipe(sourcemaps.write('.'))
        .pipe(gulp.dest(config.dest));
};



