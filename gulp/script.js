/*eslint no-undef: "error"*/
/*eslint-env node*/

const { src, dest, watch, series } = require( 'gulp' );
const rename = require( 'gulp-rename' );
const uglify = require( 'gulp-uglify' );
// this package didn't work and was replaced by pump
// const pipeline = require('readable-stream').pipeline;
const pump = require( 'pump' );
const sourcemaps = require( 'gulp-sourcemaps' );

// Task: copy scripts
function copyScripts() {
	return src( 'src/assets/js/**/*.js' )
		.pipe( sourcemaps.init() ) // Initialize sourcemaps
		.pipe( sourcemaps.write( '.' ) ) // Generate sourcemaps
		.pipe( dest( 'assets/js' ) ); // Output JS and sourcemaps
}

// Task: minify scripts
function minifyScripts() {
	return pump(
		[
			src( 'src/assets/js/**/*.js' ),
			sourcemaps.init(), // Initialize sourcemaps
			uglify(), // For minification and compression of JavaScript code
			rename( { suffix: '.min' } ), // Rename file with .min suffix
			sourcemaps.write( '.' ), // Generate sourcemaps
			dest( 'assets/js' ), // Output minified JS and sourcemaps
		],
		( err ) => {
			if ( err ) {
				/* eslint-disable no-console */
				console.error( err );
			} // Error information
		}
	);
}

// Task: watch scripts
function watchScripts() {
	watch( 'src/assets/js/**/*.js', series( copyScripts, minifyScripts ) ); // Watch SASS
}

const scriptTasks = {
	copyScripts,
	minifyScripts,
	watchScripts,
};

module.exports = scriptTasks;
