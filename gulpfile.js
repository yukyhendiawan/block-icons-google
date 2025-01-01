import { src, dest, watch, parallel } from 'gulp';
import sass from 'gulp-sass';
import cleanCSS from 'gulp-clean-css';
import sourcemaps from 'gulp-sourcemaps';
import rename from 'gulp-rename';
import uglify from 'gulp-uglify';
import pump from 'pump';
import sassCompiler from 'sass';

// Configure gulp-sass with the imported Sass compiler
const sassProcessor = sass(sassCompiler);

// Task: Compile and Minify SASS
function buildSass() {
    return src('src/assets/scss/**/*.scss') // Select all SASS files
        .pipe(sourcemaps.init()) // Initialize source maps
        .pipe(
            sassProcessor({
                outputStyle: 'expanded',
                indentType: 'tab',
                indentWidth: 1,
            }).on('error', sassProcessor.logError)
        ) // Compile SASS with error handling
        .pipe(dest('assets/css')) // Output the unminified CSS
        .pipe(cleanCSS()) // Minify the CSS
        .pipe(rename({ suffix: '.min' })) // Append .min suffix to minified CSS file
        .pipe(sourcemaps.write('.')) // Write source maps to the output directory
        .pipe(dest('assets/css')); // Output minified CSS and source maps
}

// Task: Copy and Minify JavaScript
function buildJS(cb) {
    pump(
        [
            src('src/assets/js/**/*.js'), // Select all JavaScript files
            dest('assets/js'), // Output JS
            src('src/assets/js/**/*.js'), // Re-select JavaScript files for minification
            uglify(), // For minification and compression of JavaScript code
            rename({ suffix: '.min' }), // Rename file with .min suffix
            dest('assets/js'), // Output minified JS
        ],
        cb // Error information
    );
}

// Task: Monitor SASS files for changes
function watchSass() {
    watch('src/assets/scss/**/*.scss', buildSass); // Watch SASS files and run buildSass on change
}

// Task: Monitor JavaScript files for changes
function watchJS() {
    watch('src/assets/js/**/*.js', buildJS); // Watch JavaScript files and run buildJS on change
}

// Combined build task
const buildAll = parallel(buildSass, buildJS);

// Combined watch task
function watchFiles() {
    watchSass();
    watchJS();
}

export { buildSass, watchSass, buildJS, watchJS, buildAll, watchFiles };
