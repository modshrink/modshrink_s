var gulp = require('gulp');
var path = require('path');
var sass = require('gulp-sass');
var del = require('del');
var uglify = require('gulp-uglify');
var vinylPaths = require('vinyl-paths');
var plumber = require('gulp-plumber');

gulp.task('sass', function () {
    gulp.src('./sass/*.scss')
        .pipe(plumber())
        .pipe(sass())
        .pipe(gulp.dest('.'));
});

gulp.task('clean', function(cb) {
  del(['/Users/mayoibi/vagrant-wp-dev/www/wordpress/wp-content/themes/modshrink_s/*'], {force: true}, cb);
});

gulp.task('copy', ['clean'], function() {
    gulp.src('images/*')
        .pipe(gulp.dest('/Users/mayoibi/vagrant-wp-dev/www/wordpress/wp-content/themes/modshrink_s/images/'));
    gulp.src('inc/*')
        .pipe(gulp.dest('/Users/mayoibi/vagrant-wp-dev/www/wordpress/wp-content/themes/modshrink_s/inc/'));
    gulp.src('js/*')
        .pipe(uglify())
        .pipe(gulp.dest('/Users/mayoibi/vagrant-wp-dev/www/wordpress/wp-content/themes/modshrink_s/js/'));
    gulp.src('languages/*')
        .pipe(gulp.dest('/Users/mayoibi/vagrant-wp-dev/www/wordpress/wp-content/themes/modshrink_s/languages/'));
    gulp.src('*.php')
        .pipe(gulp.dest('/Users/mayoibi/vagrant-wp-dev/www/wordpress/wp-content/themes/modshrink_s/'));
    gulp.src('*.css')
        .pipe(gulp.dest('/Users/mayoibi/vagrant-wp-dev/www/wordpress/wp-content/themes/modshrink_s/'));
    gulp.src('screenshot.png')
        .pipe(gulp.dest('/Users/mayoibi/vagrant-wp-dev/www/wordpress/wp-content/themes/modshrink_s/'));
});

gulp.task('watch', function(){
  gulp.watch(['./sass/*.scss', '*.php'], ['sass', 'clean', 'copy']);
});

gulp.task('default', ['sass']);