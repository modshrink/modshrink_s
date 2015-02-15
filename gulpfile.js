var gulp = require('gulp');
var path = require('path');
var sass = require('gulp-sass');
var plumber = require('gulp-plumber');

var paths = {

}

gulp.task('sass', function () {
    gulp.src('./sass/*.scss')
        .pipe(plumber())
        .pipe(sass())
        .pipe(gulp.dest('.'));
});

gulp.task('copy', function() {
    gulp.src('.')
        .pipe(plumber())
        .pipe(gulp.dest('/Users/mayoibi/vagrant-wp-dev/www/wordpress/wp-content/themes/modshrink_s'));
});

gulp.task('watch', function(){
  gulp.watch('./sass/*.scss', ['sass', 'copy']);
});

gulp.task('default', ['sass']);