var gulp = require('gulp');
var sass = require('gulp-sass');
var autoprefixer = require('gulp-autoprefixer');
var rename = require('gulp-rename');
var sourcemaps = require( 'gulp-sourcemaps' ); // Maps code in a compressed file (E.g. style.css) back to it’s original position in a source file (E.g. structure.scss, which was later combined with other css files to generate style.css)

// JS related plugins.
var concat = require( 'gulp-concat' ); // Concatenates JS files
var uglify = require( 'gulp-uglify' ); // Minifies JS files
var plumber = require( 'gulp-plumber' ); // Prevent pipe breaking caused by errors from gulp plugins
var lineec = require( 'gulp-line-ending-corrector' ); // Consistent Line Endings for non UNIX systems. Gulp Plugin for Line Ending Corrector (A utility that makes sure your files have consistent line endings)
var notify = require( 'gulp-notify' ); // Sends message notification to you


var jsVendorSRC = './js/vendor/*.js'; // Path to JS vendor folder.
var jsVendorDestination = './js/'; // Path to place the compiled JS vendors file.
var jsVendorFile = 'vendor'; // Compiled JS vendors file name.
// Default set to vendors i.e. vendors.js.

// JS Custom related.
var jsCustomSRC = './js/custom/*.js'; // Path to JS custom scripts folder.
var jsCustomDestination = './js/'; // Path to place the compiled JS custom scripts file.
var jsCustomFile = 'custom'; // Compiled JS custom file name.

const gulpMultiProcess = require('gulp-multi-process');

gulp.task('sass', function() {
    return gulp.src('./sass/*.scss')
        .pipe( sourcemaps.init() )
        .pipe(sass({ outputStyle: 'nested', precision: 10, includePaths: ['.'] }).on('error', sass.logError))
        .pipe( sourcemaps.write( {
            includeContent: false
        } ) )
        .pipe( sourcemaps.init( {
            loadMaps: true
        } ) )
        .pipe( autoprefixer() )
        .pipe( sourcemaps.write( './' ) )
        .pipe(gulp.dest('./css/'));
});

/**
 * Task: `vendorJS`.
 *
 * Concatenate and uglify vendor JS scripts.
 *
 * This task does the following:
 *     1. Gets the source folder for JS vendor files
 *     2. Concatenates all the files and generates vendors.js
 *     3. Renames the JS file with suffix .min.js
 *     4. Uglifes/Minifies the JS file and generates vendors.min.js
 */
gulp.task( 'vendorsJs', function() {
    gulp.src( jsVendorSRC )
        .pipe( plumber( {
            errorHandler: function( err ) {
                notify.onError( "Error: <%= error.message %>" )( err );
                this.emit( 'end' ); // End stream if error is found
            }
        } ) )
        .pipe( concat( jsVendorFile + '.js' ) )
        .pipe( gulp.dest( jsVendorDestination ) )
        .pipe( rename( {
            basename: jsVendorFile,
            suffix: '.min'
        } ) )
        .pipe( uglify() )
        .pipe( gulp.dest( jsVendorDestination ) )
} );


/**
 * Task: `customJS`.
 *
 * Concatenate and uglify custom JS scripts.
 *
 * This task does the following:
 *     1. Gets the source folder for JS custom files
 *     2. Concatenates all the files and generates custom.js
 *     3. Renames the JS file with suffix .min.js
 *     4. Uglifes/Minifies the JS file and generates custom.min.js
 */

gulp.task( 'customJS', function() {
    gulp.src( jsCustomSRC )
        .pipe( plumber( {
            errorHandler: function( err ) {
                notify.onError( 'Error: <%= error.message %>' )( err );
                this.emit( 'end' ); // End stream if error is found
            }
        } ) )
        .pipe( concat( jsCustomFile + '.js' ) )
        .pipe( lineec() ) // Consistent Line Endings for non UNIX systems.
        .pipe( gulp.dest( jsCustomDestination ) )
        .pipe( rename( {
            basename: jsCustomFile,
            suffix: '.min'
        } ) )
        .pipe( uglify() )
        .pipe( lineec() ) // Consistent Line Endings for non UNIX systems.
        .pipe( gulp.dest( jsCustomDestination ) )
});

gulp.task('default', ['sass', 'vendorsJs', 'customJS'] );

gulp.task('watch',function(){
    gulp.watch(jsVendorSRC,function(){
        gulpMultiProcess(['vendorsJs'], function () {})
    });
    gulp.watch(jsCustomSRC,function(){
        gulpMultiProcess(['customJS'], function () {})
    });
    gulp.watch('sass/**/*.scss',function(){
        gulpMultiProcess(['sass'], function () {})
    });
});
