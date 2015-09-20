// Include gulp
var gulp = require('gulp');


// Include Our Plugins
var path    = require('path');
var concat  = require('gulp-concat');
var uglify  = require('gulp-uglify');
var rename  = require('gulp-rename');
var compass = require('gulp-compass');
var plumber = require('gulp-plumber');
var cssmin  = require('gulp-cssmin');
var del     = require('del');


// Concatenate & Minify JS
gulp.task('scripts', function() {
	gulp.src('../assets/_js/lib/modernizr.js')
		.pipe(plumber())
		.pipe(concat('head-scripts.js'))
		.pipe(gulp.dest('../assets/js'))
		.pipe(rename('head-scripts.min.js'))
		.pipe(uglify())
		.pipe(gulp.dest('../assets/js'));

	gulp.src(['../assets/_js/*.js','../assets/_js/lib/jquery.plugins.js', '../assets/_js/app/*.js'])
		.pipe(plumber())
		.pipe(concat('main.js'))
		.pipe(gulp.dest('../assets/js'))
		.pipe(rename('main.min.js'))
		.pipe(uglify())
		.pipe(gulp.dest('../assets/js'));
});


// Compass
gulp.task('compass', function() {
	gulp.src('../assets/_sass/style.sass')
		.pipe(plumber())
		.pipe(compass({
			project: path.join(__dirname, '../assets'),
			css: 'css',
			sass: '_sass',
			output_style: ':compressed'
		}))
		.pipe(gulp.dest('../assets/css/'));
});

// clean min
gulp.task('clean:min', function (cb) {
	del(
		[
			'../assets/css/**/*.min.css',
		],
		{
			force: true
		},
		cb
	);
});

// css min
gulp.task('cssmin', function () {
	gulp.src('../assets/css/**/*.css')
		.pipe(cssmin())
		.pipe(rename({suffix: '.min'}))
		.pipe(gulp.dest('../assets/css/'));
});


// Watch Files For Changes
gulp.task('watch', function() {
	gulp.watch('../assets/_js/**/*.js', ['scripts']);
	gulp.watch(['../assets/_sass/**/*.sass', '../assets/_sass/**/*.scss'], ['compass']);
});


// Default Task
gulp.task('default', ['scripts', 'cssmin']);
