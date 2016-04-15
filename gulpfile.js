var gulp = require('gulp');
var sass = require('gulp-sass');
var sourcemaps = require('gulp-sourcemaps');
var concat = require('gulp-concat');
var cleanCSS = require('gulp-clean-css');
var config = {
    materializeDir: 'web/assets/vendor/Materialize',
    customAssetDir: 'app/Resources/assets',
    sassPattern: 'sass/**/*.scss'
};

gulp.task('createCss', function(){
    gulp.src([
            config.materializeDir+ '/'+config.sassPattern,
            config.customAssetDir+"/"+config.sassPattern])
        .pipe(sourcemaps.init())
        .pipe(sass())
        .pipe(concat('main.css'))
        .pipe(cleanCSS())
        .pipe(sourcemaps.write('.'))
        .pipe(gulp.dest('web/css'));
});

gulp.task('watch', function(){
    gulp.watch(config.customAssetDir+"/"+config.sassPattern, ['createCss'])
});

gulp.task('default', ['createCss', 'watch']);
