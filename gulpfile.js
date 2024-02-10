const { task, parallel, series } = require( 'gulp' );
const styleTasks = require( './gulp/style' );
const scriptTasks = require( './gulp/script' );

// List task css
task('compile-sass', series(
    styleTasks.compileSassGeneral,
    styleTasks.compileSassBlock 
));

task( 'watch-sass', styleTasks.watchSass );

// Task: all css
task( 'css', parallel( 'compile-sass', 'watch-sass' ) );

// List task js
task( 'minify-js', scriptTasks.minifyScripts );
task( 'copy-js', scriptTasks.copyScripts );
task( 'watch-js', scriptTasks.watchScripts );

// Task: all js
task( 'js', parallel( 'minify-js', 'copy-js' ) );

// Task: default
task( 'default', parallel( 'css', 'js' ) );
