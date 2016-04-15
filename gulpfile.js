var gulp = require('gulp');
var sass = require('gulp-sass');
var sourcemaps = require('gulp-sourcemaps');
var concat = require('gulp-concat');
var cleanCSS = require('gulp-clean-css');
var config = {
    materializeDir: 'vendor/bower_components/Materialize/sass/materialize.scss',
    bootstrapDir: 'vendor/bower_components/bootstrap/dist/css/bootstrap.css',
    customAssetDir: 'app/Resources/assets',
    sassPattern: 'sass/**/*.scss)'
};

gulp.task('createCss', function(){
    gulp.src([
            config.materializeDir,
            config.customAssetDir+"/"+config.sassPattern,
            config.bootstrapDir])
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
