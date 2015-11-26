/*jslint white: true */

// npm install --save-dev gulp gulp-plumber gulp-watch gulp-livereload gulp-minify-css gulp-jshint jshint-stylish gulp-uglify gulp-concat gulp-rename gulp-notify gulp-sourcemaps gulp-include gulp-sass gulp-imagemin imagemin-pngquant

var gulp = require('gulp'),
    plumber = require( 'gulp-plumber' ),
    watch = require( 'gulp-watch' ),
    livereload = require( 'gulp-livereload' ),
    notify = require( 'gulp-notify' ),
    include = require( 'gulp-include' ),
    sass = require( 'gulp-sass' ),
    minifycss = require( 'gulp-minify-css' ),
    jshint = require( 'gulp-jshint' ),
    stylish = require( 'jshint-stylish' ),
    uglify = require( 'gulp-uglify' ),
    rename = require( 'gulp-rename' ),
    gp_concat = require( 'gulp-concat' ),
    sourcemaps = require( 'gulp-sourcemaps' ),
    imagemin = require('gulp-imagemin'),
    pngquant = require('imagemin-pngquant');

var onError = function( err ) {
    console.log( 'An error occurred:', err.message );
    this.emit( 'end' );
}

/* Set paths */

var paths = {
    /* Source paths */
    styles: ['./src/sass/style.scss'],
    scripts: ['./src/js/**/*.js'],
    images: ['./src/images/*'],
    fonts: ['./src/fonts/*'],

    /* Output paths */
    stylesOutput: './',
    scriptsOutput: './assets/js',
    imagesOutput: './assets/images',
    fontsOutput: './assets/fonts'
};

gulp.task( 'sass', function() {
    return gulp.src( paths.styles, {
        style: 'expanded'
    } )
    .pipe( plumber( { errorHandler: onError } ) )
    .pipe( sass() )
    .pipe( gulp.dest( paths.stylesOutput ) )
    .pipe( minifycss() )
    .pipe( rename( { suffix: '.min' } ) )
    .pipe( gulp.dest( './assets/css' ) )
    .pipe( notify( { message: 'Styles task complete' } ) )
} );

gulp.task('scripts', function() {
  return gulp.src( paths.scripts )
    .pipe( sourcemaps.init() )
    .pipe( gp_concat( 'app.js' ) )
    .pipe( gulp.dest( paths.scriptsOutput ) )
    .pipe( rename( 'app.min.js' ) )
    .pipe( uglify() )
    .pipe( sourcemaps.write( paths.scriptsOutput ) )
    .pipe( gulp.dest( paths.scriptsOutput ) )
    .pipe( notify( { message: 'Scripts task complete' } ) )
});

gulp.task('images', function () {
    return gulp.src( paths.images )
        .pipe(imagemin({
            progressive: true,
            svgoPlugins: [{removeViewBox: false}],
            use: [pngquant()]
        }))
        .pipe( gulp.dest( paths.imagesOutput ) );
});

gulp.task( 'watch', function() {
    livereload.listen();
    gulp.watch( paths.styles, [ 'sass' ] );
    gulp.watch( paths.scripts, [ 'scripts' ] );
    gulp.watch( paths.images, [ 'images' ] );
} );

gulp.task( 'default', [ 'sass', 'scripts', 'images', 'watch' ], function() {

} )