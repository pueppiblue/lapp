var gulp = require('gulp');
var sass = require('gulp-sass');

gulp.task('getcss', function(){
    gulp.src('web/assets/vendor/Materialize/sass/materialize.scss')
        .pipe(sass())
        .pipe(gulp.dest('web/css'));
});

gulp.task('default', function() {
    console.log('Testing Gulp script')
});