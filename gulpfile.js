var gulp        = require('gulp');
var browserSync = require('browser-sync');
var reload      = browserSync.reload;
var sass        = require('gulp-sass');
var plumber = require('gulp-plumber');
var imagemin = require('gulp-imagemin');
var uglify = require('gulp-uglify');
var autoprefixer = require('gulp-autoprefixer');

var autoprefixerOptions = {
    browsers: ['last 2 versions', '> 5%', 'Firefox ESR']
};

// browser-sync task for starting the server.z
gulp.task('browser-sync', function() {
    //watch files
    var files = [
    './style.css',
    './js/*.js',
    './*.php'
    ];

    //initialize browsersync
    browserSync.init(files, {
    //browsersync with a php server
    proxy: "mag18.test",
    notify: false
    });
});

// Sass task, will run when any SCSS files change & BrowserSync
// will auto-update browsers
gulp.task('sass', function () {

    return gulp.src('./maguared-assets/sass/*.scss')
    .pipe(plumber())
    .pipe(sass({outputStyle: 'expanded'}))
        /*.pipe(sass({outputStyle: 'compressed'}))*/
    .pipe(autoprefixer(autoprefixerOptions))
    .pipe(gulp.dest('./'))
    .pipe(reload({stream:true}));
});

gulp.task('uglify', function() {
    gulp.src('js/**/*.js')
        .pipe(plumber())
        .pipe(uglify())
        .pipe(gulp.dest('min_js'));
});

gulp.task('imagemin', function() {
    gulp.src('./maguared-assets/img/**/*.{jpg,jpeg,png,gif}')
    .pipe(plumber())
    .pipe(imagemin())
    .pipe(gulp.dest('images'));
});
// Default task to be run with `gulp`
gulp.task('default', ['uglify', 'imagemin', 'sass', 'browser-sync'], function () {
    gulp.watch("./maguared-assets/sass/**/*.scss", ['sass']);
    gulp.watch("./maguared-assets/sass/**/**/*.scss", ['sass']);
    gulp.watch('js/**/*.js', ['uglify']);
    gulp.watch('./maguared-assets/img/**/*.{jpg,jpeg,png,gif}', ['imagemin']);
});