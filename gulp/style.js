/*eslint no-undef: "error"*/
/*eslint-env node*/

const { src, dest, watch } = require( 'gulp' );
const sass = require( 'gulp-sass' )( require( 'sass' ) );
const cleanCSS = require( 'gulp-clean-css' );
const sourcemaps = require( 'gulp-sourcemaps' );
const rename = require( 'gulp-rename' );
const replace = require( 'gulp-replace' );

// Task: compile sass
function compileSassGeneral() {
	return src( 'src/assets/sass/*.scss' )
		.pipe( sourcemaps.init() ) // Initialize sourcemaps
		.pipe(
			sass( {
				outputStyle: 'expanded',
				indentType: 'tab',
				indentWidth: 1,
			} ).on( 'error', sass.logError )
		) // Compile SASS
		.pipe( replace( /(\/\/.*)/g, '\n$1' ) ) // Adding a new line before each one-line comment
		.pipe( replace( /(\*\/)/g, '$1\n' ) ) // Adds a new line after each block comment
		.pipe( dest( 'assets/css' ) ) // Output unminified CSS
		.pipe( cleanCSS() ) // Minify CSS
		.pipe( rename( { suffix: '.min' } ) ) // Rename file with .min suffix
		.pipe( sourcemaps.write( '.' ) ) // Generate sourcemaps
		.pipe( dest( 'assets/css' ) ); // Output minified CSS and sourcemaps
}

// Task: compile sass
function compileSassBlock () {
	return src( [ 'src/editor.scss', 'src/index.scss' ] )
		.pipe( sourcemaps.init() ) // Initialize sourcemaps
		.pipe(
			sass( {
				outputStyle: 'expanded',
				indentType: 'tab',
				indentWidth: 1,
			} ).on( 'error', sass.logError )
		) // Compile SASS
		.pipe( replace( /(\/\/.*)/g, '\n$1' ) ) // Adding a new line before each one-line comment
		.pipe( replace( /(\*\/)/g, '$1\n' ) ) // Adds a new line after each block comment
		.pipe( dest( 'build/' ) ) // Output unminified CSS
		.pipe( cleanCSS() ) // Minify CSS
		.pipe( rename( { suffix: '.min' } ) ) // Rename file with .min suffix
		.pipe( sourcemaps.write( '.' ) ) // Generate sourcemaps
		.pipe( dest( 'build/' ) ); // Output minified CSS and sourcemaps
	
}

// Task: watch sass
function watchSass() {
	watch( 'src/assets/sass/**/*.scss', compileSassGeneral ); // Watch SASS
	watch( 'src/editor.scss', compileSassBlock  ); // Watch SASS
	watch( 'src/index.scss', compileSassBlock  ); // Watch SASS
}

const styleTasks = {
	compileSassGeneral,
	compileSassBlock ,
	watchSass,
};

module.exports = styleTasks;
