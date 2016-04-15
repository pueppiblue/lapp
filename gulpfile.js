var gulp = require('gulp');
var sass = require('gulp-sass');
var sourcemaps = require('gulp-sourcemaps');

gulp.task('getcss', function(){
    gulp.src('web/assets/vendor/Materialize/sass/materialize.scss')
        .pipe(sourcemaps.init())
        .pipe(sass())
        .pipe(sourcemaps.write('.'))
        .pipe(gulp.dest('web/css'));
});

gulp.task('default', function() {
console.log('Testing Gulp script')
});
