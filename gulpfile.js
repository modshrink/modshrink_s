var gulp = require("gulp");

var plumber = require("gulp-plumber");
var sass = require("gulp-sass");

gulp.task("sass", function() {
	gulp.src("sass/**/*.scss")
		.pipe(plumber())
		.pipe(sass())
		.pipe(gulp.dest("./"));
});
